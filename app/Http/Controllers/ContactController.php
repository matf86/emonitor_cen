<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactForm;
use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(SendContactForm $request)
    {
        Mail::to('mateusz.fludra@gmail.com')->queue((new ContactForm($request->json()->get('form')))->onConnection('rabbitmq')->onQueue('emails'));
    }
}
