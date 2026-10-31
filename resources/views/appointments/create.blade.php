@extends('layouts.public')

@section('title', 'Book Appointment | Golden Blade')

@section('content')
<section class="section">
    <div class="container" style="max-width:600px;">
        <h2>Book an Appointment</h2>

        <form action="{{ route('appointments.store') }}" method="POST" class="card">
            @csrf

            <label>Service</label>
            <select name="service_id" id="service">
                <option value="">-- Select service --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}"
                        {{ old('service_id', $selected) == $service->id ? 'selected' : '' }}>
                        {{ $service->name }} (PKR {{ $service->price }})
                    </option>
                @endforeach
            </select>
            @error('service_id') <span class="error">{{ $message }}</span> @enderror

            <label>Barber</label>
            <select name="staff_id" id="staff">
                <option value="">-- Select service first --</option>
            </select>
            @error('staff_id') <span class="error">{{ $message }}</span> @enderror

            <label>Date</label>
            <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}">
            @error('appointment_date') <span class="error">{{ $message }}</span> @enderror

            <label>Time</label>
            <input type="time" name="appointment_time" value="{{ old('appointment_time') }}">
            @error('appointment_time') <span class="error">{{ $message }}</span> @enderror

            <label>Notes (optional)</label>
            <textarea name="notes" rows="3">{{ old('notes') }}</textarea>
            @error('notes') <span class="error">{{ $message }}</span> @enderror

            <button type="submit" class="btn btn-gold">Confirm Booking</button>
        </form>
    </div>
</section>

<script>
    const staffByService = @json($services->mapWithKeys(fn($s) => [$s->id => $s->staff->map(fn($m) => ['id' => $m->id, 'name' => $m->name])]));
    const oldStaff = "{{ old('staff_id') }}";
    const serviceSelect = document.getElementById('service');
    const staffSelect = document.getElementById('staff');

    function loadStaff() {
        const list = staffByService[serviceSelect.value] || [];
        staffSelect.innerHTML = list.length
            ? '<option value="">-- Select barber --</option>'
            : '<option value="">-- Select service first --</option>';
        list.forEach(function (m) {
            const opt = document.createElement('option');
            opt.value = m.id;
            opt.textContent = m.name;
            if (String(m.id) === oldStaff) opt.selected = true;
            staffSelect.appendChild(opt);
        });
    }

    serviceSelect.addEventListener('change', loadStaff);
    loadStaff();
</script>
@endsection
