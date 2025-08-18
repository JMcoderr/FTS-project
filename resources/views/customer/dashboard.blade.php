@extends('layouts.app')
@section('content')
<h2>Welkom, {{ Auth::user()->name }}</h2>
<div style="margin-bottom: 30px;">
    <a href="/customers/festivals" style="background:#007bff; color:white; padding:10px 20px; border-radius:6px; text-decoration:none; margin-right:10px;">Festivals bekijken</a>
    <a href="/customers/tickets" style="background:#28a745; color:white; padding:10px 20px; border-radius:6px; text-decoration:none; margin-right:10px;">Mijn tickets</a>
    <a href="/profile" style="background:#ffc107; color:black; padding:10px 20px; border-radius:6px; text-decoration:none;">Profiel</a>
</div>
<div>
    <strong>Loyalty punten:</strong> {{ $customer->loyalty_points ?? 0 }}<br>
    @if(($customer->loyalty_points ?? 0) >= 100)
        <span style="color:green;">Je krijgt 25% korting op je volgende bestelling!</span>
    @elseif(($customer->loyalty_points ?? 0) >= 200)
        <span style="color:green;">Je krijgt 50% korting op je volgende bestelling!</span>
    @else
        <span style="color:gray;">Spaar meer punten voor korting!</span>
    @endif
</div>
@endsection
