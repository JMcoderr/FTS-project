

@extends('layouts.app')
@section('title', 'Contact & Support')
@section('content')
<link rel="stylesheet" href="{{ asset('css/support.css') }}">
<div class="hero-section">
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-title">Contact & Support</div>
    <div class="hero-content">
        <h2>We helpen je graag!</h2>
        <p>Hier vind je alle informatie om contact op te nemen met ons team. We staan klaar om je te helpen met vragen, support of feedback.</p>
        <div class="hero-buttons" style="display:flex;gap:32px;justify-content:center;margin-top:28px;">
            <a href="/" class="cta-btn">Home</a>
            <a href="/about" class="cta-btn">Over</a>
        </div>
    </div>
</div>
<div class="why-section">
    <h3>Contactinformatie</h3>
    <div class="why-benefits" style="justify-content: center;">
        <div class="why-benefit" style="max-width: 420px;">
            <h4>Email Support</h4>
            <p>Stuur ons een e-mail op <strong>support@festivaltravel.com</strong> en we reageren zo snel mogelijk.<br><br><br><span style="color:#ff6a88;font-weight:600;">We staan voor je klaar!</span></p>
        </div>
    </div>
    <span class="festival-tagline">🎉 Jouw festivalreis, onze support! 🎶</span>
</div>
@endsection
