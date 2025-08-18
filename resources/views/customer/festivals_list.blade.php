@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/customer_festival.css">
<div class="logo-bubble">
    <img src="/images/fts-logo.svg" alt="FTS Logo">
</div>
<div class="festival-list-container">
    <div class="festival-list-title">Festival Overzicht</div>
    <div style="text-align:center;color:#444;font-size:1.08rem;margin-bottom:18px;">
        Bekijk alle festivals en boek direct jouw reis!
    </div>
    <div class="festival-grid">
        @foreach($festivals as $festival)
        <div class="festival-card">
            <div class="festival-name">{{ $festival->name }}</div>
            <div class="festival-date">{{ $festival->date }}</div>
            <div class="festival-location">Locatie: <span>{{ $festival->location }}</span></div>
            <div class="festival-price">Prijs: <span>€{{ $festival->price }}</span></div>
            <div class="festival-capacity">Capaciteit: <span>{{ $festival->max_capacity }}</span></div>
            <div class="festival-bus">Bus: <span>{{ $festival->buses->first()->name ?? 'Geen bus gekoppeld' }}</span></div>
            <div class="festival-modal-description">
                <strong>Beschrijving:</strong><br>
                {{ $festival->description ?? 'Geen beschrijving beschikbaar.' }}
            </div>
            <div class="festival-modal-actions">
                <a href="/customers/bookings/create" class="details-btn book-btn">Boek nu</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="festival-list-footer">
        <a href="/dashboard" class="details-btn">Terug naar dashboard</a>
    </div>
    <div class="festival-list-copyright">
        © 2025 Festival Travel System
    </div>
</div>
@endsection
