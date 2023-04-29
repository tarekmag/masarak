<?php

namespace App\Console\Commands;

use App\Enums\RouteType;
use Illuminate\Support\Str;
use App\Services\TripService;
use Illuminate\Console\Command;
use App\Services\SmsmisrService;
use ATPGroup\Routes\Models\Trip;

class InformingEmployeeFirstTripCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:informing-employee-first-trip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'If the station still not defined for the first day user shall receive SMS before the trip start time with 30 mins informing the employee';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Trip Command Informing Employee First Trip Is Start');
        
        Trip::query()
            ->where('status', RouteType::TRIP_STATUS_AVAILABLE)
            ->where('driver_confirmed', true)
            ->where('trip_date', '=', now()->startOfDay())
            ->chunk(500, function ($trips) {
            $this->output->progressStart($trips->count());
            foreach ($trips as $trip) 
            {
                $tripDateTime = app(TripService::class)->getTripDateTimeFormated($trip);
                
                if($tripDateTime->format('Y-m-d H:i') <= now()->addMinutes(30)->format('Y-m-d H:i'))
                {
                    $checkFirstTrip = Trip::where('route_id', $trip->route_id)->where('route_schedule_id', $trip->route_schedule_id)->first();
                    if(!$checkFirstTrip)
                    {
                        $employees = app(TripService::class)->getAllEmployeeRelatedToSchedule($trip->route_schedule_id);

                        //Send SMS with link to employee
                        foreach($employees as $employee)
                        {
                            $message = __('route::language.message.sms.informingEmployeeTripCommingWithoutLink', [
                                'driverName' => $trip->driver['name'],
                                'carModel' => $trip->vehicle_brand['name_ar'].' '.$trip->vehicle_brand_model['name_ar'],
                                'driverPhoneNumber' => $trip->driver['mobile_number'],
                                'platesNumber' => $trip->vehicle['plate_number'],
                                'minutes' => 30,
                            ], 'ar');
                            
                            if($station = $employee->station)
                            {
                                $latLngStationTrip = app(TripService::class)->getLatLngStationTrip($trip, $station);
                                
                                // $url = app('bitly')->getUrl('http://maps.google.com/?q='.$latLngStationTrip['lat'].','.$latLngStationTrip['lng']); // Short link
                                $url = 'https://maps.google.com/?q='.$latLngStationTrip['lat'].','.$latLngStationTrip['lng'];
                                $message = __('route::language.message.sms.informingEmployeeTripCommingWithGoogleLink', [
                                    'driverName' => $trip->driver['name'],
                                    'carModel' => $trip->vehicle_brand['name_ar'].' '.$trip->vehicle_brand_model['name_ar'],
                                    'driverPhoneNumber' => $trip->driver['mobile_number'],
                                    'platesNumber' => $trip->vehicle['plate_number'],
                                    'minutes' => 30,
                                    'stationLink' => $url,
                                ], 'ar');
                            }
                            //app(SmsmisrService::class)->send($message, [$employee['phone']]);
                        }
                    }
                }
                $this->output->progressAdvance();
            }
            $this->output->progressFinish();
        });

        $this->info('Trip Command Informing Employee First Trip Is Done');
        return Command::SUCCESS;
    }
}
