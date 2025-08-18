@extends('layouts.app')
@section('title', 'Mijn Boekingen')
@section('content')
<link rel="stylesheet" href="{{ asset('css/customer.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-content">
        <div class="dashboard-card" style="max-width:1100px;background:linear-gradient(120deg,#fff3e0 60%,#ffcc70 100%);border-radius:40px;box-shadow:0 12px 48px rgba(255,106,136,0.15);padding:54px 60px;">
            <h2 style="color:#ff6a88;font-size:2.8rem;font-weight:900;margin-bottom:18px;letter-spacing:2px;">Mijn Boekingen</h2>
            {{-- Feedback box verplaatst naar onder de tabel --}}
            @if($bookings->isEmpty())
                <p style="color:#ff6a88;">Je hebt nog geen boekingen gemaakt.</p>
            @else
                <div style="overflow-x:auto;">
                <table id="bookings-table" style="width:100%;border-collapse:separate;border-spacing:0;background:#fff;border-radius:24px;box-shadow:0 4px 24px rgba(255,106,136,0.09);overflow:hidden;font-size:1.08rem;">
                    <thead style="background:linear-gradient(90deg,#ffcc70 0%,#ff6a88 100%);color:#fff;font-size:1.12rem;">
                        <tr>
                            <th style="padding:14px 8px;">Festival</th>
                            <th style="padding:14px 8px;">Datum</th>
                            <th style="padding:14px 8px;">Locatie</th>
                            <th style="padding:14px 8px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr class="booking-row" style="text-align:center;cursor:pointer;transition:background 0.2s;" onclick="toggleDetails('details-{{ $booking->id }}')">
                            <td style="padding:12px 8px;">{{ $booking->festival->name ?? '-' }}</td>
                            <td style="padding:12px 8px;">{{ $booking->festival->date ?? '-' }}</td>
                            <td style="padding:12px 8px;">{{ $booking->festival->location ?? '-' }}</td>
                            <td style="padding:12px 8px;">
                                @if($booking->status === 'bevestigd' || $booking->status === 'Bevestigd')
                                    <span style="color:green;font-weight:bold;">Bevestigd</span>
                                @elseif($booking->status === 'cancelled' || $booking->status === 'Geannuleerd')
                                    <span style="color:#ff6a88;font-weight:bold;">Geannuleerd</span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr id="details-{{ $booking->id }}" class="booking-details" style="display:none;background:#fff8f0;">
                            <td colspan="4" style="padding:18px 24px;text-align:left;border-top:1px solid #ffcc70;">
                                <div style="display:flex;flex-wrap:wrap;gap:32px;">
                                    <div><strong>Bus:</strong> {{ $booking->bus->name ?? '-' }}</div>
                                    <div><strong>Stoeltype:</strong> {{ ucfirst($booking->seat_type) }}</div>
                                    <div><strong>Aantal:</strong> {{ $booking->seats }}</div>
                                    <div><strong>Prijs:</strong> €{{ $booking->total_price }}</div>
                                    <div><strong>Korting:</strong>
                                        @if($booking->points_awarded == 0 && $booking->total_price < ($booking->seats * ($booking->festival->price ?? 0)))
                                            @php
                                                $orig = $booking->seats * ($booking->festival->price ?? 0);
                                                $perc = round(100 - ($booking->total_price / $orig * 100));
                                            @endphp
                                            {{ $perc }}% korting
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <div><strong>Geboekt op:</strong> {{ $booking->booked_at }}</div>
                                    <form method="POST" action="/customers/bookings/{{ $booking->id }}/cancel" style="margin-top:18px;display:inline-block;" onsubmit="return confirm('Weet je zeker dat je deze boeking wilt annuleren?');">
                                        @csrf
                                        <button type="submit" class="cta-btn annuleer-btn" style="background:#ff6a88;color:#fff;border:2px solid #ffcc70;font-weight:bold;min-width:120px;transition:all 0.2s;">Annuleer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
                function toggleDetails(id) {
                    // Hide all details rows first
                    document.querySelectorAll('.booking-details').forEach(function(row) {
                        row.style.display = 'none';
                    });
                    // Show the selected details row
                    var el = document.getElementById(id);
                    if (el) {
                        el.style.display = 'table-row';
                    }
                }
                </script>
                </div>
                @if(session('success'))
                    <div style="background:linear-gradient(90deg,#ffcc70 0%,#ff6a88 100%);color:#fff;padding:7px 16px;border-radius:10px;margin:38px auto 0 auto;font-weight:600;box-shadow:0 1px 8px rgba(255,106,136,0.10);text-align:center;display:flex;align-items:center;justify-content:center;gap:8px;max-width:340px;animation:fadeIn 0.7s;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="flex-shrink:0;margin-right:6px;"><circle cx="12" cy="12" r="12" fill="#fff"/><path d="M7 13l3 3 7-7" stroke="#ff6a88" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span style="font-size:1em;letter-spacing:0.5px;">{{ session('success') }}</span>
                    </div>
                    <style>
                    @keyframes fadeIn {
                        from { opacity: 0; transform: translateY(-6px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    </style>
                @endif
            @endif
            <div style="margin-top:24px;display:flex;gap:16px;justify-content:center;">
                <a href="/customers/bookings/create" class="cta-btn" style="min-width:160px;">Nieuwe Boeking Maken</a>
                <a href="/dashboard" class="cta-btn" style="min-width:120px;">Terug naar dashboard</a>
            </div>
        </div>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
    </div>
</div>
@endsection
