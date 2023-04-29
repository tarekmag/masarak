<?php

namespace ATPGroup\Routes\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use ATPGroup\Routes\Rules\CheckIfTripWithDriverExists;

class StoreTripRequest extends FormRequest
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
            'station_ids' => 'required|array',
            'employee_ids' => 'required|array',
            'is_return' => 'sometimes|nullable',
            'route_id' => 'required|numeric|exists:routes,id',
            'client_price' => 'required',
            'driver_price' => 'required',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:'.now()->format(config('helpers.dateFormat')),
            'start_time' => 'required|date_format:H:i',
            'supplier_id' => 'sometimes|nullable|numeric',
            "driver_id" => ["required", "numeric", new CheckIfTripWithDriverExists($this)],
            'vehicle_id' => 'required|numeric',
            'status' => 'required',
            'class' => 'required',
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
            'route_id.required' => __('route::language.validation.route_id.required'),
            'route_id.exists' => __('route::language.validation.route_id.exists'),
            'station_ids.required' => __('route::language.validation.station_ids.required'),
            'employee_ids.required' => __('route::language.validation.employee_ids.required'),
            'client_price.required' => __('route::language.validation.client_price.required'),
            'driver_price.required' => __('route::language.validation.driver_price.required'),
            'start_date.required' => __('route::language.validation.start_date.required'),
            'start_time.required' => __('route::language.validation.start_time.required'),
            'driver_id.required' => __('route::language.validation.driver_id.required'),
            'vehicle_id.required' => __('route::language.validation.vehicle_id.required'),
            'status.required' => __('route::language.validation.status.required'),
            'class.required' => __('route::language.validation.class.required'),
        ];

    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'route_id' => $this->route,
        ]);
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
