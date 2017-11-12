<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendContactForm extends FormRequest
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
            'form.name' => 'required|string',
            'form.secondName' => 'required|string',
            'form.msgBody' => 'required|string',
            'form.email' => 'required|email',
            'g-recaptcha-response' => 'required|recaptcha'
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
            'form.name.required' => 'Parametr :attribute jest wymagany.',
            'form.secondName.required' => 'Parametr :attribute jest wymagany.',
            'form.msgBody.required' => 'Parametr :attribute jest wymagany.',
            'form.email.required' => 'Parametr :attribute jest wymagany.',
            'form.email.email' => 'Parametr :attribute jest nieprawidłowy.',
            'g-recaptcha-response.required' => 'Parametr :attribute jest wymagany.',
            'g-recaptcha-response.recaptcha' => 'Parametr :attribute jest nieprawidłowy.',
        ];
    }
}
