@extends('layouts.admin')

@section('title', 'Services')

@section('content')
<div class="page-head">
    <h1>Services</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-gold">Add Service</a>
</div>

<table class="data">
    <tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Duration</th><th>Actions</th></tr>
    @forelse($services as $service)
        <tr>
            <td>
                @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="" style="width:50px;height:50px;object-fit:cover;border-radius:4px;">
                @else
                    -
                @endif
            </td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->category->name }}</td>
            <td>PKR {{ $service->price }}</td>
            <td>{{ $service->duration_minutes }} min</td>
            <td>
                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-outline btn-sm">Edit</a>
                <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                      class="inline-form delete-form"
                      data-message="Delete service '{{ $service->name }}'?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6">No services yet.</td></tr>
    @endforelse
</table>
@endsection
