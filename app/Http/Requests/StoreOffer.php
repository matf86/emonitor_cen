<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOffer extends FormRequest
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
            'product' => 'required|string|max:256|min:3',
            'type' => ['required',  Rule::in(['owoce', 'warzywa', 'grzyby', 'bakalie'])],
            'origin' => ['required',  Rule::in(['kraj', 'import'])],
            'package' => 'required',
            'price_min' => 'required|numeric',
            'price_max' => 'required|numeric',
            'date' => 'required|date_format:"Y-m-d"',
            'market_id' => 'required|exists:markets,_id'
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
            'package.required' => 'Parametr :attribute jest wymagany.',
            'price_min.numeric' => 'Parametr :attribute jest wymagany.',
            'price_max.numeric' => 'Parametr :attribute jest wymagany.',
            'date.date_format' => 'Błędny parametr :attribute. Akceptowany format :format.',
        ];
    }
}
