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
                <div style="overflow-x:auto;margin-bottom:18px;">
                <table style="width:100%;max-width:480px;margin:0 auto;border-collapse:separate;border-spacing:0;background:#fff;border-radius:18px;box-shadow:0 4px 18px rgba(255,106,136,0.11);overflow:hidden;font-size:1.04rem;">
                    <thead style="background:linear-gradient(90deg,#ffcc70 0%,#ff6a88 100%);color:#fff;font-size:1.08rem;">
                        <tr>
                            <th style="padding:10px 8px;">Festival</th>
                            <th style="padding:10px 8px;">Datum</th>
                            <th style="padding:10px 8px;">Status</th>
                            <th style="padding:10px 8px;">Aantal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr style="text-align:center;">
                            <td style="padding:8px 6px;font-weight:600;">{{ $booking->festival->name ?? '-' }}</td>
                            <td style="padding:8px 6px;">{{ $booking->booked_at ? $booking->booked_at->format('d-m-Y') : '-' }}</td>
                            <td style="padding:8px 6px;">
                                @if($booking->status === 'bevestigd' || $booking->status === 'Bevestigd')
                                    <span style="color:green;font-weight:bold;display:inline-flex;align-items:center;gap:4px;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="12" fill="#fff"/><path d="M7 13l3 3 7-7" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>Bevestigd</span>
                                @elseif($booking->status === 'cancelled' || $booking->status === 'Geannuleerd')
                                    <span style="color:#ff6a88;font-weight:bold;display:inline-flex;align-items:center;gap:4px;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="12" fill="#fff"/><path d="M6 12l6 6 6-6" stroke="#ff6a88" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>Geannuleerd</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td style="padding:8px 6px;">{{ $booking->seats }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" style="color:#ff6a88;padding:12px 0;text-align:center;">Geen boekingen gevonden.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            @endif
            <a href="/dashboard" class="cta-btn" style="min-width:120px;">Terug naar dashboard</a>
        </div>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
    </div>
</div>
@endsection
