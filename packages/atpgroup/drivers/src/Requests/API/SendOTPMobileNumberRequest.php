<?php

namespace ATPGroup\Drivers\Requests\API;

use App\Enums\DeviceTokenType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SendOTPMobileNumberRequest extends FormRequest
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
            'mobile_number' => 'required|unique:drivers,mobile_number',
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
            'mobile_number.unique' => __('driver::language.validation.mobile_number.unique'),
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
