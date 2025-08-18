<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')
@section('title', 'Login')
@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-title">Festival Travel System</div>
    <div class="hero-subtitle" style="color:#fff;font-size:1.25rem;font-weight:500;margin-bottom:18px;animation:fadeIn 1.2s 0.7s both;">Welkom terug! Log in om je festivalreis te starten 🎉</div>
    <div class="hero-content">
        @if (session('error'))
            <div class="auth-error" style="background:#fff6f6;color:#ff6a88;border-radius:14px;padding:14px 18px;margin-bottom:18px;box-shadow:0 2px 8px rgba(255,106,136,0.10);font-size:1.08rem;font-weight:600;">
                <span style="font-size:1.3rem;">⚠️</span> {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="auth-error" style="background:#fff6f6;color:#ff6a88;border-radius:14px;padding:14px 18px;margin-bottom:18px;box-shadow:0 2px 8px rgba(255,106,136,0.10);font-size:1.08rem;font-weight:600;">
                <span style="font-size:1.3rem;">⚠️</span> Controleer je invoer en probeer opnieuw.
            </div>
        @endif
        <form class="auth-form" method="POST" action="{{ route('login') }}">
            @csrf
            <h2><span style="font-size:1.5rem;">🔐</span> Login</h2>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required autofocus>
            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="cta-btn login-btn">Login</button>
            <div style="margin:18px 0 8px 0;width:100%;border-bottom:1px solid #ffcc70;"></div>
            <div style="font-size:0.98rem;color:#ff6a88;margin-bottom:8px;">Nog geen account?</div>
            <a href="{{ route('register') }}" class="cta-btn">Registreren</a>
        </form>
        <a href="/" class="cta-btn home-btn" style="margin-top:18px;">Terug naar home</a>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
    </div>
</div>
@endsection
