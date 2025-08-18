<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')
@section('title', 'Registreren')
@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-title">Festival Travel System</div>
    <div class="hero-subtitle" style="color:#fff;font-size:1.25rem;font-weight:500;margin-bottom:18px;animation:fadeIn 1.2s 0.7s both;">Word lid van de FTS-community en beleef festivals samen! 🎶</div>
    <div class="hero-content">
        @if ($errors->has('email'))
            <div class="auth-error" style="background:#fff6f6;color:#ff6a88;border-radius:14px;padding:14px 18px;margin-bottom:18px;box-shadow:0 2px 8px rgba(255,106,136,0.10);font-size:1.08rem;font-weight:600;">
                <span style="font-size:1.3rem;">⚠️</span> Er bestaat al een account met dit e-mailadres.<br>Probeer in te loggen of gebruik een ander e-mailadres.
            </div>
        @endif
        <form class="auth-form" method="POST" action="{{ route('register') }}">
            @csrf
            <h2><span style="font-size:1.5rem;">📝</span> Registreren</h2>
            <label for="name">Naam</label>
            <input type="text" id="name" name="name" required autofocus>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required>
            <label for="password_confirmation">Herhaal wachtwoord</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            <button type="submit" class="cta-btn">Registreren</button>
            <div style="margin:18px 0 8px 0;width:100%;border-bottom:1px solid #ffcc70;"></div>
            <div style="font-size:0.98rem;color:#ff6a88;margin-bottom:8px;">Al een account?</div>
            <a href="{{ route('login') }}" class="cta-btn">Login</a>
        </form>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
    </div>
</div>
@endsection
