<el-menu mode="horizontal">
    <el-menu-item index="1"><a href="{{route('home')}}">PriceMonitor</a></el-menu-item>
    <el-submenu index="2">
        <template slot="title">Giełdy</template>
        <el-menu-item index="2-1"><a href="{{route('offers', ['slug' => 'wgro'])}}">Wielkopolska Gildia Rolno-Ogrodnicza</a></el-menu-item>
        <el-menu-item index="2-2"><a href="{{route('offers', ['slug' => 'lrh'])}}">Łódzki Rynek Hurtowy</a></el-menu-item>
    </el-submenu>
    @if(Auth()->check() && (strpos(Route::current()->uri,'dashboard') === false))
        <el-menu-item style="position: absolute; right: 2%;" index="3"><a href="{{route('dashboard')}}">Dashboard</a></el-menu-item>
    @endif
</el-menu>