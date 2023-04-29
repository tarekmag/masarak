<?php

namespace ATPGroup\Languages\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreLanguageRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('languages', 'name')->ignore($this->language),
            ],
            'symbol' => [
                'required',
                Rule::unique('languages', 'symbol')->ignore($this->language),
            ],
            'symbol' => 'min:2|max:2',
            'direction' => 'required|in:rtl,ltr',
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
            'name.required' => __('language::language.validation.name.required'),
            'name.unique' => __('language::language.validation.name.unique'),
            'symbol.required' => __('language::language.validation.symbol.required'),
            'symbol.unique' => __('language::language.validation.symbol.unique'),
            'symbol.min' => __('language::language.validation.symbol.min'),
            'symbol.max' => __('language::language.validation.symbol.max'),
            'direction.required' => __('language::language.validation.direction.required'),
            'direction.in' => __('language::language.validation.direction.in'),
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
