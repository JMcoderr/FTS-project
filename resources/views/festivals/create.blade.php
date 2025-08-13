@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/festivals.css') }}">
@section('content')
<body class="festival-bg">
    <div class="festival-container">
        <div class="festival-accent"></div>
        <h1 class="festival-header">Nieuw Festival Toevoegen</h1>
        <form method="POST" action="{{ route('festivals.store') }}" class="festival-form">
            @csrf
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>

            <label for="date">Datum:</label>
            <input type="date" id="date" name="date" value="{{ old('date') }}" required>

            <label for="location">Locatie:</label>
            <input type="text" id="location" name="location" value="{{ old('location') }}" required>

            <label for="price">Prijs (€):</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" required>

            <label for="max_capacity">Max. Capaciteit:</label>
            <input type="number" id="max_capacity" name="max_capacity" value="{{ old('max_capacity') }}" required>

            <button type="submit" class="festival-btn">Opslaan</button>
        </form>
    </div>
</body>
@endsection
