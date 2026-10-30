@extends('layouts.admin')

@section('title', 'Message')

@section('content')
<h1>Message #{{ $message->id }}</h1>

<div class="card" style="max-width:700px;">
    <p><strong>From:</strong> {{ $message->name }}</p>
    <p><strong>Email:</strong> <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
    <p><strong>Received:</strong> {{ $message->created_at->format('d M Y, h:i A') }}</p>
    <div class="msg-body">{{ $message->message }}</div>

    <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: your message to Golden Blade') }}" class="btn btn-gold">Reply by email</a>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline">Back</a>
</div>
@endsection
