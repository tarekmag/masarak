<?php

namespace ATPGroup\Vehicles\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreVehicleRequest extends FormRequest
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
            'brand_id' => 'required|numeric',
            'brand_model_id' => 'required|numeric',
            'plate_number' => 'required|unique:vehicles,plate_number,'.optional($this->vehicle)->id,
            'color_en' => 'required',
            'color_ar' => 'required',
            'color_code' => 'nullable',
            'number_seats' => 'required|numeric',
            'vehicle_year' => 'required|date_format:Y',
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
            'brand_id.required' => __('vehicle::language.validation.brand_id.required'),
            'brand_model_id.required' => __('vehicle::language.validation.brand_model_id.required'),
            'plate_number.required' => __('vehicle::language.validation.plate_number.required'),
            'plate_number.unique' => __('vehicle::language.validation.plate_number.unique'),
            'color_en.required' => __('vehicle::language.validation.color_en.required'),
            'color_ar.required' => __('vehicle::language.validation.color_ar.required'),
            'number_seats.required' => __('vehicle::language.validation.number_seats.required'),
            'vehicle_year.required' => __('vehicle::language.validation.vehicle_year.required'),
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
