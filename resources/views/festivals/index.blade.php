@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/festivals.css') }}">
@section('content')
<body class="festival-bg">
    <div class="festival-container">
        <div class="festival-accent"></div>
    <h1 class="festival-header">Festivals</h1>
    <a href="/dashboard" class="festival-btn" style="margin-bottom: 10px;">Terug naar admin dashboard</a>
    <a href="{{ route('festivals.create') }}" class="festival-btn">Nieuw Festival Toevoegen</a>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <!-- Search & Sort Form -->
        <form method="GET" action="{{ route('festivals.index') }}" class="festival-form" style="margin-bottom: 18px;">
            <label for="search">Zoek op naam of locatie</label>
            <input type="text" id="search" name="search" placeholder="Zoek op naam of locatie" value="{{ request('search') }}">
            <label for="min_bookings">Minimaal aantal boekingen</label>
            <input type="number" id="min_bookings" name="min_bookings" value="{{ request('min_bookings') }}" min="0">
            <button type="submit">Zoeken/Filteren</button>
        </form>
        <table class="festival-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Datum</th>
                    <th>Locatie</th>
                    <th>Prijs (€)</th>
                    <th>Max. Capaciteit</th>
                    <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        @forelse($festivals as $festival)
        <tr>
            <td>{{ $festival->id }}</td>
            <td>{{ $festival->name }}</td>
            <td>{{ $festival->date }}</td>
            <td>{{ $festival->location }}</td>
            <td>{{ $festival->price }}</td>
            <td>{{ $festival->max_capacity }}</td>
            <td>
                <div class="festival-btn-group">
                    <a class="festival-btn" href="{{ route('festivals.show', $festival) }}">Bekijk</a>
                    <a class="festival-btn" href="{{ route('festivals.edit', $festival) }}">Bewerken</a>
                    <form action="{{ route('festivals.destroy', $festival) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="festival-btn delete" onclick="return confirm('Weet je zeker dat je dit festival wilt verwijderen?')">Verwijderen</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">Geen festivals gevonden.</td>
        </tr>
        @endforelse
        </tbody>
        </table>
        <div class="pagination-wrapper" style="margin-top: 24px; text-align: center;">
            {{ $festivals->links() }}
        </div>
        @php
            $festivalBookings = [];
            foreach($festivals as $festival) {
                $festivalBookings[$festival->id] = \App\Models\Booking::where('festival_id', $festival->id)->count();
            }
        @endphp
        <div style="margin: 20px 0;">
            <h3>Aantal boekingen per festival</h3>
            <table border="1" cellpadding="5">
                <tr>
                    <th>Festival</th>
                    <th>Aantal boekingen</th>
                </tr>
                @foreach($festivals as $festival)
                    @if((!request('min_bookings') || $festivalBookings[$festival->id] >= request('min_bookings')) && (!request('search') || str_contains(strtolower($festival->name . $festival->location), strtolower(request('search')))))
                    <tr>
                        <td>{{ $festival->name }}</td>
                        <td>{{ $festivalBookings[$festival->id] }}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
</body>
@endsection
