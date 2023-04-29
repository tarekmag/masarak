<?php

namespace ATPGroup\Drivers\Requests\Admin;

use App\Enums\DriverType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreDriverDocumentRequest extends FormRequest
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
            'driver_id' => 'required',
            "type" => ['required',
                Rule::in(DriverType::DOC_PERSONAA_DRIVING_LICENSE, DriverType::DOC_FEESH_WE_TASHBEEH, DriverType::DOC_DRUG_REPORT)],
            // 'status' => ['required',
            //     Rule::in(DriverType::DOC_PENDING, DriverType::DOC_APPROVED, DriverType::DOC_DECLINED)],
            'document' => 'required',
            'expiration_date' => 'nullable|after:'.now()->format(config('helpers.dateFormat'))
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
            'driver_id.required' => __('driver::language.validation.driver_id.required'),
            'type.required' => __('driver::language.validation.document_type.required'),
            'status.required' => __('driver::language.validation.status.required'),
            'document.required' => __('driver::language.validation.document.required'),
            'expiration_date.required' => __('driver::language.validation.expiration_date.required'),
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
