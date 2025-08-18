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
    <div class="hero-content">
        <form class="auth-form" method="POST" action="{{ route('register') }}">
            @csrf
            <h2>Registreren</h2>
            <label for="name">Naam</label>
            <input type="text" id="name" name="name" required autofocus>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required>
            <label for="password_confirmation">Herhaal wachtwoord</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            <button type="submit" class="cta-btn">Registreren</button>
        </form>
        <div style="margin-top:18px;">
            <a href="{{ route('login') }}" class="cta-btn">Al een account? Login</a>
        </div>
    </div>
</div>
@endsection
