<?php

namespace ATPGroup\Routes\Rules;

use Illuminate\Http\Request;
use ATPGroup\Routes\Models\Trip;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckIfTripWithDriverExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $request = request();
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $startTime = Carbon::parse($request->start_date.' '.$request->start_time);
        $trip = Trip::where('driver_id', (int) $request->driver_id)->where('trip_date', '=', $startDate)->where('trip_time', '=', $startTime)->first();
        if($trip)
        {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('route::language.validation.trip.exists');
    }
}
