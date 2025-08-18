
@extends('layouts.app')
@section('title', 'Mijn Profiel')
@section('content')
<link rel="stylesheet" href="{{ asset('css/customer.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-content">
    <div class="dashboard-card profile-card" style="max-width:520px;box-shadow:0 8px 32px rgba(255,106,136,0.13);border-radius:32px;padding:38px 44px;">
            @if (!Auth::check())
                <h2 style="color:#ff6a88;font-size:2rem;font-weight:700;">Niet ingelogd</h2>
                <p style="margin-bottom:18px;">Je moet ingelogd zijn om je profiel te bekijken.</p>
                <a href="{{ route('login') }}" class="cta-btn" style="min-width:140px;">Inloggen</a>
            @else
                <h2 style="color:#ff6a88;font-size:2.2rem;font-weight:800;margin-bottom:10px;letter-spacing:1px;"><span style="font-size:1.7rem;">👤</span> Mijn Profiel</h2>
                <div style="margin-bottom:22px;display:flex;flex-direction:column;align-items:center;gap:10px;">
                    <div style="background:linear-gradient(90deg,#ffcc70 0%,#ff6a88 100%);border-radius:18px;padding:14px 22px;box-shadow:0 2px 16px rgba(255,106,136,0.09);color:#fff;width:100%;max-width:340px;display:flex;flex-direction:column;align-items:center;">
                        <span style="font-size:1.15rem;font-weight:800;letter-spacing:1px;">Welkom,</span>
                        <span style="color:#fff;font-weight:900;text-transform:uppercase;font-size:1.08rem;">{{ Auth::user()->name }}</span>
                    </div>
                    <div style="background:#fff3e0;border-radius:14px;padding:10px 18px;box-shadow:0 2px 8px rgba(255,106,136,0.07);color:#ff6a88;width:100%;max-width:340px;display:flex;flex-direction:column;align-items:center;">
                        <span style="font-weight:700;">Email</span>
                        <span style="color:#333;font-size:1.05rem;">{{ Auth::user()->email }}</span>
                        <span style="font-weight:700;margin-top:6px;">Rol</span>
                        <span style="color:#333;font-size:1.05rem;">{{ Auth::user()->role }}</span>
                    </div>
                </div>
                @php
                    $customer = \App\Models\Customer::where('email', Auth::user()->email)->first();
                @endphp
                <div style="margin-bottom:22px;background:#fff3e0;border-radius:14px;padding:12px 18px;box-shadow:0 2px 8px rgba(255,106,136,0.07);color:#ff6a88;font-weight:700;">
                    <span style="color:#ffcc70;font-weight:700;">Loyalty punten:</span> {{ $customer->loyalty_points ?? 0 }}
                </div>
                <h3 style="color:#ff6a88;font-size:1.18rem;font-weight:700;margin-bottom:10px;">Profiel wijzigen</h3>
                <form method="POST" action="/profile/update" style="margin-bottom:16px;display:flex;flex-direction:column;align-items:center;gap:12px;">
                    @csrf
                    <div style="width:100%;max-width:340px;display:flex;flex-direction:column;align-items:flex-start;">
                        <label style="color:#ff6a88;font-weight:600;margin-bottom:4px;">Naam:</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" required style="padding:10px 18px;border-radius:12px;border:1.5px solid #ffcc70;margin-bottom:10px;width:100%;background:#fff8f0;font-size:1.08rem;">
                        <label style="color:#ff6a88;font-weight:600;margin-bottom:4px;">Nieuw wachtwoord:</label>
                        <input type="password" name="password" style="padding:10px 18px;border-radius:12px;border:1.5px solid #ffcc70;margin-bottom:10px;width:100%;background:#fff8f0;font-size:1.08rem;">
                    </div>
                    <button type="submit" class="cta-btn" style="min-width:140px;border:2px solid #ff6a88;background:#fff;color:#ff6a88;font-weight:bold;box-shadow:0 2px 12px rgba(255,106,136,0.13);transition:border 0.2s,background 0.2s,color 0.2s;">Opslaan</button>
                </form>
                <div style="display:flex;gap:14px;justify-content:center;">
                    <a href="/dashboard" class="cta-btn" style="min-width:120px;box-shadow:0 2px 8px rgba(255,106,136,0.09);">Terug</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="cta-btn logout-btn" style="background:#fff;color:#ff6a88;border:2px solid #ffcc70;font-weight:bold;min-width:120px;box-shadow:0 2px 8px rgba(255,106,136,0.09);">Uitloggen</button>
                    </form>
                </div>
            @endif
        </div>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
    </div>
</div>
@endsection
