@extends('layouts.app')
@section('title', 'Boeking maken')
@section('content')
<link rel="stylesheet" href="{{ asset('css/customer.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-content">

        <div class="dashboard-card" style="max-width:500px;background:linear-gradient(120deg,#fff3e0 60%,#ffcc70 100%);border-radius:32px;box-shadow:0 8px 32px rgba(255,106,136,0.13);padding:38px 44px;">
            <h2 style="color:#ff6a88;font-size:2.2rem;font-weight:800;margin-bottom:18px;letter-spacing:1px;">Boeking maken</h2>
            @if(session('success'))
                <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
            @endif
            <form method="POST" action="/customers/bookings" style="display:flex;flex-direction:column;align-items:center;gap:14px;">
                @csrf
                <div style="width:100%;max-width:340px;display:flex;flex-direction:column;align-items:flex-start;">
                    <label for="festival_id" style="color:#ff6a88;font-weight:600;margin-bottom:4px;">Festival:</label>
                    <select name="festival_id" required style="width: 100%; margin-bottom: 10px; border-radius:14px; padding:10px; background:#fff8f0; font-size:1.08rem; border:1.5px solid #ffcc70;">
                        <option value="">-- Kies een festival --</option>
                        @foreach(App\Models\Festival::all() as $festival)
                            <option value="{{ $festival->id }}">
                                {{ $festival->name }} | {{ $festival->date }} | €{{ $festival->price }}
                            </option>
                        @endforeach
                    </select>
                    <label for="bus_id" style="color:#ff6a88;font-weight:600;margin-bottom:4px;">Bus:</label>
                    <select name="bus_id" required style="width: 100%; margin-bottom: 10px; border-radius:14px; padding:10px; background:#fff8f0; font-size:1.08rem; border:1.5px solid #ffcc70;">
                        <option value="">-- Kies een bus --</option>
                        @foreach(App\Models\Bus::all() as $bus)
                            <option value="{{ $bus->id }}">{{ $bus->name }} {{ $bus->type }}</option>
                        @endforeach
                    </select>
                    <label for="seat_type" style="color:#ff6a88;font-weight:600;margin-bottom:4px;">Stoeltype:</label>
                    <select name="seat_type" required style="width: 100%; margin-bottom: 10px; border-radius:14px; padding:10px; background:#fff8f0; font-size:1.08rem; border:1.5px solid #ffcc70;">
                        <option value="">-- Kies stoeltype --</option>
                        <option value="standaard">Standaard</option>
                        <option value="comfort">Comfort</option>
                        <option value="premium">Premium</option>
                    </select>
                    <label for="seats" style="color:#ff6a88;font-weight:600;margin-bottom:4px;">Aantal kaartjes:</label>
                    <input type="number" name="seats" min="1" value="1" required style="width: 100%; margin-bottom: 10px; border-radius:14px; padding:10px; background:#fff8f0; font-size:1.08rem; border:1.5px solid #ffcc70;">
                    @php
                        $customer = \App\Models\Customer::where('email', Auth::user()->email)->first();
                        $points = $customer->loyalty_points ?? 0;
                    @endphp
                    <label for="loyalty_points" style="color:#ff6a88;font-weight:600;margin-bottom:4px;">Loyalty punten gebruiken:</label>
                    <select name="loyalty_points" style="width: 100%; margin-bottom: 10px; border-radius:14px; padding:10px; background:#fff8f0; font-size:1.08rem; border:none;box-shadow:0 2px 8px rgba(255,106,136,0.07);appearance:none;">
                        <option value="0" style="background:#fff8f0;color:#ff6a88;font-weight:600;">Geen korting</option>
                        @if($points >= 100)
                            <option value="100" style="background:#ffcc70;color:#fff;font-weight:700;">Gebruik 100 punten voor 25% korting</option>
                        @endif
                        @if($points >= 200)
                            <option value="200" style="background:#ff6a88;color:#fff;font-weight:700;">Gebruik 200 punten voor 50% korting</option>
                        @endif
                    </select>
                    <small>Je hebt <strong>{{ $points }}</strong> punten beschikbaar.</small>
                    <label for="remarks" style="color:#ff6a88;font-weight:600;margin-bottom:4px;">Opmerkingen:</label>
                    <textarea name="remarks" rows="2" style="width: 100%; margin-bottom: 10px; border-radius:14px; padding:10px; background:#fff8f0; font-size:1.08rem; border:1.5px solid #ffcc70;"></textarea>
                </div>
                <button type="submit" class="cta-btn boek-btn" style="min-width:140px;border:2px solid #ff6a88;background:#fff;color:#ff6a88;font-weight:bold;box-shadow:0 2px 12px rgba(255,106,136,0.13);transition:border 0.2s,background 0.2s,color 0.2s;">Boek nu</button>
                <a href="/customers/bookings" class="cta-btn" style="min-width:120px;box-shadow:0 2px 8px rgba(255,106,136,0.09);">Terug naar boekingen</a>
            </form>
        </div>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
        <style>
        </style>
    </div>
</div>
@endsection
