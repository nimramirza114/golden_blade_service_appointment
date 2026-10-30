@extends('layouts.public')

@section('title', 'About Us | Golden Blade')

@section('content')
@php
    // Barber team (same $team that the home page uses). Falls back to placeholders if empty.
    $team = collect($team ?? []);
        $pola = $team->take(5)->values()->map(function ($m, $i) {
        $file = 'images/about/pola-' . ($i + 1) . '.jpg';
        $own  = $m->image ?? $m->photo ?? null;
        return [
            'name' => $m->name,
            'role' => $m->role ?? $m->specialty ?? 'Barber',
            'src'  => file_exists(public_path($file)) ? asset($file) : ($own ? asset('storage/' . $own) : null),
        ];
    });
    if ($pola->isEmpty()) {
        $pola = collect([
            ['name' => 'Master Barber',   'role' => 'Classic Cuts',  'img' => null],
            ['name' => 'Fade Specialist', 'role' => 'Skin Fades',    'img' => null],
            ['name' => 'Beard Expert',    'role' => 'Beard Styling', 'img' => null],
            ['name' => 'Style Artist',    'role' => 'Modern Styles', 'img' => null],
            ['name' => 'Head Barber',     'role' => 'Hot Towel Shave', 'img' => null],
        ]);
    }
    $rot = [-6, 4, -2, 5, -5];
    $off = [34, 0, 42, 8, 38];

    $members = $team->map(fn($m) => [
        'name' => $m->name,
        'role' => $m->role ?? $m->specialty ?? 'Barber',
        'img'  => $m->image ?? $m->photo ?? null,
    ])->values();
    if ($members->isEmpty()) {
        $members = $pola->take(4);
    }

    $ic = fn($d) => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">'.$d.'</svg>';
@endphp

{{-- 1. Hero + barber photos --}}
<section class="ap-hero">
    <div class="container ap-wrap">
                <h1>The Barbers Behind <em>Every Sharp Cut</em></h1>
        <p class="ap-lead">At Golden Blade, our barbers are dedicated to precision cuts, clean fades and a grooming experience you can count on, every single visit.</p>
        <div class="ap-hero-btns">
            <a href="{{ route('appointments.create') }}" class="gbs-btn">Book Now <span>↗</span></a>
            <a href="{{ route('services.index') }}" class="ap-btn-line">Our Services</a>
        </div>
    </div>

    <div class="ap-pola-wrap">
        <div class="ap-pola-row">
            @foreach($pola as $i => $p)
                <div class="ap-pola" style="transform:rotate({{ $rot[$i % 5] }}deg);margin-top:{{ $off[$i % 5] }}px">
                                         <div class="ap-pola-img">
                        @if(!empty($p['src']))
                            <img src="{{ $p['src'] }}" alt="{{ $p['name'] }}">
                        @else
                            <span class="ap-pola-ph">{{ strtoupper(substr($p['name'], 0, 1)) }}</span>
                        @endif
                    </div>
                    <h3>{{ $p['name'] }}</h3>
                    <span>{{ $p['role'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 2. Intro statement --}}
<section class="ap-intro">
    <div class="container ap-wrap">
        <h2 class="ap-h2">We're a small crew of barbers and groomers obsessed with the perfect cut.</h2>
        <p class="ap-intro-sub">Built by a team who lives and breathes barbering.</p>
    </div>
</section>

{{-- 3. Stats grid --}}
<section class="ap-block">
    <div class="container ap-wrap">
        <div class="ap-cards ap-stats">
            <div class="ap-stat">
                <span class="ap-ico">{!! $ic('<circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M20 4 8.12 15.88M14.47 14.48 20 20M8.12 8.12 12 12"/>') !!}</span>
                <strong>{{ $stats['barbers'] }}</strong>
                <h3>Expert Barbers</h3>
                <p>Skilled team dedicated to giving you the best cut.</p>
            </div>
            <div class="ap-stat">
                <span class="ap-ico">{!! $ic('<path d="M12 3l2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9L12 3z"/>') !!}</span>
                <strong>{{ $stats['services'] }}</strong>
                <h3>Grooming Services</h3>
                <p>Haircuts, fades, beard styling and hot towel shaves.</p>
            </div>
            <div class="ap-stat">
                <span class="ap-ico">{!! $ic('<circle cx="12" cy="9" r="6"/><path d="M8.5 14L7 22l5-3 5 3-1.5-8"/>') !!}</span>
                <strong>10+</strong>
                <h3>Years of Experience</h3>
                <p>A decade of classic craft mixed with modern styles.</p>
            </div>
            <div class="ap-stat">
                <span class="ap-ico">{!! $ic('<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/><path d="M9 12l2 2 4-4"/>') !!}</span>
                <strong>100%</strong>
                <h3>Hygiene Standards</h3>
                <p>Sterilised tools and a clean station for every client.</p>
            </div>
        </div>
    </div>
</section>

{{-- 4. Vision & mission --}}
<section class="ap-vision">
    <div class="container ap-wrap">
                <h2 class="ap-h2">Our Vision &amp; Mission To Redefine <em>Modern Barbering</em></h2>
        <p class="ap-lead">We blend traditional barbering with modern style to give every client a sharp, personal look, in a clean and welcoming shop.</p>
    </div>
</section>

{{-- 5. Text + image blocks --}}
<section class="ap-block">
    <div class="container ap-wrap">
        <div class="ap-rows">
            <div class="ap-row">
                <div class="ap-row-text">
                    <span class="ap-tag">Precision &amp; Style</span>
                    <h3>Redefining The Haircut Experience</h3>
                    <p>Every client is different. We listen first, recommend honestly and then deliver a cut that suits your face, hair and lifestyle.</p>
                    <ul class="ap-list">
                        <li>A quick consultation before every cut</li>
                        <li>Clean fades and sharp line-ups</li>
                        <li>Styles for kids, teens and adults</li>
                    </ul>
                </div>
                <div class="ap-row-img ap-img-a"></div>
            </div>

            <div class="ap-row ap-row-rev">
                <div class="ap-row-text">
                    <span class="ap-tag">Quality &amp; Care</span>
                    <h3>Premium Grooming With Personal Attention</h3>
                    <p>From a quick trim to a relaxing hot towel shave, we use professional-grade products and take our time on every detail.</p>
                    <ul class="ap-list">
                        <li>Professional-grade grooming products</li>
                        <li>Beard shaping and hot towel shaves</li>
                        <li>A clean, relaxed and welcoming shop</li>
                    </ul>
                </div>
                <div class="ap-row-img ap-img-b"></div>
            </div>
        </div>
    </div>
</section>

{{-- 6. Core values --}}
<section class="ap-vision ap-values-head">
    <div class="container ap-wrap">
        <span class="ap-tag">What We Stand For</span>
        <h2 class="ap-h2">The Core Values Driving <em>Golden Blade's</em> Success</h2>
        <p class="ap-lead">Great barbering is built on skill, care and consistency. These are the standards we hold ourselves to.</p>
    </div>
</section>

<section class="ap-block">
    <div class="container ap-wrap">
        <div class="ap-values-banner">
            <div class="ap-values-text">
                <span class="ap-tag">Our Promise</span>
                <h3>Skill, Care &amp; Consistency In Every Visit</h3>
                <p>Whether it is your first visit or your fiftieth, you can count on the same sharp result and the same warm welcome.</p>
                <a href="{{ route('appointments.create') }}" class="gbs-btn">Book Your Appointment <span>↗</span></a>
            </div>
            <div class="ap-values-img"></div>
        </div>

        <div class="ap-cards ap-values">
            <div class="ap-value">
                <span class="ap-ico">{!! $ic('<circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M20 4 8.12 15.88M14.47 14.48 20 20M8.12 8.12 12 12"/>') !!}</span>
                <h3>Precision In Every Cut</h3>
                <p>Clean fades and sharp line-ups, with attention to the small details that make a big difference.</p>
            </div>
            <div class="ap-value">
                <span class="ap-ico">{!! $ic('<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/><path d="M9 12l2 2 4-4"/>') !!}</span>
                <h3>Hygiene Without Compromise</h3>
                <p>Sterilised tools, fresh towels and a clean station, every client, every time.</p>
            </div>
            <div class="ap-value">
                <span class="ap-ico">{!! $ic('<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>') !!}</span>
                <h3>Personal Style For Everyone</h3>
                <p>We tailor each look to your hair type, face shape and personality, not a one-size-fits-all cut.</p>
            </div>
            <div class="ap-value">
                <span class="ap-ico">{!! $ic('<path d="M9 3h6v4l2 3v10a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V10l2-3V3zM7 13h10"/>') !!}</span>
                <h3>Premium Products</h3>
                <p>Professional-grade grooming products for a polished finish that keeps its shape.</p>
            </div>
            <div class="ap-value">
                <span class="ap-ico">{!! $ic('<path d="M12 3l2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9L12 3z"/>') !!}</span>
                <h3>Welcoming Atmosphere</h3>
                <p>A relaxed, friendly shop where kids, teens and adults all feel at home.</p>
            </div>
            <div class="ap-value">
                <span class="ap-ico">{!! $ic('<path d="M21 12a9 9 0 1 1-3-6.7"/><path d="M21 4v5h-5"/>') !!}</span>
                <h3>Always Improving</h3>
                <p>We keep learning new techniques and trends so your look is always current.</p>
            </div>
        </div>
    </div>
</section>

{{-- 7. Our barbers (whole team) --}}
<section class="ap-vision ap-lead-sec">
    <div class="container ap-wrap">
        <span class="ap-tag">Our Team</span>
        <h2 class="ap-h2">Meet The Master Barbers Behind Golden Blade</h2>
        <p class="ap-lead">The skilled hands behind every fade, trim and shave at our shop.</p>
    </div>
</section>

<section class="ap-block ap-block-tight">
    <div class="container ap-wrap">
        <div class="ap-team">
            @foreach($members as $p)
                <div class="ap-member">
                    <div class="ap-member-img">
                        @if($p['img'])
                            <img src="{{ asset('storage/' . $p['img']) }}" alt="{{ $p['name'] }}">
                        @else
                            <span class="ap-pola-ph">{{ strtoupper(substr($p['name'], 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="ap-member-info">
                        <h3>{{ $p['name'] }}</h3>
                        <span>{{ $p['role'] }}</span>
                        <a href="{{ route('appointments.create') }}" class="gbs-link">Book Now <span>↗</span></a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="ap-more">
            <p>Not sure who to pick? Every barber at Golden Blade will give you a sharp, personal cut.</p>
            <div class="ap-more-btns">
                <a href="{{ route('appointments.create') }}" class="gbs-btn">Book Appointment <span>↗</span></a>
                <a href="{{ route('services.index') }}" class="ap-btn-line">View Our Services</a>
            </div>
        </div>
    </div>
</section>

{{-- 8. CTA --}}
<section class="ap-cta">
    <div class="container ap-wrap">
                <h2 class="ap-h2">Ready For Your <em>Sharpest Look?</em></h2>
        <p class="ap-lead">Leave your number and book your appointment in a few clicks.</p>
        <form class="ap-mail" method="GET" action="{{ route('appointments.create') }}">
            <input type="tel" name="phone" placeholder="Your phone number" aria-label="Your phone number">
            <button type="submit" class="gbs-btn">Book Now <span>↗</span></button>
        </form>
    </div>
</section>
@endsection
