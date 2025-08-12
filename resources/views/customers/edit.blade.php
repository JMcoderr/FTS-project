@extends('layouts.app')

@section('content')
<h1>Klant bewerken</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('customers.update', $customer->id) }}">
    @csrf
    @method('PUT')

    <label for="first_name">Voornaam:</label><br>
    <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $customer->first_name) }}" required><br><br>

    <label for="last_name">Achternaam:</label><br>
    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $customer->last_name) }}" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" required><br><br>

    <button type="submit">Bijwerken</button>
</form>

@endsection
