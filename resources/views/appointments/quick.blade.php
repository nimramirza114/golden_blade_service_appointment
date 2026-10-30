@extends('layouts.public')

@section('title', 'Confirm or Cancel Appointment | Golden Blade')

@section('content')
<section class="section">
    <div class="container quick-box">
        <h2>Appointment #{{ $appointment->id }}</h2>

        @if($result)
            <div class="alert-{{ $result[0] }}">{{ $result[1] }}</div>
        @endif

        <div class="card">
            <p><strong>Customer:</strong> {{ $appointment->user->name }} ({{ $appointment->user->email }})</p>
            <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
            <p><strong>Barber:</strong> {{ $appointment->staff->name }}</p>
            <p><strong>When:</strong> {{ $appointment->appointment_date }} {{ $appointment->appointment_time }}</p>
            @if($appointment->notes)<p><strong>Notes:</strong> {{ $appointment->notes }}</p>@endif
            <p><strong>Status:</strong> <span class="status status-{{ strtolower($appointment->status) }}">{{ $appointment->status }}</span></p>

            @if($appointment->status === 'Pending')
                {{-- same signed URL is used for POST --}}
                <form method="POST" action="{{ request()->fullUrl() }}" class="row">
                    @csrf
                    <button type="submit" name="action" value="Confirmed" class="btn btn-gold">Confirm</button>
                    <button type="submit" name="action" value="Cancelled" class="btn btn-outline">Cancel appointment</button>
                </form>
            @endif

            @auth
                @if(auth()->user()->isAdmin())
                    <p style="margin-top:16px;"><a href="{{ route('admin.appointments.index') }}">Go to admin dashboard</a></p>
                @endif
            @endauth
        </div>
    </div>
</section>
@endsection
