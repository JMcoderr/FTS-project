@extends('layouts.app')

@section('content')
<h1>Nieuw Festival Toevoegen</h1>

<form method="POST" action="{{ route('festivals.store') }}">
    @csrf
    <label>Naam:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required><br><br>

    <label>Datum:</label><br>
    <input type="date" name="date" value="{{ old('date') }}" required><br><br>

    <label>Locatie:</label><br>
    <input type="text" name="location" value="{{ old('location') }}" required><br><br>

    <label>Prijs (€):</label><br>
    <input type="number" name="price" value="{{ old('price') }}" step="0.01" required><br><br>

    <label>Max. Capaciteit:</label><br>
    <input type="number" name="max_capacity" value="{{ old('max_capacity') }}" required><br><br>

    <button type="submit">Opslaan</button>
</form>
@endsection
