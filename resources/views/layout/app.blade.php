<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PriceList') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>
<div id="app">
    <el-row>
        <el-col :span="20" :offset="2">
            @yield('content')
        </el-col>
    </el-row>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

