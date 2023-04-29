<?php

namespace App\Console\Commands;

use App\Enums\RouteType;
use App\Enums\NotifyType;
use App\Services\TripService;
use App\Services\DriverService;
use Illuminate\Console\Command;
use ATPGroup\Routes\Models\Trip;

class ConfirmationTripBeforeStartingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:confirmation-before-start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Confirmation before the trip in 1 h he will receive notification';

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
        $this->info('Trip Command Confirmation Before Start Is Start');
        Trip::query()
            ->where('status', RouteType::TRIP_STATUS_AVAILABLE)
            ->where('driver_confirmed', false)
            ->where('trip_date', now()->startOfDay())
            ->where('trip_time', '<=', now())
            ->chunk(500, function ($trips) {
                $this->output->progressStart($trips->count());
                foreach ($trips as $trip) {
                    $tripDateTime = app(TripService::class)->getTripDateTimeFormated($trip);
                    if ($tripDateTime->format('Y-m-d H:i') <= now()->addHours(1)->format('Y-m-d H:i')) {
                        app(DriverService::class)->pushTypeNotify(NotifyType::CONFIRMATION_TRIP_BEFORE_STARTING, $trip->driverRelation, ['trip' => $trip]);
                    }
                    $this->output->progressAdvance();
                }
                $this->output->progressFinish();
            });

        $this->info('Trip Command Confirmation Before Start Is Done');
        return Command::SUCCESS;
    }
}
