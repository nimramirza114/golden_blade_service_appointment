@extends('layouts.public')

@section('title', 'Login | Golden Blade')

@section('content')
<section class="section">
    <div class="container" style="max-width:480px;">
        <h2>Login</h2>

        @if(session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="card">
            @csrf

            <label>Email</label>
            <input type="text" name="email" value="{{ old('email') }}" autofocus>
            @error('email') <span class="error">{{ $message }}</span> @enderror

            <label>Password</label>
<div class="password-wrap">
    <input type="password" name="password" id="password">
    <button type="button" class="toggle-eye" data-target="password" aria-label="Show or hide password">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
    </button>
</div>
@error('password') <span class="error">{{ $message }}</span> @enderror

            <label class="check-row">
                <input type="checkbox" name="remember"> Remember me
            </label>

            <button type="submit" class="btn btn-gold">Login</button>

            <p class="auth-link">
                Don't have an account? <a href="{{ route('register') }}">Register here</a>
            </p>
            <p class="auth-link"><a href="{{ route('home') }}">&larr; Back to Home</a></p>
        </form>
    </div>
</section>
@endsection
