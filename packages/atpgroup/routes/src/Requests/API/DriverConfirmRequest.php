<?php

namespace ATPGroup\Routes\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use ATPGroup\Routes\Rules\CheckIfTripExists;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DriverConfirmRequest extends FormRequest
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
            "trip_id" => ["required", new CheckIfTripExists($this)],
            'driver_confirmed' => 'required|boolean',
            'reason' => 'required_if:driver_confirmed,false',
            'notify_id' => 'nullable'
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
            'trip_id.required' => __('route::language.validation.trip_id.required'),
            'driver_confirmed.required' => __('route::language.validation.driver_confirmed.required'),
            'driver_confirmed.boolean' => __('route::language.validation.driver_confirmed.boolean'),
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
        throw new HttpResponseException(validationErrors($validator->errors()->all()));
    }
}
