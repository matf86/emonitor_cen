<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexOffersStats extends FormRequest
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
            'markets' => 'array',
            'dateRange' => 'array|size:2',
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
            'markets.array' => 'Błędny parametr :attribute. Akceptowany typ: array.',
            'markets.*' => 'Błędny parametr :attribute. Akceptowany format string.',
            'dateRange.array' => 'Błędny parametr :attribute. Akceptowany typ: array.',
            'dateRange.size' => 'Błędny parametr :attribute. Przekazana tablica musi zawierać :size wartości.',
            'dateRange.*.date_format' => 'Błędny parametr :attribute. Akceptowany format daty: :format.',
        ];
    }
}
