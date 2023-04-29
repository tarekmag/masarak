<?php

namespace ATPGroup\Employees\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreEmployeeRequest extends FormRequest
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
            'company_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'name' => 'required',
            'phone' => 'required|digits:11|unique:employees,phone,'.optional($this->employee)->id,
            'email' => 'nullable|unique:employees,email,'.optional($this->employee)->id,
            'image' => 'nullable',
            'is_leader' => 'nullable|boolean',
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
            'company_id.required' => __('employee::language.validation.company_id.required'),
            'company_id.numeric' => __('employee::language.validation.company_id.numeric'),
            'branch_id.required' => __('employee::language.validation.branch_id.required'),
            'branch_id.numeric' => __('employee::language.validation.branch_id.numeric'),
            'name.required' => __('employee::language.validation.name.required'),
            'phone.required' => __('employee::language.validation.phone.required'),
            'phone.unique' => __('employee::language.validation.phone.unique'),
            'phone.digits' => __('employee::language.validation.phone.invalid'),
            'email.unique' => __('employee::language.validation.email.unique'),
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
            'is_leader' => ($this->is_leader) ? true : false,
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
