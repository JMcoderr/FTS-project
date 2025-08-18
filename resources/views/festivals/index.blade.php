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
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <div>
                    <label for="sort">Sorteren op</label>
                    <select id="sort" name="sort">
                        <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>ID</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Naam</option>
                        <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Datum</option>
                        <option value="location" {{ request('sort') == 'location' ? 'selected' : '' }}>Locatie</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Prijs</option>
                        <option value="max_capacity" {{ request('sort') == 'max_capacity' ? 'selected' : '' }}>Max. Capaciteit</option>
                    </select>
                </div>
                <div>
                    <label for="direction">Richting</label>
                    <select id="direction" name="direction">
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Oplopend</option>
                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Aflopend</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="festival-btn">Filter</button>
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
    </div>
</body>
@endsection
