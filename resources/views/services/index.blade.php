@extends('layouts.public')

@section('title', 'Our Services | Golden Blade')

@section('content')

{{-- Banner --}}
<section class="sv-hero">
    <div class="container sv-wrap">
        <h1>Our <em>Services</em></h1>
        @if(auth()->check())
            <p>Welcome back, {{ auth()->user()->name }}! Ready to book?</p>
        @else
            <p>Please login to book an appointment.</p>
        @endif
    </div>
</section>

<section class="sv-main">
    <div class="container sv-wrap">

        {{-- Search --}}
        <form action="{{ route('services.index') }}" method="GET" class="sv-filter">
            <input type="text" name="search" placeholder="Search services..." value="{{ request('search') }}">
            <select name="category" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="gbs-btn">Search</button>
        </form>

        {{-- Cards --}}
        @if($services->count())
            <div class="sv-grid">
                @foreach($services as $service)
                    <article class="sv-card">
                        <a href="{{ route('services.show', $service->id) }}" class="sv-card-img">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" loading="lazy">
                            @else
                                <span class="sv-ph">{{ strtoupper(substr($service->name, 0, 1)) }}</span>
                            @endif
                            <span class="sv-tag">{{ $service->category->name }}</span>
                        </a>

                        <div class="sv-card-body">
                            <h3>{{ $service->name }}</h3>
                            <p class="sv-desc">{{ \Illuminate\Support\Str::limit($service->description ?: 'Professional grooming by our expert barbers.', 80) }}</p>

                            <div class="sv-meta">
                                <span class="sv-price">{{ number_format($service->price) }} PKR</span>
                                <span class="sv-dur">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                                    {{ $service->duration_minutes }} min
                                </span>
                            </div>

                            <div class="sv-actions">
                                <a href="{{ route('services.show', $service->id) }}" class="sv-btn-line">View</a>
                                <a href="{{ route('appointments.create', ['service' => $service->id]) }}" class="sv-btn-gold">Book Now</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="sv-empty">No services found.</p>
        @endif

        <div class="sv-pages">{{ $services->links() }}</div>
    </div>
</section>
@endsection
