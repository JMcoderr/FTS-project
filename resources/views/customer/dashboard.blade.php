@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<link rel="stylesheet" href="{{ asset('css/customer.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-title" style="font-size:2.8rem;letter-spacing:2px;text-shadow:0 2px 16px rgba(255,106,136,0.18);margin-bottom:0.5rem;animation:fadeInDown 1.2s cubic-bezier(.77,0,.175,1);">
        Welkom <span style="color:#ffcc70;font-weight:900;text-transform:uppercase;">{{ Auth::user()->name }}</span>! <span style="font-size:2rem;">🎉</span>
    </div>
    <div class="hero-subtitle" style="color:#fff;font-size:1.18rem;font-weight:500;margin-bottom:18px;animation:fadeIn 1.2s 0.7s both;">Jouw persoonlijke festival dashboard</div>
    <div class="hero-content">
        <div class="dashboard-card" style="max-width:520px;">
            <h2><span style="font-size:1.5rem;">🗂️</span> Festival Overzicht</h2>
            <p>Bekijk je boekingen, loyaliteitspunten en aankomende festivals.<br>Alles wat je nodig hebt voor jouw festivalreis vind je hier!</p>
            <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-bottom:18px;">
                <a href="/customers/bookings" class="cta-btn" style="min-width:140px;">Mijn boekingen</a>
                <a href="{{ route('customer.festivals') }}" class="cta-btn" style="min-width:140px;">Festivals</a>
                <a href="/profile" class="cta-btn" style="min-width:140px;">Profiel</a>
                <a href="/reisgeschiedenis" class="cta-btn" style="min-width:140px;">Reisgeschiedenis</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:18px;">
                @csrf
                <button type="submit" class="cta-btn logout-btn" style="background:#fff;color:#ff6a88;border:2px solid #ffcc70;font-weight:bold;min-width:140px;transition:border 0.2s,background 0.2s,color 0.2s;">Uitloggen</button>
            </form>
        </div>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
    </div>
</div>
@endsection
