@extends('layouts.public')

@section('title', 'Contact | Golden Blade')

@php
    // Apni asli details yahan likhein (footer wali details ke saath match rakhein)
    $ctPhoneDisplay = '+92 344 6851972';
    $ctPhoneDial    = '+923446851972';
    $ctEmail        = 'nimramirza114@gmail.com';
    $ctAddress      = 'Pasrur, District Sialkot, Punjab, Pakistan';
    $ctMapQuery     = 'Pasrur, Sialkot, Punjab, Pakistan';
@endphp

@section('content')

{{-- 1) HERO --}}
<section class="ct-hero" style="background-image:url('{{ asset('images/banner.jpg') }}');">
    <div class="ct-hero-in">
        <span class="ct-eyebrow">Get in touch</span>
        <h1>We would love to <em>hear from you</em></h1>
    </div>
</section>

{{-- 2) INTRO BAND --}}
<section class="ct-band">
    <p>We are just a call or an email away. If you have a question, a request or some feedback, reach out and we will get back to you within 48 hours. Find our location, contact details and opening hours below.</p>
</section>

{{-- 3) DETAILS + HOURS --}}
<section class="ct-info">
    <div class="ct-wrap ct-info-grid">
        <div class="ct-photo">
            <img src="{{ asset('images/why-choose-us.jpg') }}" alt="Inside Golden Blade">
        </div>

        <div class="ct-details">
            <h2 class="ct-h">Contact us</h2>
            <p class="ct-line">{{ $ctAddress }}</p>
            <p class="ct-line"><b>Phone:</b> <a href="tel:{{ $ctPhoneDial }}">{{ $ctPhoneDisplay }}</a></p>
            <p class="ct-line"><b>WhatsApp:</b> <a href="https://wa.me/{{ ltrim($ctPhoneDial, '+') }}" target="_blank" rel="noopener">Chat with us</a></p>
            <p class="ct-line"><b>Email:</b> <a href="mailto:{{ $ctEmail }}">{{ $ctEmail }}</a></p>

            <h2 class="ct-h ct-h-gap">Our hours</h2>
            <p class="ct-line"><b>Sat – Thu:</b> 9:00 AM – 10:00 PM</p>
            <p class="ct-line"><b>Fri:</b> 2:00 PM – 10:00 PM</p>
            <p class="ct-line"><em>Hours may change during holidays.</em></p>
        </div>
    </div>
</section>

{{-- 4) MAP --}}
<section class="ct-block">
    <div class="ct-wrap">
        <span class="ct-blade" aria-hidden="true"></span>
        <h2 class="ct-h">How to find us</h2>
        <div class="ct-map">
            <iframe
                title="Golden Blade location"
                src="https://www.google.com/maps?q={{ urlencode($ctMapQuery) }}&output=embed"
                loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
    </div>
</section>

{{-- 5) MESSAGE FORM (dark, two columns) --}}
<section class="ct-msg" id="message">
    <div class="ct-msg-grid">
        <div class="ct-msg-text">
            <h2>We look forward to <br>hearing from you.</h2>
            <svg class="ct-swoosh" viewBox="0 0 290 14" preserveAspectRatio="none" aria-hidden="true"><path d="M2 10 C 70 2, 160 2, 288 8" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
            <p>Golden Blade would love to hear from you. Use the form on this page to send a message to our team, or use the details below to call us or drop in. Get in touch today.</p>
            <a class="ct-mail" href="mailto:{{ $ctEmail }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                {{ $ctEmail }}
            </a>
        </div>

        <form action="{{ route('contact.send') }}" method="POST" class="ct-form">
            @csrf

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert-error">Your message was not sent. Please fix the errors below.</div>
            @endif

            <div class="ct-row">
                <div class="ct-field">
                    <label for="first_name">First Name</label>
                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="John" required maxlength="50">
                    @error('first_name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="ct-field">
                    <label for="last_name">Last Name</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Doe" maxlength="50">
                    @error('last_name') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="ct-row">
                <div class="ct-field">
                    <label for="phone">Telephone</label>
                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" placeholder="0300 1234567" maxlength="30">
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="ct-field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required maxlength="150">
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="ct-field">
                <label for="message-box">Your Message</label>
                <textarea id="message-box" name="message" rows="5" placeholder="Type your message here..." required minlength="10" maxlength="2000">{{ old('message') }}</textarea>
                @error('message') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="ct-send">Submit Message</button>
        </form>
    </div>
</section>

@endsection