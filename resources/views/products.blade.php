@extends('layout.app')

@section('content')
    <el-row>
        <h1>{{ $products[0]['place'] }}</h1>
        <div>
            <p>Miasto: {{$products[0]['city']}}</p>
        </div>
        <hr/>
    </el-row>
    <el-row>
        <price-list :products="{{ $products }}"></products-table>
    </el-row>
@endsection