<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOffer extends FormRequest
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
            'product' => 'string|max:256|min:3',
            'type' => [Rule::in(['owoce', 'warzywa', 'grzyby', 'bakalie'])],
            'origin' => [Rule::in(['kraj', 'import'])],
            'price_min' => 'numeric',
            'price_max' => 'numeric',
            'date' => 'date_format:"Y-m-d"',
            'market_id' => 'exists:markets,_id'
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
            'product.string' => 'Błędny parametr :attribute.',
            'type.in' => 'Błędny parametr :attribute.',
            'origin.in' => 'Błędny parametr :attribute.',
            'price_min.numeric' => 'Parametr :attribute jest wymagany.',
            'price_max.numeric' => 'Parametr :attribute jest wymagany.',
            'date.date_format' => 'Błędny parametr :attribute. Akceptowany format :format.',
        ];
    }
}
