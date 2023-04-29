<?php

namespace ATPGroup\Routes\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use ATPGroup\Routes\Rules\CheckIfTripExists;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreStationCoordinateRequest extends FormRequest
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
            'lat' => 'sometimes|nullable|numeric|between:-90,90',
            'lng' => 'sometimes|nullable|numeric|between:-180,180',
            'employees' => 'sometimes|nullable|array',
            'station_id' => 'sometimes|nullable|numeric'
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
