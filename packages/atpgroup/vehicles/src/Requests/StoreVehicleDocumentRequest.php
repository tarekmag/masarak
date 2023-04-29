<?php

namespace ATPGroup\Vehicles\Requests;

use App\Enums\VehicleType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreVehicleDocumentRequest extends FormRequest
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
            'vehicle_id' => 'required',
            "type" => ['required', 
                Rule::in(VehicleType::DOC_LICENSE, VehicleType::DOC_FA7S)],
            // 'status' => ['required',
            //     Rule::in(VehicleType::DOC_PENDING, VehicleType::DOC_APPROVED, VehicleType::DOC_DECLINED)],
            'document' => 'required',
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
            'vehicle_id.required' => __('vehicle::language.validation.vehicle_id.required'),
            'type.required' => __('vehicle::language.validation.document_type.required'),
            'status.required' => __('vehicle::language.validation.status.required'),
            'document.required' => __('vehicle::language.validation.document.required'),
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
