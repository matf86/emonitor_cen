<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Mogra&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-EvHFWq7GkFpW0Z3_CQJx1xXpUTboSfs"></script>
    <script src="https://use.fontawesome.com/9d260f9c97.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app" v-cloak>
    @if(Route::current()->getName() !=='home')
        @include('layout.nav')
    @endif
    @yield('content')
</div>
@include('layout.footer')
<script src="{{ mix('js/app.js') }}"></script>
@yield('additional-scripts')
</body>
</html>

