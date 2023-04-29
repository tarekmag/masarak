<?php

namespace App\Services;

use App\Enums\NotifyType;
use Illuminate\Support\Str;
use App\Services\UserService;
use App\Services\DriverService;

class NotifyService
{
    /**
     * Push Notify
     *
     * @return bool
     */
    public function pushTypeNotify($type, $object, $options = [])
    {
        switch ($type) {
            /**
             * Admins Notifactions
             *
             */
            case NotifyType::EMERGENCY_REQUEST:
                $title = __('emergency::language.message.notify.title.newRequest');
                $body = __('emergency::language.message.notify.body.newRequest', ['tripName' => $options['trip_name'], 'driverName' => $options['driver_name'], 'message' => Str::limit($object->message, 50)]);
                $data = [
                    'type' => $type,
                    'route' => route('emergencyRequest.index', ['id' => $object->id]),
                    'company_id' => optional($object->trip)->route['company_id'] ?? 0
                ];
                app(UserService::class)->sendNotifyToAllAdmins($title, $body, $data);
                break;

            case NotifyType::DRIVER_NOT_CONFIRM_TRIP:
                $title = __('route::language.message.notify.title.driverNotConfirmTrip');
                $body = __('route::language.message.notify.body.driverNotConfirmTrip', ['tripName' => $options['trip_name'], 'driverName' => $options['driver_name'], 'reason' => $options['reason']]);
                $data = [
                    'type' => $type,
                    'route' => route('route.showTrip', [$object->_id]),
                    'company_id' => $object->route['company_id']
                ];
                app(UserService::class)->sendNotifyToAllAdmins($title, $body, $data);
                break;

            case NotifyType::DRIVER_CONFIRM_TRIP:
                $title = __('route::language.message.notify.title.driverConfirmTrip');
                $body = __('route::language.message.notify.body.driverConfirmTrip', ['tripName' => $options['trip_name'], 'driverName' => $options['driver_name']]);
                $data = [
                    'type' => $type,
                    'route' => route('route.showTrip', [$object->_id]),
                    'company_id' => $object->route['company_id']
                ];
                app(UserService::class)->sendNotifyToAllAdmins($title, $body, $data);
                break;

            case NotifyType::DRIVER_NOT_START_TRIP:
                $title = __('route::language.message.notify.title.driverNotStartTrip');
                $body = __('route::language.message.notify.body.driverNotStartTrip', ['tripName' => $options['trip_name'], 'driverName' => $options['driver_name']]);
                $data = [
                    'type' => $type,
                    'route' => route('route.showTrip', [$object->_id]),
                    'company_id' => $object->route['company_id']
                ];
                app(UserService::class)->sendNotifyToAllAdmins($title, $body, $data);
                break;



                /**
                 * Drivers Notifactions
                 *
                 */
            case NotifyType::WELCOME_DRIVER:
                $title = __('driver::language.message.notify.title.welcome', ['driverName' => $object->name], 'ar');
                $body = __('driver::language.message.notify.body.welcome', ['vehicleName' => $options['vehicle_name'], 'modelName' => $options['model_name'], 'plateNumber' => $options['plate_number']], 'ar');
                $data = [
                    'type' => 'notify',
                ];
                app(DriverService::class)->sendNotify($object->id, $title, $body, $data);
                break;

            case NotifyType::ASSIGN_TRIP_TO_DRIVER:
                $title = __('driver::language.message.notify.title.assignTripToDriver', ['driverName' => $object->name], 'ar');
                $body = __('driver::language.message.notify.body.assignTripToDriver', [
                    'tripDate' => $options['trip_date'],
                    'tripTime' => $options['trip_time'],
                    'startRouteName' => $options['start_route_name'],
                    'endRouteName' => $options['end_route_name'],
                    'stationsCount' => $options['stations_count'],
                    'employeesCount' => $options['employees_count'],
                ], 'ar');
                $data = [
                    'type' => 'notifyTrip',
                    'trip_id' => $options['trip_id']
                ];
                app(DriverService::class)->sendNotify($object->id, $title, $body, $data);
                break;

            case NotifyType::BEFORE_STARTING_TRIP:
                $title = __('driver::language.message.notify.title.beforeStartingTrip', ['driverName' => $object->name], 'ar');
                $body = __('driver::language.message.notify.body.beforeStartingTrip', [
                    'tripDate' => $options['trip_date'],
                    'tripTime' => $options['trip_time'],
                    'startRouteName' => $options['start_route_name'],
                    'endRouteName' => $options['end_route_name'],
                    'stationsCount' => $options['stations_count'],
                    'employeesCount' => $options['employees_count'],
                ], 'ar');
                $data = [
                    'type' => 'notifyTrip',
                    'trip_id' => $options['trip_id']
                ];
                app(DriverService::class)->sendNotify($object->id, $title, $body, $data);
                break;

            case NotifyType::CONFIRMATION_TRIP_BEFORE_STARTING:
                $title = __('driver::language.message.notify.title.confirmationTripBeforeStarting', ['driverName' => $object->name], 'ar');
                $body = __('driver::language.message.notify.body.confirmationTripBeforeStarting', [
                    'startRouteName' => $options['start_route_name'],
                    'endRouteName' => $options['end_route_name'],
                    'stationsCount' => $options['stations_count'],
                    'employeesCount' => $options['employees_count'],
                ], 'ar');
                $data = [
                    'type' => $type,
                    'trip_id' => $options['trip_id'],
                    'driver_confirmed' => false
                ];
                app(DriverService::class)->sendNotify($object->id, $title, $body, $data);
                break;

            case NotifyType::DRIVER_COMPLETED_TRIP:
                $title = __('driver::language.message.notify.title.driverCompletedTrip', ['driverName' => $object->name], 'ar');
                $body = __('driver::language.message.notify.body.driverCompletedTrip', [
                    'startRouteName' => $options['start_route_name'],
                    'endRouteName' => $options['end_route_name'],
                    'stationsCount' => $options['stations_count'],
                    'employeesCount' => $options['employees_count'],
                ], 'ar');
                $data = [
                    'type' => 'notifyTrip',
                    'trip_id' => $options['trip_id']
                ];
                app(DriverService::class)->sendNotify($object->id, $title, $body, $data);
                break;

            case 'driverDocumentIsExpired':
                $title = __('driver::language.message.notify.title.driverDocumentIsExpired', ['daysNumber' => $options['days_number']]);
                $body = __(
                    'driver::language.message.notify.body.driverDocumentIsExpired',
                    [
                        'documentType' => $options['document_type'],
                        'driverName' => $options['driver_name'],
                        'driverPhone' => $options['driver_phone']
                    ]
                );
                $data = [
                    'type' => $type,
                    'route' => route('driverDocument.index', ['id' => $object->id]),
                    'company_id' => 0
                ];
                $this->sendNotifyToAllAdmins($title, $body, $data);
                break;
        }
        return true;
    }

    /**
     * Update Notify
     */
    public function updateDriverConfirmData($notifyId, $status)
    {
        if (!$notifyId) {
            return false;
        }

        $notify = auth('api')->user()->notifications()->where('id', $notifyId)->first();
        if (!$notify) {
            return false;
        }

        $data = [
            'title' => $notify->data['title'],
            'body' => $notify->data['body'],
            'data' => [
                'type' => $notify->data['data']['type'],
                'trip_id' => (isset($notify->data['data']['trip_id'])) ? $notify->data['data']['trip_id']: '',
                'driver_confirmed' => (bool) true,
            ],
        ];
        $notify->update(['data' => $data], ['upsert' => true]);
        return true;
    }
}
