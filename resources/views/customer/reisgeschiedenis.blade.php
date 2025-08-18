@extends('layouts.app')
@section('title', 'Reisgeschiedenis')
@section('content')
<link rel="stylesheet" href="{{ asset('css/customer.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-content">
        <div class="dashboard-card" style="max-width:520px;">
            <h2 style="color:#ff6a88;font-size:2rem;font-weight:700;">Reisgeschiedenis</h2>
            @if (!Auth::check())
                <p style="margin-bottom:18px;">Je moet ingelogd zijn om je reisgeschiedenis te bekijken.</p>
                <a href="{{ route('login') }}" class="cta-btn" style="min-width:140px;">Inloggen</a>
            @else
                <ul style="text-align:left;margin-bottom:18px;list-style:none;padding:0;">
                @forelse(Auth::user()->bookings as $booking)
                    <li style="background:#fff;border-radius:10px;padding:10px 16px;margin-bottom:8px;box-shadow:0 2px 8px rgba(255,106,136,0.07);color:#333;">
                        <strong>{{ $booking->festival->name }}</strong> <span style="color:#ffcc70;">•</span> {{ $booking->booked_at }} <span style="color:#ffcc70;">•</span> {{ $booking->status }} <span style="color:#ffcc70;">•</span> Kaartjes: {{ $booking->seats }}
                    </li>
                @empty
                    <li style="color:#ff6a88;">Geen boekingen gevonden.</li>
                @endforelse
                </ul>
            @endif
            <a href="/dashboard" class="cta-btn" style="min-width:120px;">Terug naar dashboard</a>
        </div>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
    </div>
</div>
@endsection
