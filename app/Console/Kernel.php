<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\BeforeTripStartCommand;
use App\Console\Commands\ChangeTripStatusCommand;
use App\Console\Commands\TripsNotConfirmedCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\InformingEmployeeFirstTripCommand;
use App\Console\Commands\CreateTripFromRouteScheduleCommand;
use App\Console\Commands\DriverDocumentsExpirationDateCommand;
use App\Console\Commands\InformingEmployeeReadyForTripCommand;
use App\Console\Commands\ConfirmationTripBeforeStartingCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CreateTripFromRouteScheduleCommand::class,
        TripsNotConfirmedCommand::class,
        ChangeTripStatusCommand::class,
        InformingEmployeeFirstTripCommand::class,
        InformingEmployeeReadyForTripCommand::class,
        BeforeTripStartCommand::class,
        ConfirmationTripBeforeStartingCommand::class,
        DriverDocumentsExpirationDateCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('trip:create')->dailyAt('00:00');
        $schedule->command('trip:not-confirmed')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('trip:change-status')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('trip:informing-employee-first-trip')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('trip:informing-employee-ready-for-trip')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('trip:before-start')->everyThreeHours()->withoutOverlapping();
        $schedule->command('trip:confirmation-before-start')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('telescope:prune --hours=96')->daily();
        $schedule->command('driver:check-documents-expiration-date')->dailyAt('00:00')->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
