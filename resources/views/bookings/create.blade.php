@extends('layouts.app')

@section('content')
<h1>Nieuwe Boeking</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('bookings.store') }}">
    @csrf

    <label>Klant:</label><br>
    <select name="customer_id" required>
        <option value="">-- kies klant --</option>
        @foreach($customers as $c)
            <option value="{{ $c->id }}" {{ old('customer_id')==$c->id?'selected':'' }}>
                {{ $c->first_name }} {{ $c->last_name }} ({{ $c->email }})
            </option>
        @endforeach
    </select><br><br>

    <label>Festival:</label><br>
    <select name="festival_id" required>
        <option value="">-- kies festival --</option>
        @foreach($festivals as $f)
            <option value="{{ $f->id }}" {{ old('festival_id')==$f->id?'selected':'' }}>
                {{ $f->name }} — {{ $f->date }} — €{{ $f->price }}
            </option>
        @endforeach
    </select><br><br>

    <label>Zitplaatsen:</label><br>
    <input type="number" name="seats" min="1" value="{{ old('seats', 1) }}" required><br><br>

    <label>Status:</label><br>
    <select name="status" required>
        @foreach(['pending','confirmed','cancelled'] as $st)
            <option value="{{ $st }}" {{ old('status','pending')==$st?'selected':'' }}>{{ ucfirst($st) }}</option>
        @endforeach
    </select><br><br>

    <button type="submit">Opslaan</button>
</form>

<a href="{{ route('bookings.index') }}">Terug naar lijst</a>
@endsection
