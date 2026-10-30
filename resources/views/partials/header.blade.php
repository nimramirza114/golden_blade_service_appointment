<header class="site-header" id="site-header">
    <div class="container nav">
        <a href="{{ route('home') }}" class="brand" aria-label="Golden Blade Hair Cutting Salon">
            <img src="{{ asset('images/logo.png') }}" alt="Golden Blade Hair Cutting Salon" class="brand-logo">
            <span class="brand-text">GOLDEN BLADE<small>HAIR CUTTING CENTER</small></span>
        </a>

        <button type="button" class="nav-toggle" id="nav-toggle" aria-label="Menu">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
        </button>

        <nav class="nav-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </nav>

        <div class="nav-actions">
            @auth
                @include('partials.notification-bell')
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-link-plain">Admin Panel</a>
                @else
                    <a href="{{ route('appointments.index') }}" class="nav-link-plain">My Appointments</a>
                    <a href="{{ route('profile.edit') }}" class="nav-link-plain">{{ auth()->user()->name }}</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link-plain nav-logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link-plain">Login</a>
                <a href="{{ route('register') }}" class="nav-link-plain">Register</a>
            @endauth
            <a href="{{ route('appointments.create') }}" class="btn btn-gold">Book Now</a>
        </div>
    </div>
</header>

{{-- Add this to your CSS:
.brand{display:flex;align-items:center}
.brand-logo{height:64px;width:auto;display:block;transition:height .25s}
.site-header.scrolled .brand-logo{height:52px}
@media(max-width:600px){.brand-logo{height:52px}}
--}}
