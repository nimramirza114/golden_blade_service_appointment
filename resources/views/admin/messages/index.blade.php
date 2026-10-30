@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<h1>Contact Messages</h1>

<table class="data">
    <tr><th>#</th><th>Name</th><th>Email</th><th>Message</th><th>Received</th><th>Action</th></tr>
    @forelse($messages as $m)
        <tr class="{{ $m->isRead() ? '' : 'unread-row' }}">
            <td>{{ $m->id }}</td>
            <td>{{ $m->name }}</td>
            <td>{{ $m->email }}</td>
            <td>{{ \Illuminate\Support\Str::limit($m->message, 60) }}</td>
            <td>{{ $m->created_at->diffForHumans() }}</td>
            <td>
                <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-outline btn-sm">View</a>
                <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" class="delete-form" style="display:inline;" data-message="Delete this message?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6">No messages yet.</td></tr>
    @endforelse
</table>

<div style="margin-top:16px;">{{ $messages->links() }}</div>
@endsection
