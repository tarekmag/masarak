<?php

namespace App\Console\Commands;

use App\Enums\NotifyType;
use App\Services\TripService;
use App\Services\DriverService;
use Illuminate\Console\Command;
use ATPGroup\Routes\Models\Trip;

class TripsNotConfirmedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:not-confirmed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all trips not confirmed from drivers side before one hour';

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
        $this->info('Trip Command Not Confirmed Is Start');

        Trip::where('driver_confirmed_notified_to_admin', false)
        ->where('driver_confirmed', false)
        ->where('trip_date', '=', now()->startOfDay())
        ->chunk(500, function ($trips) {
            $this->output->progressStart($trips->count());
            foreach ($trips as $trip)
            {
                $status = app(TripService::class)->checkForCanConfirmTrip($trip);
                if(!$status)
                {
                    $trip->update(['driver_confirmed_notified_to_admin' => true]);
                    app(DriverService::class)->pushTypeNotify(NotifyType::DRIVER_NOT_CONFIRM_TRIP, $trip->driverRelation, ['trip' => $trip, 'reason' => 'Exceeded the time allowed to confirm the trip']);
                }
                $this->output->progressAdvance();
            }
            $this->output->progressFinish();
        });

        $this->info('Trip Command Not Confirmed Is Done');
        return Command::SUCCESS;
    }
}
