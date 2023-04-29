<?php

namespace ATPGroup\Stations\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreStationRequest extends FormRequest
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
            'district_id' => 'required|numeric',
            'name_ar' => 'nullable',
            'name_en' => 'nullable',
            'pickup_name_en' => 'nullable',
            'pickup_name_ar' => 'nullable',
            'drop_name_en' => 'nullable',
            'drop_name_ar' => 'nullable',
            'pickup_lat' => 'required_if:drop_lat,null',
            'pickup_lng' => 'required_if:drop_lng,null',
            'drop_lat' => 'nullable',
            'drop_lng' => 'nullable',
            'address_en' => 'nullable',
            'address_ar' => 'nullable',
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
            'district_id.required' => __('station::language.validation.district_id.required'),
            'name_ar.unique' => __('station::language.validation.name_ar.unique'),
            'name_en.unique' => __('station::language.validation.name_en.unique'),
            'pickup_lat.required_if' => __('station::language.validation.pickup_lat.required_if'),
            'pickup_lng.required_if' => __('station::language.validation.pickup_lng.required_if'),
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
