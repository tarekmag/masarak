<?php

namespace ATPGroup\Users\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreUserRequest extends FormRequest
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
        $this->user = (request()->route()->getName() == 'user.updateProfile') ? auth()->id() : $this->user;

        return [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'password' => 'nullable|required_with:password_confirmation|string|min:8|confirmed',
            // 'password' => 'nullable|required_with:password_confirmation|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
            'is_blank_dashboard' => 'nullable|boolean'
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
            'name.required' => __('user::language.validation.name.required'),
            'email.required' => __('user::language.validation.email.required'),
            'email.unique' => __('user::language.validation.email.unique'),
            'password.required' => __('user::language.validation.password.required'),
            'password.confirmed' => __('user::language.validation.password.same'),
            'password.regex' => __('user::language.validation.password.regex'),
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
            'is_blank_dashboard' => ($this->is_dashboard) ? true : false,
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
