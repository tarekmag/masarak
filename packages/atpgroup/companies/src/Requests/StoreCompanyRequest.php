<?php

namespace ATPGroup\Companies\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreCompanyRequest extends FormRequest
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
            'name_ar' => 'required|unique:companies,name_ar,'.optional($this->company)->id,
            'name_en' => 'required|unique:companies,name_en,'.optional($this->company)->id,
            'logo' => 'nullable',
            'main_branch' => 'nullable|boolean',
            'display_employee_image' => 'nullable|boolean',
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
            'name_ar.required' => __('company::language.validation.name_ar.required'),
            'name_en.required' => __('company::language.validation.name_en.required'),
            'name_ar.unique' => __('company::language.validation.name_ar.unique'),
            'name_en.unique' => __('company::language.validation.name_en.unique'),
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
            'main_branch' => ($this->main_branch) ? true : false,
            'display_employee_image' => ($this->display_employee_image) ? true : false,
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
        session()->flash('error', $validator->errors()->all());
        throw new ValidationException($validator);
    }
}
