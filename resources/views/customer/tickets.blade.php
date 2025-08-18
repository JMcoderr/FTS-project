@extends('layouts.app')
@section('title', 'Mijn Tickets')
@section('content')
<link rel="stylesheet" href="{{ asset('css/customer.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-content">
        <div class="dashboard-card" style="max-width:650px;background:linear-gradient(120deg,#fff3e0 60%,#ffcc70 100%);border-radius:32px;box-shadow:0 8px 32px rgba(255,106,136,0.13);padding:38px 44px;">
            <h2 style="color:#ff6a88;font-size:2.2rem;font-weight:800;margin-bottom:18px;letter-spacing:1px;">Mijn Tickets</h2>
            @if($bookings->isEmpty())
                <p style="color:#ff6a88;">Je hebt nog geen tickets geboekt.</p>
            @else
                @php $last = $bookings->sortByDesc('booked_at')->first(); @endphp
                <div style="overflow-x:auto;">
                <table style="width:100%;max-width:600px;margin:0 auto;border-collapse:separate;border-spacing:0;background:#fff;border-radius:24px;box-shadow:0 4px 24px rgba(255,106,136,0.09);overflow:hidden;font-size:1.08rem;">
                    <thead style="background:linear-gradient(90deg,#ffcc70 0%,#ff6a88 100%);color:#fff;font-size:1.12rem;">
                        <tr>
                            <th style="padding:14px 8px;">Festival</th>
                            <th style="padding:14px 8px;">Datum</th>
                            <th style="padding:14px 8px;">Locatie</th>
                            <th style="padding:14px 8px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align:center;cursor:pointer;transition:background 0.2s;" onclick="toggleTicketDetails('ticket-details')">
                            <td style="padding:12px 8px;">{{ $last->festival->name ?? '-' }}</td>
                            <td style="padding:12px 8px;">{{ $last->festival->date ?? '-' }}</td>
                            <td style="padding:12px 8px;">{{ $last->festival->location ?? '-' }}</td>
                            <td style="padding:12px 8px;">
                                @if($last->status === 'bevestigd' || $last->status === 'Bevestigd')
                                    <span style="color:green;font-weight:bold;">Bevestigd</span>
                                @elseif($last->status === 'cancelled' || $last->status === 'Geannuleerd')
                                    <span style="color:#ff6a88;font-weight:bold;">Geannuleerd</span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr id="ticket-details" style="display:none;background:#fff8f0;">
                            <td colspan="4" style="padding:18px 24px;text-align:left;border-top:1px solid #ffcc70;">
                                <div style="display:flex;flex-wrap:wrap;gap:32px;">
                                    <div><strong>Bus:</strong> {{ $last->bus->name ?? '-' }}</div>
                                    <div><strong>Stoeltype:</strong> {{ ucfirst($last->seat_type) }}</div>
                                    <div><strong>Aantal:</strong> {{ $last->seats }}</div>
                                    <div><strong>Prijs:</strong> €{{ $last->total_price }}</div>
                                    <div><strong>Korting:</strong> @if($last->points_awarded == 0 && $last->total_price < ($last->seats * ($last->festival->price ?? 0)))
                                        @php
                                            $orig = $last->seats * ($last->festival->price ?? 0);
                                            $perc = round(100 - ($last->total_price / $orig * 100));
                                        @endphp
                                        {{ $perc }}% korting
                                    @else
                                        Geen korting
                                    @endif
                                    </div>
                                    <div><strong>Geboekt op:</strong> {{ $last->booked_at }}</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <script>
                function toggleTicketDetails(id) {
                    var el = document.getElementById(id);
                    if (el.style.display === 'none' || el.style.display === '') {
                        el.style.display = 'table-row';
                    } else {
                        el.style.display = 'none';
                    }
                }
                </script>
            @endif
            @if(session('success'))
                <div style="background:linear-gradient(90deg,#ff6a88 0%,#ffcc70 100%);color:#fff;padding:18px 28px;border-radius:18px;margin:38px auto 22px auto;font-weight:700;box-shadow:0 2px 16px rgba(255,106,136,0.16);text-align:center;display:flex;align-items:center;justify-content:center;gap:16px;max-width:340px;animation:fadeIn 0.7s;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" style="flex-shrink:0;"><circle cx="12" cy="12" r="12" fill="#fff"/><path d="M7 13l3 3 7-7" stroke="#ff6a88" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span style="font-size:1.15em;letter-spacing:1px;">{{ session('success') }}</span>
                </div>
                <style>
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(-10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                </style>
            @endif
            <div style="margin-top:24px;display:flex;gap:16px;justify-content:center;">
                <a href="/dashboard" class="cta-btn" style="min-width:120px;">Terug naar dashboard</a>
            </div>
        </div>
        <div style="margin-top:32px;font-size:0.95rem;color:#ffcc70;opacity:0.8;">© 2025 Festival Travel System</div>
    </div>
</div>
@endsection
