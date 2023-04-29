<?php

namespace ATPGroup\Routes\Requests\Admin;

use App\Services\TripService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateTripRequest extends FormRequest
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
            'client_price' => 'required',
            'driver_price' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            'supplier_id' => 'sometimes|nullable|numeric',
            'driver_id' => 'required|numeric',
            'vehicle_id' => 'required|numeric',
            'status' => 'required',
            'status_action_reasons' => 'required_if:status,' . implode(',', app(TripService::class)->getStatusOfReasonsTrip()),
            'class' => 'required',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (auth()->user()->company_id) {
            $this->merge([
                'driver_price' => $this->trip->driver_price,
            ]);
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'client_price.required' => __('route::language.validation.client_price.required'),
            'driver_price.required' => __('route::language.validation.driver_price.required'),
            'start_date.required' => __('route::language.validation.start_date.required'),
            'start_time.required' => __('route::language.validation.start_time.required'),
            'driver_id.required' => __('route::language.validation.driver_id.required'),
            'vehicle_id.required' => __('route::language.validation.vehicle_id.required'),
            'status.required' => __('route::language.validation.status.required'),
            'status_action_reasons.required_if' => __('route::language.validation.status_action_reasons.required_if'),
            'class.required' => __('route::language.validation.class.required'),
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
