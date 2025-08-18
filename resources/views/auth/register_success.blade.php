@extends('layouts.app')
@section('title', 'Registratie Succesvol')
@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-title">Festival Travel System</div>
    <div class="hero-subtitle" style="color:#fff;font-size:1.25rem;font-weight:500;margin-bottom:18px;animation:fadeIn 1.2s 0.7s both;">Welkom bij de FTS-community!</div>
    <div class="hero-content">
        <div class="registration-complete" style="margin-top:38px;padding:24px 18px;background:#fff6f6;border-radius:18px;box-shadow:0 2px 12px rgba(255,106,136,0.08);max-width:400px;margin-left:auto;margin-right:auto;">
            <h3 style="color:#ff6a88;font-size:1.35rem;font-weight:700;margin-bottom:10px;">Registratie succesvol afgerond!</h3>
            <p style="color:#333;font-size:1.08rem;">Je account is aangemaakt.<br>Je kunt nu direct inloggen en je festivalreis plannen.<br>Veel plezier bij Festival Travel System! 🎉</p>
            <a href="{{ route('login') }}" class="cta-btn" style="margin-top:18px;">Naar login</a>
            <a href="/" class="cta-btn" style="margin-top:8px;background:#ffcc70;color:#fff;">Terug naar home</a>
        </div>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
    </div>
</div>
@endsection
