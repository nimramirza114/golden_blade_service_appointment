@php
    // Apni asli details yahan likhein
    $footPhoneDisplay = '+92 344 6851972';
    $footPhoneDial    = '+923446851972';
    $footEmail        = 'nimramirza114@gmail.com';
    $footAddress      = 'pasrur, district sialkot, Punjab Pakistan';
    $footHoursWeek    = '9:00 AM – 10:00 PM';
    $footHoursWeekend = '2:00 PM – 10:00 PM';
@endphp

<footer class="site-footer gb-foot">
    <div class="container gb-foot-wrap">
        <div class="gb-foot-grid">

            {{-- Brand --}}
            <div class="gb-foot-brand">
                <a href="{{ route('home') }}" class="brand" aria-label="Golden Blade Hair Cutting Salon">
                    <img src="{{ asset('images/logo.png') }}" alt="Golden Blade Hair Cutting Salon" class="brand-logo">
                    <span class="brand-text">GOLDEN BLADE<small>HAIR CUTTING CENTER</small></span>
                </a>

                <p class="gb-foot-desc">Professional barbering with precision, personality, and attention to detail. From classic cuts and modern fades to beard grooming and hot towel shaves.</p>

                <div class="gb-social">
                    <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 8V6.5c0-.7.2-1 1.1-1H17V2.2C16.6 2.1 15.6 2 14.5 2 12 2 10.3 3.5 10.3 6.2V8H8v3.4h2.3V22H14V11.4h2.7L17 8h-3z"/></svg></a>
                    <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6" fill="currentColor"/></svg></a>
                    <a href="#" aria-label="X"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.8 3h3.1l-6.8 7.7L22 21h-6.2l-4.9-6.4L5.3 21H2.2l7.2-8.3L1.9 3h6.4l4.4 5.8L17.8 3zm-1.1 16.2h1.7L7.3 4.7H5.5l11.2 14.5z"/></svg></a>
                    <a href="https://wa.me/{{ ltrim($footPhoneDial, '+') }}" target="_blank" rel="noopener" aria-label="WhatsApp"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.6-4.8A8.5 8.5 0 1 1 8 19.5L3 21z"/><path d="M9 9c0 3.5 2.5 6 6 6l1-1.5-2-1-1 .7c-1-.4-1.8-1.2-2.2-2.2l.7-1-1-2L9 9z"/></svg></a>
                </div>
            </div>

            {{-- Quick links --}}
            <div>
                <h4>Quick Links</h4>
                <ul class="gb-foot-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('services.index') }}">Our Services</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('appointments.create') }}">Book Appointment</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4>Our Services</h4>
                <ul class="gb-foot-links">
                    <li><a href="{{ route('services.index') }}">Classic Haircuts</a></li>
                    <li><a href="{{ route('services.index') }}">Skin Fades</a></li>
                    <li><a href="{{ route('services.index') }}">Beard Trims</a></li>
                    <li><a href="{{ route('services.index') }}">Hot Towel Shaves</a></li>
                    <li><a href="{{ route('services.index') }}">Hair &amp; Beard Combos</a></li>
                    <li><a href="{{ route('services.index') }}">Kids Haircut</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4>Contact Info</h4>
                <ul class="gb-foot-contact">
                    <li>
                        <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg></span>
                        <span class="txt"><a href="tel:{{ $footPhoneDial }}">{{ $footPhoneDisplay }}</a></span>
                    </li>
                    <li>
                        <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span>
                        <span class="txt"><a href="mailto:{{ $footEmail }}">{{ $footEmail }}</a></span>
                    </li>
                    <li>
                        <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-6.2 7-11.5A7 7 0 0 0 5 9.5C5 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/></svg></span>
                        <span class="txt">{{ $footAddress }}</span>
                    </li>
                </ul>

                <div class="gb-hours">
                    <div><strong>Sat – Thu</strong><span>{{ $footHoursWeek }}</span></div>
                    <div><strong>Fri</strong><span>{{ $footHoursWeekend }}</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="gb-foot-bottom">
        <div class="container">
            <span>© {{ date('Y') }} <strong>Golden Blade</strong> Hair Cutting Center. All Rights Reserved.</span>
            <nav>
                <a href="#">Privacy Policy</a><span>|</span><a href="#">Terms &amp; Conditions</a>
            </nav>
                       <a href="https://wa.me/{{ ltrim($footPhoneDial, '+') }}?text={{ urlencode('Hello Golden Blade, I would like to book an appointment.') }}" target="_blank" rel="noopener" class="gb-wa" aria-label="Chat on WhatsApp">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M20.5 3.5A11.9 11.9 0 0 0 12 0C5.4 0 .1 5.3.1 11.9c0 2.1.6 4.2 1.6 6L0 24l6.3-1.7a11.9 11.9 0 0 0 5.700 1.5c6.600 0 11.900-5.300 11.900-11.900 0-3.200-1.200-6.200-3.400-8.400zM12 21.800c-1.800 0-3.600-.5-5.100-1.400l-.4-.2-3.700 1 1-3.600-.2-.4a9.800 9.800 0 0 1-1.500-5.200c0-5.400 4.400-9.800 9.900-9.800 2.600 0 5.100 1 6.900 2.900a9.700 9.700 0 0 1 2.900 6.900c0 5.400-4.500 9.800-9.800 9.800zm5.400-7.300c-.3-.1-1.800-.9-2-1-.3-.1-.5-.1-.7.1l-.9 1.100c-.2.2-.3.2-.6.1-1.800-.9-2.900-1.600-4-3.600-.3-.5.3-.5.9-1.600.1-.2 0-.4 0-.5l-.9-2.200c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.400s1 2.800 1.200 3c.1.200 2 3.100 4.900 4.300 1.800.8 2.500.9 3.400.7.600-.1 1.800-.7 2-1.400.3-.7.3-1.300.2-1.400-.1-.1-.3-.2-.6-.3z"/></svg>
            </a>
        </div>
    </div>
</footer>
