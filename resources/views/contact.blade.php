@extends('layouts.public')

@section('title', 'Contact | Golden Blade')

@section('content')
<section class="section">
    <div class="container" style="max-width:600px;">
        <h2>Contact Us</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error">Your message was not sent. Please fix the errors below.</div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" class="card">
            @csrf

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror

            <label>Message</label>
            <textarea name="message" rows="4" required minlength="10">{{ old('message') }}</textarea>
            @error('message') <span class="error">{{ $message }}</span> @enderror

            <button type="submit" class="btn btn-gold">Send Message</button>
        </form>
    </div>
</section>
@endsection

 