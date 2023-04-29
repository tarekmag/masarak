<?php

namespace ATPGroup\Routes\Requests\API;

use App\Enums\RouteType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use ATPGroup\Routes\Rules\CheckIfTripExists;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TripChangeStatusRequest extends FormRequest
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
            "trip_id" => ["required", new CheckIfTripExists($this)],
            "status" => ['required', Rule::in([
                RouteType::TRIP_STATUS_STARTED, 
                RouteType::TRIP_STATUS_COMPLETED, 
            ])],
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
            'trip_id.required' => __('route::language.validation.trip_id.required'),
            'status.required' => __('route::language.validation.status.required'),
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
