@extends('layout.app')

@section('content')
    <el-row type="flex"  justify="space-between" class="mt-1">
        <el-col :span="2">
            <vertical-nav></vertical-nav>
        </el-col>
        <el-col :span="22">
            @yield('dashboard')
        </el-col>
    </el-row>
@endsection