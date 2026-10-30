@extends('layouts.admin')

@section('title', 'Staff')

@section('content')
<div class="page-head">
    <h1>Staff</h1>
    <a href="{{ route('admin.staff.create') }}" class="btn btn-gold">Add Staff</a>
</div>

<table class="data">
    <tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Services</th><th>Actions</th></tr>
    @forelse($staff as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->phone }}</td>
            <td>{{ $member->services_count }}</td>
            <td>
                <a href="{{ route('admin.staff.edit', $member) }}" class="btn btn-outline btn-sm">Edit</a>
                <form action="{{ route('admin.staff.destroy', $member) }}" method="POST"
                      class="inline-form delete-form"
                      data-message="Delete staff member '{{ $member->name }}'?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6">No staff yet.</td></tr>
    @endforelse
</table>
@endsection
