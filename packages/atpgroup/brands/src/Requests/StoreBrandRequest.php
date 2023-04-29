<?php

namespace ATPGroup\Brands\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreBrandRequest extends FormRequest
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
            'name_ar' => 'required|unique:brands,name_ar,'.optional($this->brand)->id,
            'name_en' => 'required|unique:brands,name_en,'.optional($this->brand)->id,
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
            'name_ar.unique' => __('brand::language.validation.name_ar.unique'),
            'name_en.unique' => __('brand::language.validation.name_en.unique'),
            'name_ar.required' => __('brand::language.validation.name_ar.required'),
            'name_en.required' => __('brand::language.validation.name_en.required'),
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
