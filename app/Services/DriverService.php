<?php

namespace App\Services;

use Carbon\Carbon;
use App\Enums\NotifyType;
use App\Services\NotifyService;
use App\Services\SmsmisrService;
use Alkoumi\LaravelHijriDate\Hijri;
use ATPGroup\Drivers\Models\Driver;
use App\Events\NotifyDriverFCMEvent;
use ATPGroup\Drivers\Models\DriverVehicle;
use ATPGroup\Drivers\Models\DriverCoordinate;
use ATPGroup\Notifications\Models\DeviceToken;
use ATPGroup\Drivers\Resources\API\DriverResource;
use ATPGroup\Drivers\Models\DriverMobileNumberRequest;
use ATPGroup\Notifications\Notifications\DriverNotification;


class DriverService
{
    /**
     * Login Passport
     *
     * @return string
     */
    public function loginPassport($driver, $request)
    {
        $this->addDeviceToken($driver, $request);
        $this->resetOTP($driver->mobile_number);

        $tokenResult = $driver->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = now()->addWeeks(4);
        }
        $token->save();

        $response = [
            'token' => [
                'access_token' => 'Bearer ' . $tokenResult->accessToken,
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            ],
            'profile' => new DriverResource($driver),
        ];

        return responseSuccessData($response);
    }

    /**
     * Logout Passport
     *
     * @return string
     */
    public function logoutPassport($driver, $request)
    {
        $driver->devices()->where('token', $request->device_token)->update(['is_login' => 0]);
        $driver->token()->revoke();

        return responseSuccessMessage(__('driver::language.api.message.logout'));
    }

    /**
     * Send OTP
     */
    public function sendOTP($mobileNumber)
    {
        $driver = Driver::whereMobileNumber($mobileNumber)->first();
        $driver->otp_code = generateRandomNumber(6);
        $driver->save();

        $message = __('driver::language.api.sms.message.otp_code', ['code' => $driver->otp_code]);
        app(SmsmisrService::class)->send($message, [$driver->mobile_number]);

        //Send Notify
        // event(new DirectNotifyDriverFCMEvent($driver->id, $message, ['code' => $driver->otp_code], $message));
    }

    /**
     * Send Mobile Number OTP
     */
    public function sendMobileNumberRequestOTP($driver, $mobileNumber)
    {
        $driverRequest = DriverMobileNumberRequest::updateOrCreate(['driver_id' => $driver->id, 'mobile_number' => $mobileNumber], ['otp_code' => generateRandomNumber(6)]);
        $message = __('driver::language.api.sms.message.otp_code', ['code' => $driverRequest->otp_code]);
        app(SmsmisrService::class)->send($message, [$driverRequest->mobile_number]);

        //Send Notify
        // event(new DirectNotifyDriverFCMEvent($driver->id, $message, ['code' => $driver->otp_code], $message));
    }

    /**
     * Reset OTP
     */
    public function resetOTP($mobileNumber)
    {
        $driver = Driver::whereMobileNumber($mobileNumber)->first();
        $driver->otp_code = null;
        $driver->unsetEventDispatcher();
        $driver->save();
    }

    /**
     * Reset OTP
     */
    public function resetMobileNumberRequestOTP($driver)
    {
        $driverRequest = DriverMobileNumberRequest::whereDriverId($driver->id)->whereMobileNumber($driver->mobile_number)->first();
        if ($driverRequest) {
            $driverRequest->delete();
        }
    }

    /**
     * Add Device Token
     */
    public function addDeviceToken($driver, $request)
    {
        $device = DeviceToken::firstOrNew(['token' => $request->device_token]);
        $device->deviceable_type = Driver::class;
        $device->deviceable_id = $driver->id;
        $device->type = $request->device_type;
        $device->is_login = true;
        $device->save();

        $driver->devices()->where('token', '!=', $request->device_token)->update(['is_login' => 0]);
    }

    /**
     * Check for OTP Code
     */
    public function checkOTPCode($otpCode, $mobileNumber)
    {
        return Driver::whereOtpCode($otpCode)->whereMobileNumber($mobileNumber)->first();
    }

    /**
     * Push Driver Tracking Coordinate to MongoDB and update location in mysql
     *
     * @return boolean
     */
    public function pushDriverTrackingCoordinate($driverId, $coordinates, $isRealTime = false)
    {
        $driver = Driver::find($driverId);
        if (!$driver) {
            // info('Faild Driver Push');
            return false;
        }

        $driverCoordinate = DriverCoordinate::where('driver_id', (int) $driverId)->where('tracking_date', '=', now()->startOfDay())->first();
        if ($driverCoordinate) {
            $driverCoordinate->push('coordinates', $coordinates, true);
            // $driverCoordinate->push('coordinates', $coordinates);
        } else {
            $driverCoordinate = new DriverCoordinate;
            $driverCoordinate->fill(['driver_id' => (int) $driverId, 'tracking_date' => now()->startOfDay(), 'coordinates' => $coordinates]);
            $driverCoordinate->save();
        }

        $coordinate = end($coordinates);
        if (isset($coordinate[0]) && isset($coordinate[1])) {
            $driver->update(['lat' => $coordinate[0], 'lng' => $coordinate[1]]);
        }

        // info('Pushed Driver:'.$driverId, $coordinates);

        if ($isRealTime) {
            //broadcast(new PushTripTrackingRouteCoordinateEvent($tripId, $coordinates));
        }

        return true;
    }

    /**
     * Send Notify To Drivers
     *
     * @return string
     */
    public function sendNotify($driverIds, $title, $body, $data)
    {
        if (!is_array($driverIds)) {
            $driverIds = [$driverIds];
        }
        Driver::active()
            ->whereIn('id', $driverIds)
            ->get()
            ->map(function ($driver) use ($driverIds, $title, $data, $body) {
                $driver->notify(new DriverNotification($title, $data, $body));
                broadcast(new NotifyDriverFCMEvent($driverIds, $title, $data, $body));
            });

        return true;
    }

    /**
     * Push Type Notify
     *
     */
    public function pushTypeNotify($type, $driver, $extraData = [])
    {
        switch ($type) {
            case NotifyType::DRIVER_NOT_START_TRIP:
                $trip = $extraData['trip'];
                $options = [
                    'trip_name' => $trip['route']['from_en'] . ' ' . $trip['route']['to_en'],
                    'driver_name' => $trip['driver']['name'],
                ];
                app(NotifyService::class)->pushTypeNotify($type, $trip, $options);
                break;

            case NotifyType::DRIVER_NOT_CONFIRM_TRIP:
                $trip = $extraData['trip'];
                $reason = $extraData['reason'];
                $options = [
                    'trip_name' => $trip['route']['from_en'] . ' ' . $trip['route']['to_en'],
                    'driver_name' => $trip['driver']['name'],
                    'reason' => $reason
                ];
                app(NotifyService::class)->pushTypeNotify($type, $trip, $options);
                break;

            case NotifyType::DRIVER_CONFIRM_TRIP:
                $trip = $extraData['trip'];
                $options = [
                    'trip_name' => $trip['route']['from_en'] . ' ' . $trip['route']['to_en'],
                    'driver_name' => $trip['driver']['name'],
                ];
                app(NotifyService::class)->pushTypeNotify($type, $trip, $options);
                break;

            case NotifyType::WELCOME_DRIVER:
                $options = [
                    'vehicle_name' => '',
                    'model_name' => '',
                    'plate_number' => '',
                ];
                app(NotifyService::class)->pushTypeNotify($type, $driver, $options);
                break;

            case NotifyType::ASSIGN_TRIP_TO_DRIVER:
                $trip = $extraData['trip'];
                $options = [
                    'trip_date' => transalteFromEnglishToArabic($trip->trip_date->format(config('helpers.dateFormatArabic'))),
                    'trip_time' => Hijri::DateIndicDigits(config('helpers.timeFormat12'), $trip->trip_time),
                    'start_route_name' => $trip->route['from_ar'],
                    'end_route_name' => $trip->route['to_ar'],
                    'stations_count' => transalteFromEnglishToArabic(count($trip->stations)),
                    'employees_count' => transalteFromEnglishToArabic($trip->employees_count),
                    'trip_id' => $trip->_id
                ];
                app(NotifyService::class)->pushTypeNotify($type, $driver, $options);
                break;

            case NotifyType::BEFORE_STARTING_TRIP:
                $trip = $extraData['trip'];
                $options = [
                    'trip_date' => $trip->trip_time->locale('ar')->diffForHumans(now()),
                    'trip_time' => Hijri::DateIndicDigits(config('helpers.timeFormat12'), $trip->trip_time),
                    'start_route_name' => $trip->route['from_ar'],
                    'end_route_name' => $trip->route['to_ar'],
                    'stations_count' => transalteFromEnglishToArabic(count($trip->stations)),
                    'employees_count' => transalteFromEnglishToArabic($trip->employees_count),
                    'trip_id' => $trip->_id
                ];
                app(NotifyService::class)->pushTypeNotify($type, $driver, $options);
                break;

            case NotifyType::CONFIRMATION_TRIP_BEFORE_STARTING:
                $trip = $extraData['trip'];
                $options = [
                    'start_route_name' => $trip->route['from_ar'],
                    'end_route_name' => $trip->route['to_ar'],
                    'stations_count' => transalteFromEnglishToArabic(count($trip->stations)),
                    'employees_count' => transalteFromEnglishToArabic($trip->employees_count),
                    'trip_id' => $trip->_id
                ];
                app(NotifyService::class)->pushTypeNotify($type, $driver, $options);
                break;

            case NotifyType::DRIVER_COMPLETED_TRIP:
                $trip = $extraData['trip'];
                $options = [
                    'start_route_name' => $trip->route['from_ar'],
                    'end_route_name' => $trip->route['to_ar'],
                    'stations_count' => transalteFromEnglishToArabic(count($trip->stations)),
                    'employees_count' => transalteFromEnglishToArabic($trip->employees_count),
                    'trip_id' => $trip->_id
                ];
                app(NotifyService::class)->pushTypeNotify($type, $driver, $options);
                break;
        }
    }

    /**
     * Assig Driver Vehicle
     *
     */
    public function assigDriverVehicle($driver_id, $vehicle_id)
    {
        return DriverVehicle::updateOrCreate(['driver_id' => $driver_id, 'vehicle_id' => $vehicle_id]);
    }
}
