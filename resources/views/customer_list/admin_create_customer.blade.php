@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="hero-logo-animated">
    <div class="hero-logo-circle">
        <img src="/images/fts-logo.svg" alt="FTS Logo" class="fts-logo">
    </div>
</div>
<div class="admin-dashboard-outer" style="position:relative;">
    </div>
    </div>
    <div class="admin-dashboard-container" style="margin-top:60px; animation:fadeInUp 1.2s cubic-bezier(.77,0,.175,1); box-shadow: 0 8px 32px rgba(255,106,136,0.12); background: linear-gradient(120deg, #fff 90%, #ffcc70 100%); border-radius: 32px;">
        <div class="admin-dashboard-title" style="animation:fadeInDown 1.2s cubic-bezier(.77,0,.175,1); display:flex;align-items:center;gap:12px;">
            <span style="font-size:2.2rem;">➕</span> Klant toevoegen
        </div>
        @if ($errors->has('email'))
            <div class="error-message" style="color:#ff6a88;font-weight:600;margin-bottom:16px;">
                {{ $errors->first('email') }}
            </div>
        @endif
        <form method="POST" action="/admin/customers/store" class="admin-form" style="margin-top:18px;">
            @csrf

            <label for="name">Voornaam</label>
            <input type="text" id="name" name="name" placeholder="Voornaam" required style="box-shadow:0 2px 12px rgba(255,106,136,0.09);">

            <label for="last_name">Achternaam</label>
            <input type="text" id="last_name" name="last_name" placeholder="Achternaam" required style="box-shadow:0 2px 12px rgba(255,106,136,0.09);">

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="E-mail" required style="box-shadow:0 2px 12px rgba(255,106,136,0.09);">

            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" placeholder="Wachtwoord" required style="box-shadow:0 2px 12px rgba(255,106,136,0.09);">

            <button type="submit" class="admin-btn save-btn" style="margin-top:24px;">
                <span style="font-size:1.2rem;vertical-align:middle;">💾</span> Opslaan
            </button>
        </form>
        <div style="display:flex;justify-content:center;margin-top:32px;">
            <a href="/admin/customers" class="admin-btn save-btn" style="margin-top:0;padding:8px 32px;min-width:180px;text-align:center;">
                <span style="font-size:1.1rem;vertical-align:middle;">←</span> Terug naar klantenlijst
            </a>
        </div>
    </div>
</div>
@endsection
