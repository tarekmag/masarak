<?php

namespace ATPGroup\Drivers\Requests\Admin;

use App\Enums\DriverType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreDriverRequest extends FormRequest
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
            'name' => 'required',
            'mobile_number' => 'required|digits:11|unique:drivers,mobile_number,'.optional($this->driver)->id,
            'personal_photo' => 'nullable',
            "type" => ['required', Rule::in(DriverType::INDIVIDUAL, DriverType::SUPPLIER)]
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
            'name.required' => __('driver::language.validation.name.required'),
            'mobile_number.required' => __('driver::language.validation.mobile_number.required'),
            'mobile_number.unique' => __('driver::language.validation.mobile_number.unique'),
            'mobile_number.digits' => __('driver::language.validation.mobile_number.invalid'),
            'personal_photo.required' => __('driver::language.validation.personal_photo.required'),
            'type.required' => __('driver::language.validation.type.required'),
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
