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
    <label for="points">Voeg punten toe:</label>
    <input type="number" name="points" id="points" min="1" required>
    <button type="submit">Punten toevoegen</button>
</form>
@endsection
