@extends('layouts.public')

@section('title', $service->name . ' | Golden Blade')

@section('content')
<section class="sv-hero sv-hero-sm">
    <div class="container sv-wrap">
        <h1>{{ $service->name }}</h1>
        <p>{{ $service->category->name }}</p>
    </div>
</section>

<section class="sv-main">
    <div class="container sv-wrap">
        <div class="sv-detail">
            <div class="sv-detail-img">
                @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                @else
                    <span class="sv-ph sv-ph-lg">{{ strtoupper(substr($service->name, 0, 1)) }}</span>
                @endif
            </div>

            <div class="sv-detail-body">
                <span class="sv-label">{{ $service->category->name }}</span>
                <h2>{{ $service->name }}</h2>

                <div class="sv-facts">
                    <div><small>Price</small><strong>Rs {{ number_format($service->price) }}</strong></div>
                    <div><small>Duration</small><strong>{{ $service->duration_minutes }} min</strong></div>
                </div>

                <p class="sv-detail-desc">{{ $service->description ?: 'Professional grooming by our expert barbers.' }}</p>

                <h3>Available Barbers</h3>
                <div class="sv-chips">
                    @forelse($service->staff as $member)
                        <span class="sv-chip"><i>{{ strtoupper(substr($member->name, 0, 1)) }}</i>{{ $member->name }}</span>
                    @empty
                        <span class="sv-chip-none">Any available barber</span>
                    @endforelse
                </div>

                <div class="sv-detail-btns">
                    <a href="{{ route('appointments.create', ['service' => $service->id]) }}" class="gbs-btn">Book This Service <span>↗</span></a>
                    <a href="{{ route('services.index') }}" class="sv-btn-line">Back to services</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
