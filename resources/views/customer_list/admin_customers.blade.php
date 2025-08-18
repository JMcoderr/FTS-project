@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="admin-dashboard-outer" style="position:relative;display:flex;justify-content:center;align-items:flex-start;min-height:80vh;">
    <div class="hero-logo-animated" style="top:30px;">
        <div class="hero-logo-circle">
            <img src="/images/fts-logo.svg" alt="FTS Logo" class="fts-logo">
        </div>
    </div>
    <div class="admin-dashboard-container" style="margin-top:60px; animation:fadeInUp 1.2s cubic-bezier(.77,0,.175,1); box-shadow: 0 8px 32px rgba(255,106,136,0.12); background: linear-gradient(120deg, #fff 90%, #ffcc70 100%); border-radius: 32px; max-width:900px; width:100%;">
        <div class="admin-dashboard-title" style="animation:fadeInDown 1.2s cubic-bezier(.77,0,.175,1); text-align:center; display:flex;justify-content:center;align-items:center;gap:12px;">
            <span style="font-size:2.2rem;">👥</span> Klanten beheren
        </div>
        <div style="font-size:1.18rem;color:#ff6a88;margin-bottom:22px;font-weight:600;letter-spacing:1px;text-align:center;">Bekijk, bewerk of voeg klanten toe.</div>
        <div style="display:flex;justify-content:center;margin-bottom:24px;">
            <a href="/admin/customers/create" class="admin-btn" style="animation:fadeInUp 1s;box-shadow:0 2px 12px rgba(255,106,136,0.09);">Klant toevoegen</a>
        </div>
        <div style="overflow-x:auto;">
        <table class="admin-table" style="margin-top:0;min-width:500px;border-radius:16px;box-shadow:0 2px 12px rgba(255,106,136,0.09);overflow:hidden;">
            <thead>
                <tr style="background:linear-gradient(90deg,#ffcc70 0%,#ff6a88 100%);color:#fff;">
                    <th style="text-align:left;padding-left:24px;">Naam</th>
                    <th style="text-align:left;">E-mail</th>
                    <th style="text-align:center;">Loyaltypunten</th>
                    <th style="text-align:center;">Bewerken</th>
                    <th style="text-align:center;">Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($customers) && count($customers) > 0)
                    @foreach($customers as $customer)
                        <tr class="customer-row" style="transition:background 0.2s;">
                            <td style="text-align:left;padding-left:24px;font-weight:600;">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                            <td style="text-align:left;">{{ $customer->email }}</td>
                            <td style="text-align:center;color:#ff6a88;font-weight:700;">{{ $customer->loyalty_points ?? 0 }}</td>
                            <td style="text-align:center;" colspan="2">
                                <div style="display:flex;gap:12px;justify-content:center;">
                                    <a href="/customer-list/{{ $customer->id }}/edit" class="admin-btn action-btn" style="background:#fff;color:#ff6a88;border:2px solid #ff6a88;padding:8px 24px;font-size:1rem;box-shadow:0 2px 8px rgba(255,106,136,0.09);border-radius:8px;transition:background 0.2s, color 0.2s;">Bewerken</a>
                                    <form method="POST" action="/customer-list/{{ $customer->id }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn action-btn" style="background:#fff;color:#ff6a88;border:2px solid #ff6a88;padding:8px 24px;font-size:1rem;box-shadow:0 2px 8px rgba(255,106,136,0.09);border-radius:8px;transition:background 0.2s, color 0.2s;">Verwijderen</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="5" style="text-align:center;color:#ff6a88;font-weight:600;padding:32px;">Geen klanten gevonden.</td></tr>
                @endif
            </tbody>
        </table>
        </div>
        <div class="admin-dashboard-footer" style="margin-top:44px;font-size:1.08rem;color:#ffcc70;opacity:0.85;text-align:center;letter-spacing:1px;">
            <span style="font-weight:700;">Festival Travel System &copy; 2025</span>
        </div>
    </div>
</div>
@endsection
