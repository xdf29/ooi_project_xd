<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stella Maris Home</title>
    <link rel="icon" type="image/x-icon" href="/assets/img/header/logo-transparent.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Styles moved to SCSS: see resources/scss/index.scss -->
    @vite(['resources/scss/index.scss','resources/js/app.js'])
    @yield('style')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="{{ route('home') }}" aria-label="Go to Home">
                    <img src="assets/img/header/logo-transparent.png" alt="Nora Care Logo">
                </a>
            </div>

            <div class="right-menu">
                <!-- language dropdown (inside .navbar .container) -->
                <div class="dropdown language-dropdown">
                    <button class="menu-btn dropdown-toggle" type="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(session('locale', app()->getLocale())) }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'ms') }}">Malay</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'zh_CN') }}">Chinese</a></li>
                    </ul>
                </div>
                <button class="menu-btn" id="menuBtn">{{ __('index.menu') }}</button>
            </div>
        </div>
    </nav>

    <!-- Full Screen Navigation Menu -->
    <section class="header-section" id="headerSection">
        <button class="close-btn" id="closeBtn"><i class="fa-solid fa-xmark"></i></button>
        <ul id="nav">
            <li class="nav-link"><a href="{{ route('home') }}">
                    <h1 data-name="{{ __('index.home') }}">{{ __('index.home') }}</h1>
                </a></li>
            <li class="nav-link"><a href="{{ route('about_us') }}">
                    <h1 data-name="{{ __('index.about_us') }}">{{ __('index.about_us') }}</h1>
                </a></li>
            <li class="nav-link"><a href="{{ route('contact') }}">
                    <h1 data-name="{{ __('index.contact') }}">{{ __('index.contact') }}</h1>
                </a></li>
        </ul>
    </section>

    <!-- Main Content Area -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row align-items-start">
                <!-- Left Column - Big Logo -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="footer-logo">
                        <img src="assets/img/header/logo-transparent.png" alt="Nora Care Logo" class="img-fluid">
                    </div>
                </div>

                <!-- Right Column - Addresses and Menu -->
                <div class="col-md-8">
                    <!-- Top Row - Addresses -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="address-item">
                                <h5 class="location-title">Stella Maris Home - Aged Care</h5>
                                <p class="address-text">
                                    Welcome to Stella Maris Home - Aged Care, where specialised elderly care has been thoughtfully reinvented to provide a fresh, comforting experience.
                                </p>
                            </div>
                        </div>
                        <!-- <div class="col-md-4 mb-3 mb-md-0">
                            <div class="address-item">
                                <h5 class="location-title">Contact Us</h5>
                                <p class="address-text">
                                    011-11891985
                                </p>
                            </div>
                        </div> -->
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="address-item">
                                <h5 class="location-title">Address</h5>
                                <p class="address-text">
                                    2, Jalan 6/18, Seksyen 6, 46000 Petaling Jaya, Selangor
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Row - Menu -->
                    <div class="row">
                        <div class="col-12">
                            <div class="footer-menu">
                                <nav class="footer-nav">
                                    <a href="{{ route('home') }}" class="footer-nav-link">Home</a>
                                    <span class="footer-nav-separator">|</span>
                                    <a href="{{ route('about_us') }}" class="footer-nav-link">About Us</a>
                                    <span class="footer-nav-separator">|</span>
                                    <!-- <a href="#" class="footer-nav-link">Services</a>
                                    <span class="footer-nav-separator">|</span> -->
                                    <!-- <a href="#" class="footer-nav-link">Blog</a>
                                    <span class="footer-nav-separator">|</span> -->
                                    <a href="{{ route('contact') }}" class="footer-nav-link">Contact Us</a>
                                    <!-- <span class="footer-nav-separator">|</span>
                                    <a href="#" class="footer-nav-link">FAQ</a> -->
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="footer-copy">&copy; {{ date('Y') }} SMH Care. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mouse-follow circle -->
    <div id="mouseCircle" class="mouse-circle" aria-hidden="true"
        style="background-image: url('{{ asset("assets/img/home/emoji.png") }}')"></div>

    <!-- WhatsApp floating button -->
    <a
        id="whatsappFloat"
        class="whatsapp-float"
        href="https://wa.me/60162712216?text=Hi%2C%20I%20would%20like%20to%20enquire%20about%20your%20services."
        target="_blank"
        rel="noopener"
        aria-label="Chat on WhatsApp"
        title="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const menuBtn = document.getElementById('menuBtn');
        const closeBtn = document.getElementById('closeBtn');
        const headerSection = document.getElementById('headerSection');

        menuBtn.addEventListener('click', () => {
            headerSection.classList.add('active');
        });

        closeBtn.addEventListener('click', () => {
            headerSection.classList.remove('active');
        });

        // Close menu when clicking nav items
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                headerSection.classList.remove('active');
            });
        });

        // #WhatsApp floating button visibility toggle
        const whatsappFloat = document.getElementById('whatsappFloat');
        const toggleWhatsapp = () => {
            if (!whatsappFloat) return;
            const isMenuActive = headerSection.classList.contains('active');
            whatsappFloat.style.display = isMenuActive ? 'none' : 'inline-flex';
        };
        // tie into existing actions
        menuBtn.addEventListener('click', toggleWhatsapp);
        closeBtn.addEventListener('click', toggleWhatsapp);
        document.querySelectorAll('.nav-link').forEach(link => link.addEventListener('click', toggleWhatsapp));
        // #WhatsApp end

        // #Mouse-follow black circle
        (function() {
            const circle = document.getElementById('mouseCircle');
            if (!circle) return;
            let visible = true;

            const updatePos = (e) => {
                if (!visible) return;
                // offset so emoji sits slightly to the right/below the cursor
                const offsetX = 12;
                const offsetY = 12;
                circle.style.transform = `translate(${e.clientX + offsetX}px, ${e.clientY + offsetY}px)`;
            };

            // Show/hide based on menu active to avoid distraction
            const toggleCircle = () => {
                visible = !headerSection.classList.contains('active');
                circle.style.opacity = visible ? '1' : '0';
            };

            window.addEventListener('mousemove', updatePos, {
                passive: true
            });
            menuBtn.addEventListener('click', toggleCircle);
            closeBtn.addEventListener('click', toggleCircle);
            document.querySelectorAll('.nav-link').forEach(link => link.addEventListener('click', toggleCircle));
        })();
        // #Mouse-follow black circle end
    </script>

    <script>
        // Show navbar only when scrolled to the very top; hide otherwise.
        (function() {
            const navbar = document.querySelector('.navbar');
            if (!navbar) return;

            const updateNavbar = () => {
                const atTop = window.pageYOffset === 0;
                navbar.classList.toggle('navbar--hidden', !atTop);
            };

            // Initialize and listen to scroll
            updateNavbar();
            window.addEventListener('scroll', updateNavbar, {
                passive: true
            });
        })();
    </script>
    @stack('scripts')
</body>

</html>