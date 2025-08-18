@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="hero-logo-animated">
    <div class="hero-logo-circle">
        <img src="/images/fts-logo.svg" alt="FTS Logo" class="fts-logo">
    </div>
</div>
<div class="admin-dashboard-container" style="margin-top:60px; animation:fadeInUp 1.2s cubic-bezier(.77,0,.175,1); box-shadow: 0 8px 32px rgba(255,106,136,0.12); background: linear-gradient(120deg, #fff 90%, #ffcc70 100%); border-radius: 32px; max-width:900px; width:100%;">
    <div class="admin-dashboard-title" style="animation:fadeInDown 1.2s cubic-bezier(.77,0,.175,1); text-align:center; display:flex;justify-content:center;align-items:center;gap:12px;">
        <span style="font-size:2.2rem;">📋</span> Boekingen bekijken
    </div>
    <table class="admin-table" style="width:100%;margin-top:24px;background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(255,106,136,0.09);">
        <thead>
            <tr style="background:linear-gradient(90deg,#ffcc70 0%,#ff6a88 100%);color:#fff;font-weight:700;">
                <th>Boeking ID</th>
                <th>Klant</th>
                <th>Festival</th>
                <th>Bus</th>
                <th>Datum</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ isset($booking->customer) ? ($booking->customer->first_name . ' ' . $booking->customer->last_name) : '-' }}</td>
                <td>{{ $booking->festival->name ?? '-' }}</td>
                <td>{{ $booking->bus->name ?? '-' }}</td>
                <td>{{ $booking->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="display:flex;justify-content:center;margin-top:32px;">
        <a href="/admin" class="admin-btn back-btn" style="padding:8px 32px;min-width:160px;text-align:center;background:#fff;color:#ff6a88;border:2px solid #ff6a88;box-shadow:0 2px 8px rgba(255,106,136,0.09);border-radius:8px;transition:background 0.2s, color 0.2s;font-weight:600;">← Terug naar dashboard</a>
    </div>
</div>
@endsection
