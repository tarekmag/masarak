<?php

namespace ATPGroup\Routes\Rules;

use Illuminate\Http\Request;
use ATPGroup\Routes\Models\Trip;
use Illuminate\Contracts\Validation\Rule;

class CheckIfTripExists implements Rule
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
        if(!Trip::find($value))
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
        return __('route::language.validation.trip_id.exists');
    }
}
