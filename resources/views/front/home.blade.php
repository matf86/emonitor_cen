@extends('layout.app')

@section('title')
    <title>EMONITOR CEN - aktualne ceny warzyw i owoców</title>
@endsection

@section('content')
    <div class="header-bg">
        <div class="header-nav">
            <nav class="header-nav-items btn-decorator">
                <a href="#markets-list">GIEŁDY</a>
                <a href="" @click.prevent="showContactForm">KONTAKT</a>
            </nav>
        </div>
        <div class="logo-text">
            <h1 class="logo-text-size">E-MONITOR CEN</h1>
            <p>Najświeższe notowania cen produktów spożywczych w sieci</p>
        </div>
        <a href="#info" alt="przejdź do listy giełd"><i class="scroll-down el-icon-arrow-down"></i></a>
    </div>
    <div id="info">
        <el-row>
            <el-col :xs="{span:24}" :sm="{span:12}" :md="{span:6, offset:6}" :lg="{span:4, offset:6}">
                <p class="info-main-text mt-2">Aktualne notowania cen warzyw i owoców z największych polskich giełd...</p>
            </el-col>
            <el-col :xs="{span:24}" :sm="{span:12}" :md="{span:8 , offset:1}" :lg="{span:6}">
                <p class="info-secondary-text mt-2">
                    <span class="logo-font">E-MONITOR CEN</span> powstał w celu gromadzenia oferty cenowej dotyczącej produktów oferowanych na największych w Polsce hurtowych rynkach spożywczych.
                    Gromadzone dane udostępniamy użytkownikom w przystępnej i czytelnej formie. Oprócz udąstepniania bieżących zestawień cen,
                    dajemy równiez możliwośc prześledzenia notowań historycznych.
                </p>
            </el-col>
        </el-row>
    </div>
    <div id="markets-logos">
        <el-row>
            <el-col>
                <h3>Monitorowane rynki hurtowe</h3>
            </el-col>
        </el-row>
        <el-row>
            <el-col class="markets-logs-image mt-2 mb-2" :xs="24" :sm="12" :md="8" :lg="{span:4, offset:2}">
                <img src="/images/wgro_logo-min.png" alt="Wielkopolska Gildia Rolno Ogrodnicza" width="175" height="70">
            </el-col>
            <el-col class="markets-logs-image mt-2 mb-2" :xs="24" :sm="12" :md="8" :lg="{span:4, offset:0}">
                <img src="/images/zjazdowa_logo-min.png" alt='Łódzki Rynek Hurtowy Zjazdowa" S.A' width="175" height="70">
            </el-col>
            <el-col class="markets-logs-image mt-2 mb-2" :xs="24" :sm="12" :md="8" :lg="{span:4, offset:0}">
                <img src="/images/elizowka_logo-min.png" alt="Lubelski Rynek Hurtowy w Elizówce" width="175" height="70">
            </el-col>
            <el-col class="markets-logs-image mt-2 mb-2" :xs="24" :sm="12" :md="{span:8, offset:4}" :lg="{span:4, offset:0}">
                <img src="/images/agrohurt_logo-min.png" alt='Podkarpackie Centrum Hurtowe "Agrohurt" S.A' width="175" height="70">
            </el-col>
            <el-col class="markets-logs-image mt-2 mb-2" :xs="24" :sm="{span:12, offset:6}" :md="{span:8, offset:0}" :lg="{span:4, offset:0}">
                <img src="/images/bronisze_logo-min.png" alt="Warszawski Rolno-Spożywczy Rynek Hurtowy S.A" width="175" height="70">
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
@endsection

@section('additional-scripts')
    <script>
        var onloadCallback = function() {
            window.app.$refs.contactForm.loadCaptcha();
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=pl" async defer></script>
@endsection