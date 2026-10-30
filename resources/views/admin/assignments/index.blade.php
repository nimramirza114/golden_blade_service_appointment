@extends('layouts.admin')

@section('title', 'Staff-Service Assignment')

@section('content')
<h1>Staff-Service Assignment</h1>

<table class="data">
    <tr><th>Staff</th><th>Assigned Services</th><th>Action</th></tr>
    @foreach($staff as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>
                @forelse($member->services as $service)
                    {{ $service->name }}@if(!$loop->last), @endif
                @empty
                    <em>None assigned</em>
                @endforelse
            </td>
            <td>
                <a href="{{ route('admin.assignments.edit', $member) }}" class="btn btn-outline btn-sm">Assign Services</a>
            </td>
        </tr>
    @endforeach
</table>
@endsection
