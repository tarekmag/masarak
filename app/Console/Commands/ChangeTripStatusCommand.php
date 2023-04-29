<?php

namespace App\Console\Commands;

use App\Enums\RouteType;
use App\Enums\NotifyType;
use App\Services\TripService;
use App\Services\DriverService;
use Illuminate\Console\Command;
use ATPGroup\Routes\Models\Trip;

class ChangeTripStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:change-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change trip status based on time';

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
        $this->info('Trip Command Change Status Is Start');

        Trip::query()
        ->where('status', RouteType::TRIP_STATUS_AVAILABLE)
        ->where('trip_date', '=', now()->startOfDay())
        ->where('trip_time', '<=', now())
        ->chunk(500, function ($trips) {
            $this->output->progressStart($trips->count());
            foreach ($trips as $trip)
            {
                $tripDateTime = app(TripService::class)->getTripDateTimeFormated($trip, $trip->arrival_allowance);

                if($tripDateTime <= now()->format('Y-m-d H:i'))
                {
                    $trip->update(['status' => RouteType::TRIP_STATUS_NOT_STARTED, 'status_action_reasons' => 'Exceeded the time allowed to start trip', 'status_action_by' => 'system']);
                    app(DriverService::class)->pushTypeNotify(NotifyType::DRIVER_NOT_START_TRIP, $trip->driverRelation, ['trip' => $trip]);
                }
                $this->output->progressAdvance();
            }
            $this->output->progressFinish();
        });

        $this->info('Trip Command Change Status Is Done');
        return Command::SUCCESS;
    }
}
