<?php

namespace App\Console\Commands;

use App\Enums\RouteType;
use App\Enums\NotifyType;
use App\Services\TripService;
use App\Services\DriverService;
use Illuminate\Console\Command;
use ATPGroup\Routes\Models\Trip;

class BeforeTripStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:before-start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Before Start The trip send notifaction to drivers, based on time';

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
        $this->info('Trip Command Before Start Is Start');
        Trip::query()
            ->where('status', RouteType::TRIP_STATUS_AVAILABLE)
            ->where('trip_date', now()->startOfDay())
            ->where('trip_time', '<=', now()->addHours(3))
            ->chunk(500, function ($trips) {
                $this->output->progressStart($trips->count());
                foreach ($trips as $trip) {
                    $tripDateTime = app(TripService::class)->getTripDateTimeFormated($trip);
                    if ($tripDateTime->format('Y-m-d H:i') <= now()->addHours(3)->format('Y-m-d H:i')) {
                        if($trip->driverRelation)
                        {
                            app(DriverService::class)->pushTypeNotify(NotifyType::BEFORE_STARTING_TRIP, $trip->driverRelation, ['trip' => $trip]);
                        }
                    }
                    $this->output->progressAdvance();
                }
                $this->output->progressFinish();
            });

        $this->info('Trip Command Before Start Is Done');
        return Command::SUCCESS;
    }
}
