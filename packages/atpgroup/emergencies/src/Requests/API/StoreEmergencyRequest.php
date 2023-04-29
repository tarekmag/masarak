<?php

namespace ATPGroup\Emergencies\Requests\API;

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
            'emergency_id' => 'required|exists:emergencies,id',
            'trip_id' => 'nullable',
            'trip_name' => 'nullable',
            'driver_name' => 'required',
            'message' => 'required',
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
            'emergency_id.required' => __('emergency::language.validation.emergency_id.required'),
            'emergency_id.exists' => __('emergency::language.validation.emergency_id.exists'),
            'trip_id.required' => __('emergency::language.validation.trip_id.required'),
            'driver_name.required' => __('emergency::language.validation.driver_name.required'),
            'message.required' => __('emergency::language.validation.message.required'),
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
