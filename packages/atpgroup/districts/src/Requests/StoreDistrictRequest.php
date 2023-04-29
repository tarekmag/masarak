<?php

namespace ATPGroup\Districts\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreDistrictRequest extends FormRequest
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
            'name_ar' => 'required|unique:districts,name_ar,'.optional($this->district)->id,
            'name_en' => 'required|unique:districts,name_en,'.optional($this->district)->id,
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
            'name_ar.unique' => __('district::language.validation.name_ar.unique'),
            'name_en.unique' => __('district::language.validation.name_en.unique'),
            'name_ar.required' => __('district::language.validation.name_ar.required'),
            'name_en.required' => __('district::language.validation.name_en.required'),
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
