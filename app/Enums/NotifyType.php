<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class NotifyType extends Enum
{
    /**
     * Admins
     *
     */
    const EMERGENCY_REQUEST = 'emergencyRequest';
    const DRIVER_NOT_CONFIRM_TRIP = 'driverNotConfirmTrip';
    const DRIVER_CONFIRM_TRIP = 'driverConfirmTrip';
    const DRIVER_NOT_START_TRIP = 'driverNotStartTrip';
    const DRIVER_COMPLETED_TRIP = 'driverCompletedTrip';

    /**
     * Drivers
     *
     */
    const WELCOME_DRIVER = 'welcomeDriver';
    const ASSIGN_TRIP_TO_DRIVER = 'assignTripToDriver';
    const BEFORE_STARTING_TRIP = 'beforeStartingTrip';
    const CONFIRMATION_TRIP_BEFORE_STARTING = 'confirmationTripBeforeStarting';
}
