<?php

namespace ATPGroup\Drivers\Rules;

use ATPGroup\Drivers\Models\DriverVehicle;
use Illuminate\Http\Request;
use ATPGroup\Routes\Models\Trip;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckIfVehicleWithDriverExists implements Rule
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
        $check = DriverVehicle::where('driver_id', '!=', $request->drvier_id)->whereIn('vehicle_id', $request->vehicle_ids)->exists();
        if ($check) {
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
        return __('driver::language.validation.vehicle_ids.exists');
    }
}
