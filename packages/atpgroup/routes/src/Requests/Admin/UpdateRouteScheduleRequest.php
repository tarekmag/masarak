<?php

namespace ATPGroup\Routes\Requests\Admin;

use ATPGroup\Routes\Rules\CheckOldDatesOnRouteSchedule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRouteScheduleRequest extends FormRequest
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
        if(!$this->has('route_schedule_ids'))
        {
            return [];
        }
        return [
            'route_id' => 'required|numeric|exists:routes,id',
            'route_schedule_ids' => 'required|array',
            'client_prices.*' => 'required',
            'driver_prices.*' => 'required',
            'route_types.*' => 'required',
            'supplier_ids.*' => 'sometimes|nullable|numeric',
            'driver_ids.*' => 'required|numeric',
            'vehicle_ids.*' => 'required|numeric',
            'days' => 'required|present|array',
            'start_dates' => ['sometimes', 'nullable', 'array', new CheckOldDatesOnRouteSchedule($this)],
            'end_dates' => ['sometimes', 'nullable', 'array'],
            'times.*' => 'required',
            'is_returns' => 'sometimes|nullable|array',
            'is_actives' => 'sometimes|nullable|array',
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
            'client_prices.*.required' => __('route::language.validation.client_prices.required'),
            'driver_prices.*.required' => __('route::language.validation.driver_prices.required'),
            'route_types.*.required' => __('route::language.validation.route_types.required'),
            'supplier_ids.*.required' => __('route::language.validation.supplier_ids.required'),
            'driver_ids.*.required' => __('route::language.validation.driver_ids.required'),
            'vehicle_ids.*.required' => __('route::language.validation.vehicle_ids.required'),
            'days.required' => __('route::language.validation.days.required'),
            'start_dates.required' => __('route::language.validation.start_dates.required'),
            'times.*.required' => __('route::language.validation.times.required'),
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
            'route_id' => $this->route->id
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
