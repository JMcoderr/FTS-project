
@extends('layouts.app')
@section('content')
<!-- Link to about.css for custom styling -->
<link rel="stylesheet" href="{{ asset('css/about.css') }}">

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
    <div class="hero-title">Over Festival Event</div>
    <div class="hero-content">
        <h2>Welkom bij Festival Event!</h2>
        <p>
            Festival Event is hét platform om alles te ontdekken over festivals, het platform en samen met vrienden te genieten van de beste evenementen.<br>
            <span class="festival-highlight">Ontdek, beleef en deel jouw festivalervaring met exclusieve voordelen en een community vol muziek en plezier!</span>
        </p>
        <div class="hero-buttons">
            <a href="/" class="cta-btn pulse">Terug naar Home</a>
            <a href="/register" class="cta-btn pulse">Registreren</a>
        </div>
    </div>
</div>

<div class="why-section">
    <h3>Waarom Festival Event?</h3>
    <div class="why-benefits">
        <div class="why-benefit">
            <h4>Unieke festivalervaring</h4>
            <p>Ontdek festivals die bij jou passen, deel je ervaringen en maak nieuwe vrienden. Geniet van een kleurrijke, interactieve omgeving!</p>
        </div>
        <div class="why-benefit alt">
            <h4>Veilig &amp; snel boeken</h4>
            <p>Boek je tickets in enkele klikken en reis veilig met onze busservice. Alles is eenvoudig en overzichtelijk geregeld.</p>
        </div>
        <div class="why-benefit border">
            <h4>Exclusieve voordelen</h4>
            <p>Spaar loyaliteitspunten, ontvang speciale aanbiedingen en beleef festivals als VIP!</p>
        </div>
    </div>
    <div class="festival-tagline">✨ Festivalplezier begint hier! ✨</div>
</div>
@endsection
