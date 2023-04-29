<?php

namespace ATPGroup\Companies\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreBranchRequest extends FormRequest
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
            'parent_id' => 'required|numeric',
            'name_ar' => 'required|unique:companies,name_ar,'.optional($this->branch)->id,
            'name_en' => 'required|unique:companies,name_en,'.optional($this->branch)->id,
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
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
            'parent_id.required' => __('company::language.validation.parent_id.required'),
            'name_ar.required' => __('company::language.validation.name_ar.required'),
            'name_en.required' => __('company::language.validation.name_en.required'),
            'name_ar.unique' => __('company::language.validation.name_ar.unique'),
            'name_en.unique' => __('company::language.validation.name_en.unique'),
            'lat.required' => __('company::language.validation.lat.required'),
            'lng.required' => __('company::language.validation.lng.required'),
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
