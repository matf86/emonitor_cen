<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexMarketLogs extends FormRequest
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

    public function rules()
    {
        return [
            'dateRange' => 'array',
            'dateRange.*' => 'date_format:"Y-m-d"',
            'categories' => 'array',
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
            'categories.array' => 'Błędny parametr :attribute. Akceptowany typ: array.',
            'dateRange.array' => 'Błędny parametr :attribute. Akceptowany typ: array.',
            'dateRange.*.date_format' => 'Błędny parametr :attribute. Akceptowany format :format.',
        ];
    }
}
