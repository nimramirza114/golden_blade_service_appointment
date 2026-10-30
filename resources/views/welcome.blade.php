<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Golden Blade | Men's Grooming</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        :root {
            --forest: #123C32;
            --forest-light: #1C5948;
            --gold: #D9B56D;
            --cream: #F8F5EC;
            --white: #FFFFFF;
            --text: #26342F;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--forest);
            color: var(--white);
        }

        a {
            text-decoration: none;
        }

        /* NAVBAR */

        .main-navbar {
            background: var(--forest);
            padding: 20px 0;
            border-bottom: 1px solid rgba(217, 181, 109, 0.15);
        }

        .navbar-brand {
            color: var(--gold) !important;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            border: 1px solid var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            color: var(--gold);
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 23px;
            font-weight: 700;
            letter-spacing: 2px;
            line-height: 1.2;
        }

        .brand-subtitle {
            display: block;
            font-size: 9px;
            letter-spacing: 3px;
            text-align: center;
            margin-top: 5px;
        }

        .navbar-nav .nav-link {
            color: var(--white);
            font-size: 13px;
            margin: 0 10px;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: var(--gold);
        }

        .btn-gold {
            background: var(--gold);
            color: var(--forest);
            border: 1px solid var(--gold);
            padding: 13px 23px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-gold:hover {
            background: transparent;
            color: var(--gold);
        }

        .btn-outline-light-custom {
            color: var(--white);
            border: 1px solid rgba(255,255,255,0.8);
            padding: 13px 23px;
            border-radius: 4px;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-outline-light-custom:hover {
            background: var(--white);
            color: var(--forest);
        }

        .navbar-toggler {
            border-color: var(--gold);
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        /* HERO SECTION */

        .hero-section {
            min-height: 650px;
            display: flex;
            align-items: center;
            padding: 65px 0;
            overflow: hidden;
        }

        .hero-eyebrow {
            color: var(--gold);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        .hero-eyebrow i {
            margin-right: 12px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(43px, 5vw, 69px);
            font-weight: 600;
            line-height: 1.12;
            letter-spacing: -1.5px;
            margin-bottom: 24px;
        }

        .hero-title span {
            color: var(--gold);
            font-style: italic;
        }

        .hero-description {
            color: #E0E8E3;
            font-size: 15px;
            line-height: 2;
            max-width: 480px;
            margin-bottom: 27px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .hero-image-frame {
            position: relative;
            padding: 12px;
            border: 1px solid rgba(217,181,109,0.65);
            border-radius: 190px 190px 8px 8px;
        }

        .hero-image {
            display: block;
            width: 100%;
            height: 435px;
            object-fit: cover;
            object-position: center;
            border: 2px solid var(--gold);
            border-radius: 180px 180px 5px 5px;
        }

        .hero-stats {
            display: flex;
            gap: 38px;
            margin-top: 45px;
        }

        .stat-number {
            color: var(--gold);
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            display: block;
        }

        .stat-label {
            font-size: 12px;
            color: #E0E8E3;
        }

        /* FEATURE STRIP */

        .feature-strip {
            border-top: 1px solid rgba(217,181,109,0.35);
            border-bottom: 1px solid rgba(217,181,109,0.35);
            padding: 25px 0;
            background: #0E3028;
        }

        .feature-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 13px;
            padding: 10px;
        }

        .feature-item i {
            color: var(--gold);
            font-size: 23px;
        }

        .feature-item span {
            font-size: 13px;
            font-weight: 600;
        }

        /* SERVICES */

        .services-section {
            background: var(--cream);
            color: var(--text);
            padding: 95px 0;
        }

        .section-eyebrow {
            color: #9B7738;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 4vw, 46px);
            margin: 14px 0;
        }

        .section-description {
            color: #68766E;
            font-size: 14px;
            line-height: 1.9;
            max-width: 570px;
            margin: 0 auto;
        }

        .service-card {
            background: var(--white);
            border: 1px solid #E8E4D9;
            height: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(18,60,50,0.12);
        }

        .service-image {
            height: 210px;
            width: 100%;
            object-fit: cover;
        }

        .service-content {
            padding: 23px;
        }

        .service-content h5 {
            font-family: 'Playfair Display', serif;
            font-size: 21px;
        }

        .service-content p {
            font-size: 13px;
            line-height: 1.8;
            color: #718078;
        }

        .service-price {
            color: #997334;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 17px;
        }

        .btn-service {
            display: inline-block;
            background: var(--forest);
            color: var(--white);
            padding: 10px 18px;
            border-radius: 3px;
            font-size: 12px;
            transition: 0.3s;
        }

        .btn-service:hover {
            background: var(--gold);
            color: var(--forest);
        }

        /* ABOUT SECTION */

        .about-section {
            padding: 95px 0;
            background: var(--forest);
        }

        .about-image {
            width: 100%;
            height: 430px;
            object-fit: cover;
            border-radius: 4px;
        }

        .about-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(34px, 4vw, 47px);
            line-height: 1.25;
            margin: 17px 0 22px;
        }

        .about-title span {
            color: var(--gold);
            font-style: italic;
        }

        .about-description {
            color: #D8E1DB;
            line-height: 2;
            font-size: 14px;
        }

        .about-point {
            margin-top: 22px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .about-point i {
            color: var(--gold);
        }

        /* BOOKING BANNER */

        .booking-section {
            background: var(--cream);
            padding: 70px 0;
        }

        .booking-box {
            background: var(--forest);
            padding: 55px 35px;
            text-align: center;
            border: 1px solid var(--gold);
        }

        .booking-box h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(30px, 4vw, 43px);
            margin: 12px 0;
        }

        .booking-box p {
            color: #D8E1DB;
            font-size: 14px;
            margin-bottom: 25px;
        }

        /* FOOTER */

        .main-footer {
            background: #0B2922;
            padding: 45px 0 20px;
        }

        .footer-brand {
            color: var(--gold);
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            letter-spacing: 2px;
        }

        .footer-text {
            color: #BCCBC3;
            font-size: 13px;
            line-height: 1.9;
            max-width: 350px;
            margin-top: 15px;
        }

        .footer-heading {
            color: var(--gold);
            font-family: 'Playfair Display', serif;
            font-size: 19px;
            margin-bottom: 18px;
        }

        .footer-link {
            color: #D8E1DB;
            display: block;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .footer-link:hover {
            color: var(--gold);
        }

        .footer-bottom {
            border-top: 1px solid rgba(217,181,109,0.2);
            margin-top: 30px;
            padding-top: 20px;
            color: #AABBB1;
            font-size: 12px;
        }

        /* RESPONSIVE */

        @media (max-width: 991px) {
            .hero-section {
                padding: 55px 0;
            }

            .hero-image-frame {
                margin-top: 35px;
            }

            .hero-image {
                height: 430px;
            }

            .navbar-nav {
                padding-top: 20px;
            }

            .navbar-nav .nav-link {
                margin: 5px 0;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 43px;
            }

            .hero-image {
                height: 330px;
            }

            .hero-stats {
                gap: 25px;
            }

            .services-section,
            .about-section {
                padding: 65px 0;
            }

            .service-image {
                height: 220px;
            }

            .booking-box {
                padding: 40px 18px;
            }
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center gap-3"
               href="{{ url('/') }}">

                <span class="brand-mark">
                    <i class="fa-solid fa-scissors"></i>
                </span>

                <span>
                    <span class="brand-name">GOLDEN BLADE</span>
                    <span class="brand-subtitle">HAIR CUTTING CENTER</span>
                </span>

            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-gold"
                           href="#booking">Get Started</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>


    <!-- ================= HERO SECTION ================= -->

    <section class="hero-section">
        <div class="container">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <div class="hero-eyebrow">
                        <i class="fa-solid fa-scissors"></i>
                        The Art of Men's Grooming
                    </div>

                    <h1 class="hero-title">
                        Define Your Style.
                        <br>
                        <span>Own Your Look.</span>
                    </h1>

                    <p class="hero-description">
                        Experience premium men's grooming at Golden Blade.
                        From classic haircuts to perfectly shaped beards,
                        discover a style that feels uniquely yours.
                    </p>

                    <div class="hero-buttons">
                        <a href="#services" class="btn btn-gold">
                            Explore Services
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>

                        <a href="#booking" class="btn btn-outline-light-custom">
                            Book Your Visit
                        </a>
                    </div>

                    <div class="hero-stats">

                        <div>
                            <span class="stat-number">Premium</span>
                            <span class="stat-label">Grooming Experience</span>
                        </div>

                        <div>
                            <span class="stat-number">Expert</span>
                            <span class="stat-label">Barber Services</span>
                        </div>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="hero-image-frame">

                        <img
                            src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=1000&q=85"
                            alt="Professional men's barber shop"
                            class="hero-image"
                        >

                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ================= FEATURES ================= -->

    <section class="feature-strip">
        <div class="container">

            <div class="row">

                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <i class="fa-solid fa-scissors"></i>
                        <span>Expert Barbers</span>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <i class="fa-regular fa-gem"></i>
                        <span>Premium Grooming</span>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Hygienic Environment</span>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <i class="fa-solid fa-spa"></i>
                        <span>Relaxing Atmosphere</span>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ================= SERVICES ================= -->

    <section class="services-section" id="services">
        <div class="container">

            <div class="text-center mb-5">

                <span class="section-eyebrow">What We Offer</span>

                <h2 class="section-title">Our Grooming Services</h2>

                <p class="section-description">
                    Discover professional grooming services designed
                    for the modern gentleman.
                </p>

            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4">
                    <div class="service-card">

                        <img
                            src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=700&q=80"
                            alt="Haircut and styling"
                            class="service-image"
                        >

                        <div class="service-content">
                            <h5>Haircut & Styling</h5>

                            <p>
                                Fresh cuts, modern fades and classic styles
                                tailored to your look.
                            </p>

                            <div class="service-price">Premium Service</div>

                            <a href="#booking" class="btn-service">
                                Book Now <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="service-card">

                        <img
                            src="https://images.unsplash.com/photo-1621605815971-fbc98d665033?auto=format&fit=crop&w=700&q=80"
                            alt="Professional beard grooming"
                            class="service-image"
                        >

                        <div class="service-content">
                            <h5>Beard Styling</h5>

                            <p>
                                Precise beard trimming and shaping for
                                a clean, confident appearance.
                            </p>

                            <div class="service-price">Premium Service</div>

                            <a href="#booking" class="btn-service">
                                Book Now <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="service-card">

                        <img
                            src="https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?auto=format&fit=crop&w=700&q=80"
                            alt="Men's facial grooming"
                            class="service-image"
                        >

                        <div class="service-content">
                            <h5>Facial Grooming</h5>

                            <p>
                                Refresh your look with a relaxing
                                grooming and skincare experience.
                            </p>

                            <div class="service-price">Premium Service</div>

                            <a href="#booking" class="btn-service">
                                Book Now <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ================= ABOUT ================= -->

    <section class="about-section" id="about">
        <div class="container">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <img
                        src="https://images.unsplash.com/photo-1512690459411-b9245aed614b?auto=format&fit=crop&w=1000&q=85"
                        alt="Premium barbershop interior"
                        class="about-image"
                    >

                </div>

                <div class="col-lg-6">

                    <span class="section-eyebrow">
                        The Golden Blade Experience
                    </span>

                    <h2 class="about-title">
                        More Than a Haircut.
                        <br>
                        <span>It's Your Identity.</span>
                    </h2>

                    <p class="about-description">
                        At Golden Blade Hair Cutting Center, grooming
                        is more than a routine. It's an experience built
                        around personal style, professional care and
                        attention to every detail.
                    </p>

                    <div class="about-point">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Professional barber services</span>
                    </div>

                    <div class="about-point">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Personalized grooming experience</span>
                    </div>

                    <div class="about-point">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Comfortable and welcoming atmosphere</span>
                    </div>

                    <a href="#booking" class="btn btn-gold mt-4">
                        Experience Golden Blade
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>

                </div>

            </div>

        </div>
    </section>


    <!-- ================= BOOKING BANNER ================= -->

    <section class="booking-section" id="booking">
        <div class="container">

            <div class="booking-box">

                <span class="section-eyebrow">
                    Your Style Starts Here
                </span>

                <h2>Ready for Your Next Look?</h2>

                <p>
                    Discover your style with professional grooming
                    at Golden Blade Hair Cutting Center.
                </p>

                <a href="{{ route('login') }}" class="btn btn-gold">
                    Get Started
                    <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>

            </div>

        </div>
    </section>


    <!-- ================= FOOTER ================= -->

    <footer class="main-footer" id="contact">
        <div class="container">

            <div class="row g-4">

                <div class="col-lg-5">

                    <a href="{{ url('/') }}" class="footer-brand">
                        GOLDEN BLADE
                    </a>

                    <p class="footer-text">
                        Professional men's grooming with a focus on
                        style, confidence and quality.
                        Your style, our priority.
                    </p>

                </div>

                <div class="col-6 col-lg-3">

                    <h5 class="footer-heading">Quick Links</h5>

                    <a href="{{ url('/') }}" class="footer-link">Dashboard</a>
                    <a href="#services" class="footer-link">Services</a>
                    <a href="#about" class="footer-link">About Us</a>
                    <a href="#booking" class="footer-link">Book Your Visit</a>

                </div>

                <div class="col-6 col-lg-4">

                    <h5 class="footer-heading">Visit Golden Blade</h5>

                    <p class="footer-text">
                        <i class="fa-solid fa-scissors me-2"></i>
                        Men's Hair Cutting & Grooming
                    </p>

                    <a href="#booking" class="footer-link">
                        <i class="fa-regular fa-calendar-check me-2"></i>
                        Appointment Booking
                    </a>

                    <a href="{{ route('login') }}" class="footer-link">
                        <i class="fa-regular fa-user me-2"></i>
                        Customer Login
                    </a>

                </div>

            </div>

            <div class="footer-bottom text-center">
                &copy; {{ date('Y') }} Golden Blade Hair Cutting Center.
                All rights reserved.
            </div>

        </div>
    </footer>


    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
