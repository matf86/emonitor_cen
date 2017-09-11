@extends('layout.app')

@section('content')
    <el-row type="flex"  justify="space-between" style="margin-top: 15px;">
        <el-col :span="2">
            <vertical-nav></vertical-nav>
        </el-col>
        <el-col :span="22">
            <offer-manager></offer-manager>
        </el-col>
    </el-row>
@endsection
