@extends('layouts.app')

@section('content')
<a href="{{ route('customers.create') }}">Nieuwe klant toevoegen</a>
<h1>Klantenlijst</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Email</th>
            <th>Acties</th> <!-- Nieuwe kolom voor acties -->
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
            <td>{{ $customer->email }}</td>
            <td>
                <!-- Link naar edit -->
                <a href="{{ route('customers.edit', $customer->id) }}">Bewerken</a>

                <!-- Delete formulier -->
                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Weet je zeker dat je deze klant wilt verwijderen?')">Verwijderen</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
