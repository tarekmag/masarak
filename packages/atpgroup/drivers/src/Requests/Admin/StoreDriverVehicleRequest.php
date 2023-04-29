<?php

namespace ATPGroup\Drivers\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use ATPGroup\Drivers\Rules\CheckIfVehicleWithDriverExists;

class StoreDriverVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'driver_id' => 'required',
            'vehicle_ids' => 'required|array',
            // "vehicle_ids" => ["required", "array", new CheckIfVehicleWithDriverExists($this)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'driver_id.required' => __('driver::language.validation.driver_id.required'),
            'vehicle_ids.required' => __('driver::language.validation.vehicle_ids.required'),
        ];
    }

    /**
     * Response on failure
     *
     * @param array $validator
     * @return Response
     */
    protected function failedValidation(Validator $validator)
    {
        session()->flash('error', $validator->errors()->all());
        throw new ValidationException($validator);
    }
}
