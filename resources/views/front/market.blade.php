@extends('layout.app')

@section('title')
    <title>{{$market->name}} | aktualne ceny warzyw i owoców</title>
@endsection

@section('description')
    <meta name="description" content="{{$market->name}} aktualny cennik | cennik warzyw i owoców | {{$market->city}} aktualne ceny warzyw | {{$market->city}} aktualne ceny owoców.">
@endsection

@section('content')
    <offer-showcase :market-data="{{$market}}"></offer-showcase>
@endsection