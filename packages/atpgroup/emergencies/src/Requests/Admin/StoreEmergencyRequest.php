<?php

namespace ATPGroup\Emergencies\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreEmergencyRequest extends FormRequest
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
            'name_ar' => 'required|unique:emergencies,name_ar,'.optional($this->emergency)->id,
            'name_en' => 'required|unique:emergencies,name_en,'.optional($this->emergency)->id,
            'mobile_number' => 'sometimes|nullable|digits:11',
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
            'name_ar.required' => __('emergency::language.validation.name_ar.required'),
            'name_en.required' => __('emergency::language.validation.name_en.required'),
            'name_ar.unique' => __('emergency::language.validation.name_ar.unique'),
            'name_en.unique' => __('emergency::language.validation.name_en.unique'),
            'mobile_number.digits' => __('employee::language.validation.mobile_number.invalid'),
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
