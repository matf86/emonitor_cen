@extends('layout.app')

@section('title')
    <title>{{$market->name}} | aktualne ceny warzyw i owoców</title>
@endsection

@section('content')
    <offer-showcase :market-data="{{$market}}"></offer-showcase>
@endsection