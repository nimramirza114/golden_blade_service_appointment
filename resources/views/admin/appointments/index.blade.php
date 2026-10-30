@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<h1>All Appointments</h1>

<form method="GET" action="{{ route('admin.appointments.index') }}" class="search-form" style="margin-bottom:16px;">
    <select name="status" onchange="this.form.submit()">
        <option value="">All Statuses</option>
        @foreach($statuses as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>
    <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()">
    <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline">Reset</a>
</form>

<table class="data">
    <tr><th>#</th><th>Customer</th><th>Service</th><th>Barber</th><th>Date & Time</th><th>Status</th><th>Action</th></tr>
    @forelse($appointments as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->user->name }}</td>
            <td>{{ $a->service->name }}</td>
            <td>{{ $a->staff->name }}</td>
            <td>{{ $a->appointment_date }} {{ $a->appointment_time }}</td>
            <td><span class="status status-{{ strtolower($a->status) }}">{{ $a->status }}</span></td>
            <td>
                @if($a->status === 'Pending')
                    <form action="{{ route('admin.appointments.update', $a) }}" method="POST" style="display:inline;">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="Confirmed">
                        <button type="submit" class="btn btn-gold btn-sm">Confirm</button>
                    </form>
                    <form action="{{ route('admin.appointments.update', $a) }}" method="POST" style="display:inline;">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="Cancelled">
                <button type="submit" class="btn btn-outline btn-sm">Cancel</button>
                    </form>
                @endif
                <a href="{{ route('admin.appointments.edit', $a) }}" class="btn btn-outline btn-sm">Details</a>
            </td>
        </tr>
    @empty
        <tr><td colspan="7">No appointments found.</td></tr>
    @endforelse
</table>

<div style="margin-top:16px;">{{ $appointments->links() }}</div>
@endsection
