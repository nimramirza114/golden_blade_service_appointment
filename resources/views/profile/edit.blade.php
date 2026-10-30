@extends('layouts.public')

@section('title', 'My Profile | Golden Blade')

@section('content')
<section class="section">
    <div class="container" style="max-width:600px;">
        <h2>My Profile</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="card">
            @csrf
            @method('PATCH')

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
            @error('name') <span class="error">{{ $message }}</span> @enderror

            <label>Email</label>
            <input type="text" name="email" value="{{ old('email', $user->email) }}">
            @error('email') <span class="error">{{ $message }}</span> @enderror

            @php
    $existing = preg_replace('/^\+92/', '', $profile->phone ?? '');
    $code = old('phone_code', substr($existing, 0, 3));
    $number = old('phone_number', substr($existing, 3));
@endphp

<label>Phone</label>
<div class="phone-group">
    <span class="phone-prefix">+92</span>
    <input type="text" name="phone_code" class="phone-code" inputmode="numeric" maxlength="3"
           placeholder="300" value="{{ $code }}"
           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
    <input type="text" name="phone_number" class="phone-number" inputmode="numeric" maxlength="7"
           placeholder="1234567" value="{{ $number }}"
           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
</div>
@error('phone_code') <span class="error">{{ $message }}</span> @enderror
@error('phone_number') <span class="error">{{ $message }}</span> @enderror

            <label>Address</label>
            <textarea name="address" rows="3">{{ old('address', $profile->address ?? '') }}</textarea>
            @error('address') <span class="error">{{ $message }}</span> @enderror

            <button type="submit" class="btn btn-gold">Save Changes</button>
        </form>
    </div>
</section>
@endsection
