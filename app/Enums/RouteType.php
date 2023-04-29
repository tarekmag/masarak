<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RouteType extends Enum
{
    /**
     * Route Types
     */
    const ECONOMY = 'economy';
    const BUSINESS = 'business';

    /**
     * Route Schedule Types
     */
    const SCHEDULE_SCHEDULED = 'scheduled'; // Create a trips by system
    const SCHEDULE_SPECIAL_REQUEST = 'special_request'; // Create a trips by user
    const SCHEDULE_MANUAL = 'manual'; // Past or Future Trip by user
    const SCHEDULE_MODIFIED = 'modified'; // modified a trip by user

    /**
     * Weekdays
     */
    const SUNDAY = 'sunday';
    const MONDAY = 'monday';
    const TUESDAY = 'tuesday';
    const WEDNESDAY = 'wednesday';
    const THURSDAY = 'thursday';
    const FRIDAY = 'friday';
    const SATURDAY = 'saturday';

    /**
     * Trip Status
     */
    const TRIP_STATUS_AVAILABLE = 'available'; //(trip didn’t started but before it’s start time)
    const TRIP_STATUS_NOT_STARTED = 'not_started'; //(trip didn’t started after its start time)
    const TRIP_STATUS_STARTED = 'started'; //(trip started on a time)
    const TRIP_STATUS_COMPLETED = 'completed'; //(trip started and ended)
    const TRIP_STATUS_CANCELLED = 'cancelled'; //(trip cancelled by system admin)
    const TRIP_STATUS_STOPPED = 'stopped'; //(trip stopped by system admin)

    /**
     * Trip Schedule Employee Location Request Status
     */
    const EMPLOYEE_LOCATION_REQUEST_STATUS_PENDING = 'pending';
    const EMPLOYEE_LOCATION_REQUEST_STATUS_APPROVED = 'approved';
    const EMPLOYEE_LOCATION_REQUEST_STATUS_DECLINED = 'declined';
    const EMPLOYEE_LOCATION_REQUEST_COUNT = 1;
}
