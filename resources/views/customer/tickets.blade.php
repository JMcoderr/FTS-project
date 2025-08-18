@extends('layouts.app')
@section('content')
<h2>Mijn tickets</h2>
@if(session('success'))
    <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    <a href="/customers/festivals" style="display:inline-block; margin-bottom:20px; background:#007bff; color:white; padding:8px 16px; border-radius:4px; text-decoration:none;">Terug naar festivals</a>
@endif
@if($bookings->isEmpty())
    <p>Je hebt nog geen tickets geboekt.</p>
@else
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th>Festival</th>
                <th>Datum</th>
                <th>Locatie</th>
                <th>Bus</th>
                <th>Stoelnummer(s)</th>
                <th>Stoeltype</th>
                <th>Aantal</th>
                <th>Status</th>
                <th>Prijs</th>
                <th>Korting</th>
                <th>Loyalty punten</th>
                <th>Opmerkingen</th>
                <th>Geboekt op</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->festival->name ?? '-' }}</td>
                    <td>{{ $booking->festival->date ?? '-' }}</td>
                    <td>{{ $booking->festival->location ?? '-' }}</td>
                    <td>{{ $booking->bus->name ?? '-' }} (Bus #{{ $booking->bus_id }})</td>
                    <td>
                        @php
                            // Simuleer random en naast elkaar stoelen
                            $bus_capacity = $booking->bus->capacity ?? 50;
                            $start = rand(1, max(1, $bus_capacity - $booking->seats + 1));
                        @endphp
                        @for($i = $start; $i < $start + $booking->seats; $i++)
                            {{ $i }}@if($i < $start + $booking->seats - 1), @endif
                        @endfor
                    </td>
                    <td>{{ $booking->seat_type ?? '-' }}</td>
                    <td>{{ $booking->seats }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>€{{ $booking->total_price }}</td>
                    <td>
                        @if($booking->points_awarded == 0 && $booking->total_price < ($booking->seats * ($booking->festival->price ?? 0)))
                            @php
                                $orig = $booking->seats * ($booking->festival->price ?? 0);
                                $perc = round(100 - ($booking->total_price / $orig * 100));
                            @endphp
                            {{ $perc }}% korting gebruikt
                        @else
                            Geen korting
                        @endif
                    </td>
                    <td>{{ $booking->points_awarded }}</td>
                    <td>{{ $booking->remarks ?? '-' }}</td>
                    <td>{{ $booking->booked_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top:20px;">
        <strong>Jouw gegevens:</strong><br>
        Naam: {{ $customer->first_name ?? '-' }}<br>
        Email: {{ $customer->email ?? '-' }}<br>
        Loyalty punten: {{ $customer->loyalty_points ?? 0 }}<br>
        @if(isset($discount) && $discount > 0)
            <span style="color:green;">Je krijgt {{ $discount * 100 }}% korting op je volgende bestelling!</span>
        @else
            <span style="color:gray;">Spaar meer punten voor korting!</span>
        @endif
    </div>
    <div style="margin-top:20px;">
        <strong>Jouw gegevens:</strong><br>
        Naam: {{ $customer->first_name ?? '-' }}<br>
        Email: {{ $customer->email ?? '-' }}<br>
        Loyalty punten: {{ $customer->loyalty_points ?? 0 }}
    </div>
    <a href="/dashboard">Terug naar dashboard</a>
@endif
@endsection
