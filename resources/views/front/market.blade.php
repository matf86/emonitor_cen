@extends('layout.app')

@section('content')
    <offer-showcase :market-data="{{$market}}"></offer-showcase>
@endsection