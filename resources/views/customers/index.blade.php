<!-- resources/views/customers/index.blade.php -->

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
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
            <td>{{ $customer->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
