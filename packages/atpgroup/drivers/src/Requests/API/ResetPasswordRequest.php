<?php

namespace ATPGroup\Drivers\Requests\API;

use App\Enums\DeviceTokenType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
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
            'mobile_number' => 'required|exists:drivers,mobile_number',
            'otp_code' => 'required|numeric',
            'password' => 'required|required_with:password_confirmation|string|min:4|confirmed',
            'device_token' => 'required',
            'device_type' => ['required', Rule::in(DeviceTokenType::ANDROID, DeviceTokenType::IOS)],
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
            'mobile_number.required' => __('driver::language.validation.mobile_number.required'),
            'mobile_number.exists' => __('driver::language.validation.mobile_number.exists'),
            'otp_code.required' => __('driver::language.validation.otp_code.required'),
            'otp_code.numeric' => __('driver::language.validation.otp_code.numeric'),
            'password.required' => __('driver::language.validation.password.required'),
            'password.min' => __('driver::language.validation.password.min'),
            'password_confirmation.required' => __('driver::language.validation.password_confirmation.required'),
            'confirmed.required' => __('driver::language.validation.confirmed.required'),
            'device_token.required' => __('driver::language.validation.device_token.required'),
            'device_type.required' => __('driver::language.validation.device_type.required'),
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
