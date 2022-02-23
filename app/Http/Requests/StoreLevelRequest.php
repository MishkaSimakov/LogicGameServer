<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLevelRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'allowed_components' => ['required', 'array'],
            'inputs' => ['required', 'array'],
            'outputs' => ['required', 'array'],
            'test_inputs' => ['nullable', 'array'],
            'test_outputs' => ['nullable', 'array'],
            'visible_tests_count' => ['required', 'integer', 'min:0']
        ];
    }
}
