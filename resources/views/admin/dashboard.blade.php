@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1>Welcome back, {{ auth()->user()->name }}</h1>

<div class="stats">
    <div class="stat"><div class="num">{{ $stats['services'] }}</div>Total Services</div>
    <div class="stat"><div class="num">{{ $stats['staff'] }}</div>Staff Members</div>
    <div class="stat"><div class="num">{{ $stats['pending'] }}</div>Pending Appointments</div>
    <div class="stat"><div class="num">{{ $stats['today'] }}</div>Today's Bookings</div>
</div>

<h2>Recent Appointments</h2>
<table class="data">
    <tr><th>#</th><th>Customer</th><th>Service</th><th>Barber</th><th>Date & Time</th><th>Status</th></tr>
    @forelse($recent as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->user->name }}</td>
            <td>{{ $a->service->name }}</td>
            <td>{{ $a->staff->name }}</td>
            <td>{{ $a->appointment_date }} {{ $a->appointment_time }}</td>
            <td>{{ $a->status }}</td>
        </tr>
    @empty
        <tr><td colspan="6">No appointments yet.</td></tr>
    @endforelse
</table>
@endsection
