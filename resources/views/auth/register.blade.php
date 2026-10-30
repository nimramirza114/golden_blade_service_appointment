@extends('layouts.public')

@section('title', 'Register | Golden Blade')

@section('content')
<section class="section">
    <div class="container" style="max-width:480px;">
        <h2>Create Account</h2>

        <form method="POST" action="{{ route('register') }}" class="card">
            @csrf

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" autofocus>
            @error('name') <span class="error">{{ $message }}</span> @enderror

            <label>Email</label>
            <input type="text" name="email" value="{{ old('email') }}">
            @error('email') <span class="error">{{ $message }}</span> @enderror

             <label>Password</label>
<div class="password-wrap">
    <input type="password" name="password" id="password">
    <button type="button" class="toggle-eye" data-target="password" aria-label="Show or hide password">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
    </button>
</div>
@error('password') <span class="error">{{ $message }}</span> @enderror

<label>Confirm Password</label>
<div class="password-wrap">
    <input type="password" name="password_confirmation" id="password_confirmation">
    <button type="button" class="toggle-eye" data-target="password_confirmation" aria-label="Show or hide password">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
    </button>
</div>

           

            <button type="submit" class="btn btn-gold">Register</button>

            <p class="auth-link">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </p>
            <p class="auth-link"><a href="{{ route('home') }}">&larr; Back to Home</a></p>
        </form>
    </div>
</section>
@endsection
