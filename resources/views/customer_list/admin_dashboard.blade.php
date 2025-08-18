@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="admin-dashboard-outer" style="position:relative;">
    <div class="hero-logo-animated" style="top:30px;">
        <div class="hero-logo-circle">
            <img src="/images/fts-logo.svg" alt="FTS Logo" class="fts-logo">
        </div>
    </div>
    <div class="admin-dashboard-container" style="margin-top:60px;">
        <div class="admin-dashboard-title" style="animation:fadeInDown 1.2s cubic-bezier(.77,0,.175,1);">Admin Dashboard</div>
        <div style="font-size:1.18rem;color:#ff6a88;margin-bottom:22px;font-weight:600;letter-spacing:1px;">Welkom, beheer hier alle festival data!</div>
        <div class="admin-dashboard-btns">
            <a href="/admin/customers" class="admin-btn" style="animation:fadeIn 1.2s cubic-bezier(.77,0,.175,1);">Klanten beheren</a>
            <a href="/admin/festivals/create" class="admin-btn" style="animation:fadeIn 1.3s cubic-bezier(.77,0,.175,1);">Festival toevoegen</a>
            <a href="/admin/buses/create" class="admin-btn" style="animation:fadeIn 1.4s cubic-bezier(.77,0,.175,1);">Bus toevoegen</a>
            <a href="/admin/bookings" class="admin-btn" style="animation:fadeIn 1.5s cubic-bezier(.77,0,.175,1);">Boekingen bekijken</a>
        </div>
        <div style="display:flex;justify-content:center;margin-top:32px;">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="admin-btn save-btn" style="padding:14px 48px;min-width:220px;text-align:center;font-size:1.15rem;border-radius:32px;box-shadow:0 8px 32px rgba(255,106,136,0.18);letter-spacing:1px;transition:background 0.2s, color 0.2s, transform 0.2s;display:inline-block;animation:fadeInUp 1.2s;background:linear-gradient(90deg,#ff6a88 0%,#ffcc70 100%);color:#fff;font-weight:700;">
                    <span style="font-size:1.3rem;vertical-align:middle;margin-right:8px;">⎋</span> Uitloggen
                </button>
            </form>
        </div>
        <div class="admin-dashboard-footer" style="margin-top:44px;font-size:1.08rem;color:#ffcc70;opacity:0.85;text-align:center;letter-spacing:1px;">
            <span style="font-weight:700;">Festival Travel System &copy; 2025</span>
        </div>
    </div>
</div>
@endsection
