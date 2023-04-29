<?php

namespace ATPGroup\Drivers\Requests\API;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth('api')->user()->password)) {
                    return $fail(__('driver::language.validation.current_password.not_match'));
                }
            }],
            'password' => 'required|required_with:password_confirmation|string|min:4|confirmed',
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
            'current_password.required' => __('driver::language.validation.current_password.required'),
            'password.required' => __('driver::language.validation.password.required'),
            'password_confirmation.required' => __('driver::language.validation.password_confirmation.required'),
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
        throw new HttpResponseException(validationErrors($validator->errors()->all()));
    }
}
