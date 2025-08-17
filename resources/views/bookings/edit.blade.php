@extends('layouts.app')

@section('content')
<h1>Boeking Bewerken</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('bookings.update', $booking) }}">
    @csrf @method('PUT')

    <label>Klant:</label><br>
    <select name="customer_id" required>
        @foreach($customers as $c)
            <option value="{{ $c->id }}" {{ old('customer_id', $booking->customer_id)==$c->id?'selected':'' }}>
                {{ $c->first_name }} {{ $c->last_name }} ({{ $c->email }})
            </option>
        @endforeach
    </select><br><br>

    <label>Festival:</label><br>
    <select name="festival_id" required>
        @foreach($festivals as $f)
            <option value="{{ $f->id }}" {{ old('festival_id', $booking->festival_id)==$f->id?'selected':'' }}>
                {{ $f->name }} — {{ $f->date }} — €{{ $f->price }}
            </option>
        @endforeach
    </select><br><br>

    <label>Zitplaatsen:</label><br>
    <input type="number" name="seats" min="1" value="{{ old('seats', $booking->seats) }}" required><br><br>

    <label>Status:</label><br>
    <select name="status" required>
        <option value="Bevestigd" {{ old('status', $booking->status)=='Bevestigd'?'selected':'' }}>Bevestigd</option>
        <option value="Geannuleerd" {{ old('status', $booking->status)=='Geannuleerd'?'selected':'' }}>Geannuleerd</option>
    </select><br><br>

    <button type="submit">Bijwerken</button>
</form>

<a href="{{ route('bookings.index') }}">Terug naar lijst</a>
@endsection
