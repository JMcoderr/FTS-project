@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/customers.css') }}">
@section('content')
<body class="customer-bg">
    <div class="customer-container">
        <div class="customer-accent"></div>
        <a href="{{ route('customers.create') }}" class="customer-btn">Nieuwe klant toevoegen</a>
        <h1 class="customer-header">Klantenlijst</h1>
        <table class="customer-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <div class="customer-btn-group">
                            <a class="customer-btn" href="{{ route('customers.edit', $customer->id) }}">Bewerken</a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="customer-btn delete" onclick="return confirm('Weet je zeker dat je deze klant wilt verwijderen?')">Verwijderen</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection
