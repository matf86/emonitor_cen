@extends('layout.app')

@section('content')
    <div class="header-bg">
        <div class="header-nav">
            <nav class="header-nav-items btn-decorator">
                <a href="#markets-list">GIEŁDY</a>
                <a href="#" @click="showContactForm">KONTAKT</a>
            </nav>
        </div>
        <div class="logo-text">
            <h1 class="logo-text-size">E-MONITOR CEN</h1>
            <p>Najświeższe notowania cen produktów spożywczych w sieci</p>
        </div>
        <a href="#divider" alt="przejdź do listy giełd"><i class="scroll-down el-icon-arrow-down"></i></a>
    </div>
    <div id="divider">
        <el-row>
            <el-col :xs="{span:24}" :sm="{span:12}" :md="{span:6, offset:6}" :lg="{span:4, offset:6}">
                <p class="divider-main-text mt-2">Aktualne notowania cen warzyw i owoców z największych polskich giełd...</p>
            </el-col>
            <el-col :xs="{span:24}" :sm="{span:12}" :md="{span:8 , offset:1}" :lg="{span:6}">
                <p class="divider-secondary-text mt-2">Witam w naszym serwise.
                    <span class="logo-font">MONITOR CEN</span> powstał w celu gromadzenia oferty cenowej dotyczącej produktów oferowanych na największych w Polsce hurtowych rynkach spożywczych.
                    Gromadzone dane udostępniamy użytkownikom w przystępnej i czytelnej formie. Oprócz udąstepniania bieżących zestawien cenn,
                    dajemy równiez możliwośc prześledzenia cen historycznych.
                </p>
            </el-col>
        </el-row>
    </div>
    <div id="markets-logs">
        <el-row>
            <el-col>
                <h3>Monitorowane rynki hurtowe</h3>
            </el-col>
        </el-row>
        <el-row>
            <el-col class="markets-logs-image mt-2 mb-2" :xs="24" :sm="12" :md="12" :lg="6">
                <img src="/images/wgro_logo-min.png" alt="" width="225" height="75">
            </el-col>
            <el-col class="markets-logs-image mt-2 mb-2" :xs="24" :sm="12" :md="12" :lg="6">
                <img src="/images/zjazdowa_logo-min.png" alt="" width="225" height="75">
            </el-col>
            <el-col class="markets-logs-image mt-2 mb-2" :xs="24" :sm="12" :md="12" :lg="6">
                <img src="/images/elizowka_logo-min.png" alt="" width="225" height="75">
            </el-col>
            <el-col class="markets-logs-image mt-2 mb-2" :xs="24" :sm="12" :md="12" :lg="6">
                <img src="/images/agrohurt_logo-min.png" alt="" width="225" height="75">
            </el-col>
        </el-row>
    </div>
    <div id="markets-list">
        <el-row :gutter="10">
            @foreach($markets as $market)
                <market-box :data="{{$market}}"></market-box>
            @endforeach
        </el-row>
    </div>
    <contact-form ref="contactForm"></contact-form>
    <footer>
        <div class="footer-date">
            <p>{{ date('Y') }} - kontak@emonitorcen.pl</p>
        </div>
    </footer>
@endsection

@section('additional-scripts')
    <script>
        var onloadCallback = function() {
            window.app.$refs.contactForm.loadCaptcha();
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=pl" async defer></script>
@endsection