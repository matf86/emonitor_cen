@component('mail::message')
Otrzymałeś nową wiadmosć poprzez formularz kontaktowy:

<p>Nadawca: {{$message['name']}} {{$message['secondName']}}</p>
<p>Email nadawcy: {{$message['email']}}<p>

<p>Treść wiadomości:</p>
<p>{{$message['msgBody']}}</p>

{{ config('app.name') }}
@endcomponent
