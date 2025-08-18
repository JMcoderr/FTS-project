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
    <div class="hero-content">
        <form class="auth-form" method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Login</h2>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required autofocus>
            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="cta-btn">Login</button>
        </form>
        <div style="margin-top:18px;">
            <a href="{{ route('register') }}" class="cta-btn">Nog geen account? Registreren</a>
        </div>
    </div>
</div>
@endsection
