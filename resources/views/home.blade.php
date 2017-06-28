@extends('layout.app')

@section('content')
    <div style="margin-top: 20%">
        <el-row>
            <h1 class="center">Cennik warzyw i owoców</h1>
        </el-row>
        <el-row :gutter="20">
            <el-col :xs="24" :sm="24" :md="12" :lg="12">
                <el-card :body-style="{ padding: '10px'}">
                    <div class="center">
                        <el-button type="text" class="button"><a href="{{ route('offers', ['slug' => 'wgro']) }}">Wielkopolska Giełda Rolno Ogrodnicza</a></el-button>
                    </div>
                </el-card>
            </el-col>
            <el-col :xs="24" :sm="24" :md="12" :lg="12">
                <el-card :body-style="{ padding: '10px' }">
                    <div class="center">
                        <el-button type="text" class="button"><a href="{{ route('offers', ['slug' => 'lrh']) }}">Łódzki Rynek Hurtowy</a></el-button>
                    </div>
                </el-card>
            </el-col>
        </el-row>
    </div>
@endsection