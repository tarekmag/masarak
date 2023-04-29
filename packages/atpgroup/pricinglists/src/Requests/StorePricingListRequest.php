<?php

namespace ATPGroup\PricingLists\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StorePricingListRequest extends FormRequest
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
            'company_id' => 'required',
            'station_from' => 'required',
            'station_to' => 'required',
            'client_single_cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'driver_single_cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'client_waiting_cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'driver_waiting_cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
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
            'company_id.required' => __('brand::language.validation.company_id.required'),
            'station_from.required' => __('brand::language.validation.station_from.required'),
            'station_to.required' => __('brand::language.validation.station_to.required'),
            'client_single_cost.required' => __('brand::language.validation.client_single_cost.required'),
            'driver_single_cost.required' => __('brand::language.validation.driver_single_cost.required'),
            'client_waiting_cost.required' => __('brand::language.validation.client_waiting_cost.required'),
            'driver_waiting_cost.required' => __('brand::language.validation.driver_waiting_cost.required'),
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
