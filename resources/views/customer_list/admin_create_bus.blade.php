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
        <span style="font-size:2.2rem;">🚌</span> Bus toevoegen
    </div>
    @if(session('success'))
        <div class="success-message" style="color:#fff;background:#ff6a88;padding:16px 0;border-radius:12px;margin-bottom:18px;font-weight:700;box-shadow:0 2px 12px rgba(255,106,136,0.09);animation:fadeInDown 0.8s;">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="/admin/buses/store" style="margin-top:18px;">
        @csrf
        <input type="text" name="name" placeholder="Busnaam" required class="admin-input" style="margin-bottom:12px;">
        <input type="number" name="capacity" placeholder="Capaciteit" required class="admin-input" style="margin-bottom:12px;">
        <select name="festival_id" required class="admin-input" style="margin-bottom:12px;">
            @foreach(App\Models\Festival::all() as $festival)
                <option value="{{ $festival->id }}">{{ $festival->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="admin-btn save-btn" style="margin-top:18px;">Opslaan</button>
    </form>
    <div style="display:flex;justify-content:center;margin-top:32px;">
        <a href="/admin" class="admin-btn back-btn" style="padding:12px 40px;min-width:200px;text-align:center;background:linear-gradient(90deg,#ff6a88 0%,#ffcc70 100%);color:#fff;font-weight:700;font-size:1.15rem;border-radius:32px;box-shadow:0 8px 32px rgba(255,106,136,0.18);letter-spacing:1px;transition:background 0.2s, color 0.2s, transform 0.2s;display:inline-block;animation:fadeInUp 1s;">
            <span style="font-size:1.3rem;vertical-align:middle;margin-right:8px;">←</span> Terug naar dashboard
        </a>
    </div>
</div>
@endsection
