<?php

namespace ATPGroup\Routes\Requests\Admin;

use App\Enums\RouteType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRouteRequest extends FormRequest
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
            'company_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            "type" => ['sometimes', 'nullable', Rule::in([
                RouteType::ECONOMY,
                RouteType::BUSINESS,
            ])],
            'from_en' => 'required',
            'from_ar' => 'required',
            'to_en' => 'required',
            'to_ar' => 'required',
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
            'company_id.required' => __('route::language.validation.company_id.required'),
            'branch_id.required' => __('route::language.validation.branch_id.required'),
            'type.required' => __('route::language.validation.type.required'),
            'from_en.required' => __('route::language.validation.from_en.required'),
            'from_ar.required' => __('route::language.validation.from_ar.required'),
            'to_en.required' => __('route::language.validation.to_en.required'),
            'to_ar.required' => __('route::language.validation.to_ar.required'),
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
