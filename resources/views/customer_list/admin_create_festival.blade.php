@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="hero-logo-animated">
    <div class="hero-logo-circle">
        <img src="/images/fts-logo.svg" alt="FTS Logo" class="fts-logo">
    </div>
</div>
<div class="admin-dashboard-container" style="margin-top:60px; animation:fadeInUp 1.2s cubic-bezier(.77,0,.175,1); box-shadow: 0 8px 32px rgba(255,106,136,0.12); background: linear-gradient(120deg, #fff 90%, #ffcc70 100%); border-radius: 32px; max-width:600px; width:100%;">
    <div class="admin-dashboard-title" style="animation:fadeInDown 1.2s cubic-bezier(.77,0,.175,1); text-align:center; display:flex;justify-content:center;align-items:center;gap:12px;">
        <span style="font-size:2.2rem;">🎉</span> Festival toevoegen
    </div>
    <form method="POST" action="/admin/festivals/store" style="margin-top:18px;">
        @csrf
        <input type="text" name="name" placeholder="Naam" required class="admin-input" style="margin-bottom:12px;">
        <input type="date" name="date" required class="admin-input" style="margin-bottom:12px;">
        <input type="text" name="location" placeholder="Locatie" required class="admin-input" style="margin-bottom:12px;">
        <input type="number" name="price" placeholder="Prijs" step="0.01" required class="admin-input" style="margin-bottom:12px;">
        <input type="number" name="max_capacity" placeholder="Capaciteit" required class="admin-input" style="margin-bottom:12px;">
        <textarea name="description" placeholder="Beschrijving" class="admin-input" style="margin-bottom:12px;"></textarea>
        <button type="submit" class="admin-btn save-btn" style="margin-top:18px;">Opslaan</button>
    </form>
    <div style="display:flex;justify-content:center;margin-top:32px;">
        <a href="/admin" class="admin-btn back-btn" style="padding:8px 32px;min-width:160px;text-align:center;background:#fff;color:#ff6a88;border:2px solid #ff6a88;box-shadow:0 2px 8px rgba(255,106,136,0.09);border-radius:8px;transition:background 0.2s, color 0.2s;font-weight:600;">← Terug naar dashboard</a>
    </div>
</div>
@endsection
