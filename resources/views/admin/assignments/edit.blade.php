@extends('layouts.admin')

@section('title', 'Assign Services')

@section('content')
<h1>Assign Services to {{ $staff->name }}</h1>

<form action="{{ route('admin.assignments.update', $staff) }}" method="POST" class="card" style="max-width:600px;">
    @csrf
    @method('PUT')

    @foreach($services as $service)
        <label class="check-row">
            <input type="checkbox" name="services[]" value="{{ $service->id }}"
                {{ in_array($service->id, old('services', $assigned)) ? 'checked' : '' }}>
            {{ $service->name }} <small>({{ $service->category->name }})</small>
        </label>
    @endforeach

    @error('services') <span class="error">{{ $message }}</span> @enderror

    <button type="submit" class="btn btn-gold">Save Assignment</button>
    <a href="{{ route('admin.assignments.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection
