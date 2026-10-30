@extends('layouts.admin')

@section('title', 'Change Status')

@section('content')
<h1>Appointment #{{ $appointment->id }}</h1>

<div class="card" style="max-width:600px;">
    <p><strong>Customer:</strong> {{ $appointment->user->name }}</p>
    <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
    <p><strong>Barber:</strong> {{ $appointment->staff->name }}</p>
    <p><strong>When:</strong> {{ $appointment->appointment_date }} {{ $appointment->appointment_time }}</p>
    @if($appointment->notes)<p><strong>Notes:</strong> {{ $appointment->notes }}</p>@endif

    <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Status</label>
        <select name="status">
            @foreach($statuses as $s)
                <option value="{{ $s }}" {{ old('status', $appointment->status) === $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        @error('status') <span class="error">{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-gold">Update Status</button>
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline">Cancel</a>
    </form>
</div>
@endsection
