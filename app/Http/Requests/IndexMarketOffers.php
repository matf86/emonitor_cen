<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexMarketOffers extends FormRequest
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
            'date' => 'date_format:"Y-m-d"',
            'dateRange' => 'array',
            'dateRange.*' => 'date_format:"Y-m-d"'
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
            'date.date_format' => 'Błędny parametr :attribute. Akceptowany format :format.',
            'dateRange.array' => 'Błędny parametr :attribute. Akceptowany typ: array.',
            'dateRange.*.date_format' => 'Błędny parametr :attribute. Akceptowany format :format.',
        ];
    }
}
