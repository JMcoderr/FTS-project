@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="floating-icons">
        <span class="icon">🎶</span>
        <span class="icon">🚌</span>
        <span class="icon">🎫</span>
        <span class="icon">🤩</span>
    </div>
    <div class="floating-logo-bubble">
        <img src="/images/fts-logo.svg" alt="FTS Logo Bubble" class="fts-logo-better-large">
    </div>
    <div class="hero-title">FESTIVAL TRAVEL SYSTEM</div>
    <div class="hero-subtitle">Welkom bij Festival Travel System – jouw ultieme platform voor festivalreizen, tickets en unieke ervaringen!</div>
    <div class="hero-content">
        <h2>Welkom bij Festival Travel System!</h2>
        <p>
            Festival Travel System is hét platform voor festivalreizen, tickets en unieke ervaringen. Boek eenvoudig je festivaltrip, reis samen met vrienden en beleef festivals als nooit tevoren!<br>
            <span class="festival-highlight">Geniet van exclusieve voordelen, loyaliteitspunten en een community vol muziek, plezier en inspiratie!</span>
        </p>
        <div class="hero-buttons">
            <a href="/login" class="cta-btn pulse">Login</a>
            <a href="/register" class="cta-btn pulse">Registreren</a>
        </div>
    </div>
</div>
<div class="why-section">
    <h3>Waarom Festival Travel System?</h3>
    <div class="why-benefits">
        <div class="why-benefit">
            <h4>Over Festival Travel System</h4>
            <p>Lees op de Over-pagina wat het platform doet, hoe je tickets boekt en hoe je samen met vrienden festivals beleeft.</p>
            <a href="/about" class="cta-btn pulse">Meer over Festival Travel System</a>
        </div>
        <div class="why-benefit alt">
            <h4>Top Festivals</h4>
            <p>Bekijk de populairste festivals van het moment, ontdek waar jij bij wilt zijn en laat je inspireren door het aanbod.</p>
            <a href="/top-festivals" class="cta-btn pulse">Bekijk Top Festivals</a>
        </div>
        <div class="why-benefit border">
            <h4>Contact &amp; Support</h4>
            <p>Heb je vragen, wil je support of wil je contact opnemen? Op de contactpagina vind je alle informatie.</p>
            <a href="/contact" class="cta-btn pulse">Contact &amp; Support</a>
        </div>
    </div>
    <div class="festival-tagline">🎉 Ontdek, beleef en deel jouw festivalreis! 🎶</div>
</div>
@endsection
