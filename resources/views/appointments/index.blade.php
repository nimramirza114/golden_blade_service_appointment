@extends('layouts.public')

@section('title', 'My Appointments | Golden Blade')

@section('content')
<section class="section">
    <div class="container">
        <h2>My Appointments</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="table-wrap">

        <table class="data">
            <tr><th>Service</th><th>Barber</th><th>Date</th><th>Time</th><th>Status</th><th>Action</th></tr>
            @forelse($appointments as $a)
                <tr>
                    <td>{{ $a->service->name }}</td>
                    <td>{{ $a->staff->name }}</td>
                    <td>{{ $a->appointment_date }}</td>
                    <td>{{ $a->appointment_time }}</td>
                    <td><span class="status status-{{ strtolower($a->status) }}">{{ $a->status }}</span></td>
                    <td>
                        @if($a->status === 'Pending')
                             <form action="{{ route('appointments.cancel', $a) }}" method="POST"
      class="confirm-form"
      data-message="Do you want to cancel your {{ $a->service->name }} appointment?">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-outline btn-sm">Cancel</button>
</form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">You have no appointments yet.</td></tr>
            @endforelse
        </table>
        </div>
    </div>
</section>
@endsection
