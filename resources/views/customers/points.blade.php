@extends('layouts.app')

@section('content')
<h1>Puntenoverzicht voor {{ $customer->first_name }} {{ $customer->last_name }}</h1>
<p>Totaal punten: <strong>{{ $customer->loyalty_points ?? 0 }}</strong></p>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form method="POST" action="{{ route('customers.redeem', $customer->id) }}">
    @csrf
    <label for="redeem_type">Kies een beloning:</label>
    <select name="redeem_type" id="redeem_type">
        <option value="discount">Korting (50 punten)</option>
        <option value="vip">VIP-ticket (100 punten)</option>
    </select>
    <button type="submit">Inwisselen</button>
</form>
@endsection
