@extends('layouts.public')

@section('title', 'Home | Golden Blade')

@section('content')

{{-- Hero --}}
@php
    $heroBrands = ['Wahl', 'Andis', 'Oster', 'BaByliss Pro', 'Reuzel', 'Layrite', 'Suavecito', 'American Crew'];
@endphp

<section class="gb-hero">
    <div class="container gb-hero-inner">
        <p class="gbs-eyebrow gb-hero-eyebrow">Golden Blade &middot; Expert Barbers</p>
        <h1>Look Sharp<br>Feel <span>Confident.</span></h1>
        <p class="gb-hero-desc">Experience precision barbering designed around your style. From classic cuts &amp; modern fades to expert beard shaping and traditional hot towel shaves.</p>

        <div class="gb-ratings">
            <div class="gb-rate"><span class="gb-rate-ico" style="background:#1877F2">f</span><div><span class="gb-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span><small>5.0 Rating</small></div></div>
            <div class="gb-rate"><span class="gb-rate-ico" style="background:#fff;color:#4285F4">G</span><div><span class="gb-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span><small>5.0 Rating</small></div></div>
            <div class="gb-rate"><span class="gb-rate-ico" style="background:#D32323">Y</span><div><span class="gb-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span><small>5.0 Rating</small></div></div>
        </div>


        <form class="gb-req" method="GET" action="{{ route('appointments.create') }}">
            <h2>Request a Service</h2>
            <div class="gb-req-grid">
                <input type="text" name="name" placeholder="Your Name" aria-label="Your Name">
                <input type="tel" name="phone" placeholder="phone Number" aria-label="Your Number">
                <input type="email" name="email" placeholder="Your Email" aria-label="Your Email">
                <input type="text" name="address" placeholder="Address" aria-label="Address">
                <input type="text" name="message" placeholder="Message" aria-label="Message">
                <button type="submit" class="gbs-btn">Book Now <span>&#8599;</span></button>
            </div>
        </form>
    </div>

    <div class="gb-brands" aria-hidden="true">
        <div class="gb-brands-track">
            @for($i = 0; $i < 2; $i++)
                @foreach($heroBrands as $brand)
                    <span class="gb-brand gb-brand-{{ $loop->index % 4 }}">{{ $brand }}</span>
                @endforeach
            @endfor
        </div>
    </div>
</section>

{{-- Feature strip --}}
<section class="strip">
    <div class="container strip-grid">
        <div class="strip-item">
            <span class="strip-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M20 4 8.12 15.88M14.47 14.48 20 20M8.12 8.12 12 12"/></svg></span>
            <strong>Expert Barbers</strong>
            <span>Skilled professionals who care about every detail, from the first cut to the final finish.</span>
        </div>
        <div class="strip-item">
            <span class="strip-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9L12 3z"/></svg></span>
            <strong>Premium Products</strong>
            <span>Only top quality products from trusted brands, for a sharper look and healthier hair.</span>
        </div>
        <div class="strip-item">
            <span class="strip-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4M9 15l2 2 4-4"/></svg></span>
            <strong>Easy Booking</strong>
            <span>Book online in a few clicks and walk in right on time. No long waits.</span>
        </div>
        <div class="strip-item">
            <span class="strip-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l8 3v6c0 4.5-3.2 8-8 9-4.8-1-8-4.5-8-9V6z"/><path d="M8.5 12l2.5 2.5 4.5-5"/></svg></span>
            <strong>Hygiene First</strong>
            <span>Sterilised tools and a spotless station, kept to the highest standards of hygiene.</span>
        </div>
    </div>
</section>

{{-- Services --}}
@php
    $gbIcon = function ($name) {
        $n = strtolower($name);
        $p = fn($d) => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">'.$d.'</svg>';
        if (str_contains($n, 'kid'))   return $p('<circle cx="12" cy="12" r="9"/><path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01"/>');
        if (str_contains($n, 'combo')) return $p('<path d="M12 3 3 8l9 5 9-5-9-5zM3 13l9 5 9-5"/>');
        if (str_contains($n, 'beard')) return $p('<path d="M5 9c0-4 3-6 7-6s7 2 7 6c0 6-2 11-7 11S5 15 5 9zM8 13c1.5 1 2.5 1.5 4 1.5s2.5-.5 4-1.5"/>');
        if (str_contains($n, 'shave') || str_contains($n, 'towel')) return $p('<path d="M4 14h16v4H4zM6 14V8h8v6M14 11h4"/>');
        if (str_contains($n, 'fade'))  return $p('<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>');
        return $p('<circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M20 4 8.12 15.88M14.47 14.48 20 20M8.12 8.12 12 12"/>');
    };
@endphp

<section class="section gbs">
    <div class="container gbs-wrap">
        <div class="sec-head rv">
            <p class="gbs-eyebrow">Our Barber Services</p>
            <h2 class="sec-title gbs-title">Professional Grooming, <em>Done Right</em></h2>
            <p class="sec-sub">Discover a complete range of haircut and grooming services designed to keep you looking sharp.</p>
        </div>

        <div class="gbs-grid">
            @foreach($services->take(6) as $service)
                <div class="gbs-card">
                    <div class="gbs-ico">{!! $gbIcon($service->name) !!}</div>
                    <h3>{{ $service->name }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($service->description ?: 'Professional grooming by our expert barbers.', 85) }}</p>
                    <a href="{{ route('services.show', $service->id) }}" class="gbs-link">Read More <span>↗</span></a>
                </div>
            @endforeach
        </div>

        <div class="gbs-more rv">
            <a href="{{ route('services.index') }}" class="gbs-btn">View All Services <span>↗</span></a>
        </div>
    </div>
</section>

{{-- About --}}
<section class="section alt gb-about">
    <div class="container gb-about-wrap">
        <div class="gb-about-grid">
            <div class="gb-about-text rv">
                <p class="gbs-eyebrow">About Us</p>
                <h2 class="gb-about-title">More Than a Haircut. <em>It's Your Signature Style.</em></h2>

                <p>At Golden Blade, we believe a great haircut is more than just a fresh look. It's about confidence, personality, and feeling your best. Our barbers combine classic barbering traditions with modern techniques to deliver sharp, personalized styles for every client.</p>
                <p>From clean fades and timeless cuts to detailed beard shaping and relaxing hot towel shaves, we take pride in every detail. We listen to what you want, offer expert recommendations, and make sure you leave the chair looking and feeling your best.</p>
                <p>Whether you're getting ready for a big occasion or simply keeping your everyday style fresh, Golden Blade is your place for quality grooming, skilled craftsmanship, and a welcoming barbershop experience.</p>

                <a href="{{ url('/about') }}#team" class="gbs-btn">Meet Our Barbers <span>↗</span></a>
            </div>

            <div class="gb-about-media rv">
                <div class="gb-about-img"></div>
                <div class="gb-about-badge"><strong>10+</strong><span>Years of<br>Experience</span></div>
            </div>
        </div>
    </div>
</section>

{{-- Why choose us --}}
@php
    $whyItems = [
        ['Experienced Barbers', 'Our skilled barbers understand both classic barbering and modern styles, delivering precision with every cut.',
            '<circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M20 4 8.12 15.88M14.47 14.48 20 20M8.12 8.12 12 12"/>'],
        ['Precision Every Time', 'From clean fades to sharp line-ups, we focus on the small details that make a big difference.',
            '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/>'],
        ['Personalized Style', 'We take the time to understand your preferences and create a look that suits your face, hair, and personality.',
            '<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>'],
        ['Premium Grooming Experience', 'Enjoy a clean, comfortable, and welcoming environment where every appointment is designed around you.',
            '<path d="M12 3l2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9L12 3z"/>'],
        ['Quality Products', 'We use professional-grade grooming products to help achieve a polished finish while keeping your hair and beard looking their best.',
            '<path d="M9 3h6v4l2 3v10a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V10l2-3V3zM7 13h10"/>'],
        ['Consistent Results', "Whether you're visiting for a regular trim or a complete style change, you can count on a sharp, professional finish.",
            '<path d="M5 12l4.5 4.5L19 7"/><circle cx="12" cy="12" r="9"/>'],
    ];
@endphp

<section class="section gb-why">
    <div class="container gb-why-wrap">
        <div class="gb-why-grid">
            <div class="gb-why-left rv">
                <div class="gb-why-img"></div>
                <div class="gb-why-cta">
                    <div>
                        <h4>Ready for a Sharper Look?</h4>
                        <p>Reserve your chair online in just a few clicks.</p>
                    </div>
                    <a href="{{ route('appointments.create') }}" class="gbs-btn">Book Your Next Cut <span>↗</span></a>
                </div>
            </div>

            <div class="gb-why-right">
                <div class="rv">
                    <p class="gbs-eyebrow">Why Choose Us</p>
                    <h2 class="gb-why-title">Why Clients<br>Choose Golden Blade</h2>
                    <p class="gb-why-sub">At Golden Blade, we combine skilled craftsmanship, personalized service, and a premium barbershop atmosphere to give you a grooming experience worth coming back to.</p>
                </div>

                <div class="gb-why-list">
                    @foreach($whyItems as $item)
                        <div class="gb-why-item">
                            <div class="gb-why-head">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">{!! $item[2] !!}</svg>
                                <h3>{{ $item[0] }}</h3>
                            </div>
                            <p>{{ $item[1] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- How it works --}}
<section class="section gb-steps-sec">
    <div class="container gb-steps-wrap">
        <div class="sec-head rv">
            <p class="gbs-eyebrow">How It Works</p>
            <h2 class="sec-title gbs-title">Your Fresh Look in <em>3 Simple Steps</em></h2>
            <p class="sec-sub">Getting a sharp, professional look at Golden Blade is easy. Choose your service, sit back, and let our experienced barbers take care of the rest.</p>
        </div>

        <div class="gb-steps rv">
            <div class="gb-step" tabindex="0">
                <div class="gb-step-head">
                    <span class="gb-step-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4M9 15l2 2 4-4"/></svg></span>
                    <span class="gb-step-no">Step 01</span>
                </div>
                <h3>Book Your Appointment</h3>
                <p>Pick your service, choose a barber and a time that suits you, and confirm your booking online in just a few clicks.</p>
            </div>

            <div class="gb-step active" tabindex="0">
                <div class="gb-step-head">
                    <span class="gb-step-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg></span>
                    <span class="gb-step-no">Step 02</span>
                </div>
                <h3>Tell Us Your Style</h3>
                <p>When you arrive, let your barber know the look you're after. Bring a reference photo or ask for our professional recommendation.</p>
            </div>

            <div class="gb-step" tabindex="0">
                <div class="gb-step-head">
                    <span class="gb-step-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M6 11V6a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v5M4 11h16v4H4zM7 15v4M17 15v4M5 19h14"/></svg></span>
                    <span class="gb-step-no">Step 03</span>
                </div>
                <h3>Sit Back and Get Sharp</h3>
                <p>Relax in the chair while our barber delivers a precise cut and a polished finish, and walk out looking and feeling your best.</p>
            </div>
        </div>
    </div>
</section>

{{-- Team --}}
<section class="section alt gb-team">
    <div class="container gb-team-wrap">
        <div class="gb-team-top rv">
            <div>
                <p class="gbs-eyebrow">Our Team</p>
                <h2 class="gb-team-title">Meet the Barbers<br>Behind the Chair</h2>
            </div>
            <div class="gb-team-nav">
                <button type="button" class="gb-nav-btn" id="team-prev" aria-label="Previous">←</button>
                <button type="button" class="gb-nav-btn" id="team-next" aria-label="Next">→</button>
            </div>
        </div>

        <div class="gb-team-track rv" id="team-track">
            @foreach($team as $member)
                @php $photo = $member->image ?? $member->photo ?? null; @endphp
                <div class="gb-member">
                    @if($photo)
                        <img src="{{ asset('storage/' . $photo) }}" alt="{{ $member->name }}">
                    @else
                        <div class="gb-member-ph">{{ strtoupper(substr($member->name, 0, 1)) }}</div>
                    @endif
                    <div class="gb-member-label">
                        <h3>{{ $member->name }}</h3>
                        <span>{{ $member->role ?? $member->specialty ?? 'Barber' }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="gbs-more rv">
            <a href="{{ url('/about') }}#team" class="gbs-btn">Meet Our Full Team <span>↗</span></a>
        </div>
    </div>
</section>

{{-- Testimonials --}}
@php
    $reviews = [
        ['Michael R.', "Best barber shop I've been to in a long time. The fade was incredibly clean, and my barber took the time to get every detail right. I'll definitely be back.", '#5aa02c'],
        ['James T.', "Excellent service from start to finish. The barber understood exactly what I wanted and gave me one of the best cuts I've had.", '#2f5fb3'],
        ['Daniel K.', "Clean shop, friendly team and a perfect beard trim. The hot towel finish was a great touch. Highly recommended.", '#b3402f'],
        ['Ryan M.', "I booked online in a minute and was in the chair right on time. Sharp haircut and great advice on styling.", '#7a4fb3'],
        ['Adam S.', "My son's first proper haircut here and he loved it. Patient barbers and a really welcoming atmosphere.", '#2f9aa0'],
        ['Chris P.', "Consistent every single visit. Always leave looking sharp and feeling confident. Best barbershop around.", '#c27a1a'],
    ];
@endphp

<section class="section gb-testi">
    <div class="container gb-testi-wrap">
        <div class="gb-testi-grid">
            <div class="gb-testi-left rv">
                <p class="gbs-eyebrow">Testimonials</p>
                <h2 class="gb-testi-title">What Our<br>Clients Say</h2>
                <p class="gb-testi-sub">Great cuts, attention to detail, a barbershop experience you count on. See why clients keep coming back to Golden Blade.</p>

                <div class="gb-rating">
                    <span class="gb-g">G</span>
                    <strong>5.0</strong>
                    <span class="gb-stars">★★★★★</span>
                    <span class="gb-rating-count">74+ Reviews</span>
                </div>

                <a href="{{ route('appointments.create') }}" class="gbs-btn">Book Your Appointment <span>↗</span></a>
            </div>

            <div class="gb-testi-right rv">
                <div class="gb-testi-view">
                    <div class="gb-testi-track" id="testi-track">
                        @foreach(collect($reviews)->chunk(2) as $pair)
                            <div class="gb-testi-slide">
                                @foreach($pair as $r)
                                    <div class="gb-review">
                                        <div class="gb-review-avatar" style="background:{{ $r[2] }}">
                                            {{ strtoupper(substr($r[0], 0, 1)) }}<i>G</i>
                                        </div>
                                        <h3>{{ $r[0] }}</h3>
                                        <div class="gb-stars">★★★★★</div>
                                        <p>“{{ $r[1] }}”</p>
                                        <div class="gb-review-mark">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 9c0-4 3-6 7-6s7 2 7 6c0 6-2 11-7 11S5 15 5 9z"/><path d="M8 12c1.5 1.2 2.5 1.8 4 1.8s2.5-.6 4-1.8M10 9h.01M14 9h.01"/></svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="gb-testi-ctrl">
                    <button type="button" class="gb-nav-btn gb-nav-dark" id="testi-prev" aria-label="Previous">←</button>
                    <div class="gb-dots" id="testi-dots">
                        @foreach(collect($reviews)->chunk(2) as $i => $pair)
                            <button type="button" class="{{ $i === 0 ? 'on' : '' }}" aria-label="Slide {{ $i + 1 }}"></button>
                        @endforeach
                    </div>
                    <button type="button" class="gb-nav-btn gb-nav-gold" id="testi-next" aria-label="Next">→</button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ --}}
@php
    $faqs = [
        ['Do I Need To Book An Appointment?', 'Walk-ins are welcome when a barber is free, but booking online guarantees your time slot and saves you waiting.'],
        ['How Long Does A Haircut Take?', 'Most haircuts take around 30 to 45 minutes. Fades, beard work and combo services can take a little longer.'],
        ['Do You Offer Beard Grooming?', 'Yes. We offer beard trims, shaping and hot towel shaves, either on their own or combined with a haircut.'],
        ['Can I Request A Specific Barber?', 'Absolutely. You can choose your preferred barber when you book your appointment online.'],
        ['Do You Offer Haircuts For Kids?', 'Yes. Our barbers are patient and experienced with younger clients, and we have a dedicated kids haircut service.'],
        ['Can I Show My Barber A Reference Photo?', 'Of course. A reference photo is the best way to explain the look you want, and your barber will adapt it to suit you.'],
        ["What If I Don't Know Which Haircut Suits Me?", 'No problem. Our experienced barbers can recommend a style based on your hair type, face shape, lifestyle, and personal preferences.'],
    ];
@endphp

<section class="section alt gb-faq">
    <div class="container gb-faq-wrap">
        <div class="gb-faq-grid">
            <div class="gb-faq-left rv">
                <p class="gbs-eyebrow">FAQ</p>
                <h2 class="gb-faq-title">Frequently Asked<br>Questions</h2>
                <p class="gb-faq-sub">Everything you need to know before your next visit to Golden Blade.</p>

                <div class="gb-faq-img">
                    <div class="gb-faq-card">
                        <div class="gb-faces">
                            <span style="background:#B8935A">A</span>
                            <span style="background:#2f5fb3">M</span>
                            <span style="background:#5aa02c">J</span>
                            <span style="background:#1A1A1A">D</span>
                        </div>
                        <h3>Still Have Any Question?</h3>
                        <p>We're ready to help you to answer any question.</p>
                        <a href="{{ route('appointments.create') }}" class="gbs-btn">Book Your Appointment <span>↗</span></a>
                    </div>
                </div>
            </div>

            <div class="gb-faq-list rv" id="faq-list">
                @foreach($faqs as $i => $faq)
                    <div class="gb-faq-item {{ $loop->last ? 'open' : '' }}">
                        <button type="button" class="gb-faq-q" aria-expanded="{{ $loop->last ? 'true' : 'false' }}">
                            <span>{{ $faq[0] }}</span>
                            <i><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></i>
                        </button>
                        <div class="gb-faq-a"><p>{{ $faq[1] }}</p></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Call CTA --}}
@php
    $shopPhoneDisplay = '0344 6851972';   // jo screen par dikhega
    $shopPhoneDial    = '+923446851972';  // call link (tel:) ke liye
    $shopWhatsapp     = '923446851972';   // WhatsApp link ke liye, + ke bina
@endphp

<section class="gb-call">
    <div class="gb-call-inner rv">
        <a href="tel:{{ $shopPhoneDial }}" class="gb-call-ico" aria-label="Call us">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg>
        </a>
        <p class="gb-call-text">Let Us Have The Opportunity To Serve You.</p>
        <a href="tel:{{ $shopPhoneDial }}" class="gb-call-num">{{ $shopPhoneDisplay }}</a>

        <div class="gb-call-btns">
            <a href="{{ route('appointments.create') }}" class="gbs-btn">Book Your Appointment <span>↗</span></a>
            <a href="https://wa.me/{{ $shopWhatsapp }}?text={{ urlencode('Hello Golden Blade, I would like to book an appointment.') }}" target="_blank" rel="noopener" class="gb-call-wa">Chat on WhatsApp</a>
        </div>
    </div>
</section>

{{-- Contact banner --}}
<section class="banner-split">
    <div class="banner-dark">
        <p class="eyebrow">Walk in or book online</p>
        <h2>Your Style,<br>Our Passion.</h2>
        <p>Experience the perfect blend of style, comfort, and confidence.</p>
    </div>
    <div class="banner-img"></div>
    <div class="banner-cta">
        <p class="eyebrow">Ready for a fresh look?</p>
        <h2>Book Your Appointment Today</h2>
        <ul class="banner-perks">
            <li>Quick and easy online booking</li>
            <li>Expert barbers, personal service</li>
            <li>Clean, relaxed and welcoming shop</li>
        </ul>
        <div class="banner-btns">
            <a href="{{ route('appointments.create') }}" class="gbs-btn">Book Now <span>&#8599;</span></a>
            <a href="tel:{{ $shopPhoneDial }}" class="banner-call">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg>
                {{ $shopPhoneDisplay }}
            </a>
        </div>
    </div>
</section>

{{-- Page scripts --}}
<script>
(function () {
    var list = document.getElementById('faq-list');
    if (!list) return;
    var items = list.querySelectorAll('.gb-faq-item');

    function setOpen(item, open) {
        var panel = item.querySelector('.gb-faq-a');
        item.classList.toggle('open', open);
        item.querySelector('.gb-faq-q').setAttribute('aria-expanded', open ? 'true' : 'false');
        panel.style.maxHeight = open ? panel.scrollHeight + 'px' : '0px';
    }

    items.forEach(function (item) {
        setOpen(item, item.classList.contains('open'));
        item.querySelector('.gb-faq-q').addEventListener('click', function () {
            var willOpen = !item.classList.contains('open');
            items.forEach(function (other) { setOpen(other, false); });
            if (willOpen) setOpen(item, true);
        });
    });

    window.addEventListener('resize', function () {
        items.forEach(function (item) {
            if (item.classList.contains('open')) {
                var panel = item.querySelector('.gb-faq-a');
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        });
    });
})();

(function () {
    var track = document.getElementById('testi-track');
    if (!track) return;
    var slides = track.children.length;
    var dots = document.querySelectorAll('#testi-dots button');
    var index = 0, timer;

    function go(i) {
        index = (i + slides) % slides;
        track.style.transform = 'translateX(' + (-index * 100) + '%)';
        dots.forEach(function (d, n) { d.classList.toggle('on', n === index); });
    }
    function auto() { clearInterval(timer); timer = setInterval(function () { go(index + 1); }, 6000); }

    document.getElementById('testi-prev').addEventListener('click', function () { go(index - 1); auto(); });
    document.getElementById('testi-next').addEventListener('click', function () { go(index + 1); auto(); });
    dots.forEach(function (d, n) { d.addEventListener('click', function () { go(n); auto(); }); });
    track.addEventListener('mouseenter', function () { clearInterval(timer); });
    track.addEventListener('mouseleave', auto);
    auto();
})();

(function () {
    var track = document.getElementById('team-track');
    if (!track) return;
    var prev = document.getElementById('team-prev');
    var next = document.getElementById('team-next');

    function step() {
        var card = track.querySelector('.gb-member');
        return card ? card.offsetWidth + 22 : 300;
    }
    function update() {
        prev.disabled = track.scrollLeft <= 4;
        next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
    }
    prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: 'smooth' }); });
    next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: 'smooth' }); });
    track.addEventListener('scroll', update);
    window.addEventListener('resize', update);
    update();
})();

(function () {
document.querySelectorAll('.gb-steps').forEach(function (wrap) {
    var items = wrap.querySelectorAll('.gb-step');
    items.forEach(function (it) {
        ['mouseenter', 'click', 'focus'].forEach(function (ev) {
            it.addEventListener(ev, function () {
                items.forEach(function (x) { x.classList.remove('active'); });
                it.classList.add('active');
            });
        });
    });
});
})();

(function () {
    document.documentElement.classList.add('js-anim');
    document.addEventListener('DOMContentLoaded', function () {
        var els = document.querySelectorAll('.rv, .cards-4 > *, .gbs-grid > *, .gb-why-list > *');

        if (!('IntersectionObserver' in window)) {
            els.forEach(function (el) { el.classList.add('in'); });
            return;
        }

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (!e.isIntersecting) return;
                var el = e.target;
                el.classList.add('in');
                setTimeout(function () { el.style.transitionDelay = ''; }, 1800);
                io.unobserve(el);
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        els.forEach(function (el) {
            el.classList.add('rv');
            var parent = el.parentElement;
            if (parent.classList.contains('cards-4') || parent.classList.contains('gbs-grid') || parent.classList.contains('gb-why-list')) {
                var idx = Array.prototype.indexOf.call(parent.children, el);
                el.style.transitionDelay = (idx * 120) + 'ms';
            }
            io.observe(el);
        });
    });
})();
</script>

@endsection
