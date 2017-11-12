<?php

namespace App\Validators;

use Zttp\Zttp;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $response = Zttp::asFormParams()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        return $response->json()['success'];
    }

}