<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ \App\Models\Setting::get('site_title', '網站標題') }}</title>
    <meta name="description" content="{{ \App\Models\Setting::get('meta_description', '') }}">
    <meta name="keywords" content="{{ \App\Models\Setting::get('meta_keywords', '') }}">

    <!-- Favicon -->
    @if($favicon = \App\Models\Setting::get('site_favicon'))
        <link rel="icon" type="image/webp" href="{{ Storage::url($favicon) }}">
    @endif

    <!-- Logo -->
    @if($logo = \App\Models\Setting::get('site_logo'))
        <link rel="apple-touch-icon" href="{{ Storage::url($logo) }}">
    @endif

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ \App\Models\Setting::get('site_title', '網站標題') }}">
    <meta property="og:description" content="{{ \App\Models\Setting::get('meta_description', '') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($logo = \App\Models\Setting::get('site_logo'))
        <meta property="og:image" content="{{ Storage::url($logo) }}">
    @endif

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ \App\Models\Setting::get('site_title', '網站標題') }}">
    <meta name="twitter:description" content="{{ \App\Models\Setting::get('meta_description', '') }}">
    @if($logo = \App\Models\Setting::get('site_logo'))
        <meta name="twitter:image" content="{{ Storage::url($logo) }}">
    @endif

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/libraries/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('assets/js/color-modes.js') }}"></script>
</head>
<body>
    <!-- loader-wrapper -->
    <div class="loader-wrapper">
        <div class="spinner-border text-primary p-5" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- header top -->
    <div class="py-4">
        <nav class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ url('/') }}" class="navbar-brand">
                    @if($logo = \App\Models\Setting::get('site_logo'))
                        <img src="{{ Storage::url($logo) }}" height="40" alt="{{ \App\Models\Setting::get('site_title', '網站標題') }}">
                    @endif
                </a>

                <!-- Desktop Navigation Menu -->
                <div class="d-none d-lg-block">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                首頁
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }}" href="{{ url('/projects') }}">
                                案例
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('about*') ? 'active' : '' }}" href="{{ url('/about') }}">
                                關於我們
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ url('/contact') }}">
                                聯絡我們
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Mobile Menu Button -->
                <button class="btn btn-link d-lg-none p-0 text-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                    <i class="bi bi-list fs-1"></i>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fs-4">選單</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item mb-3">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }} fs-5" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-2"></i>首頁
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }} fs-5" href="{{ url('/projects') }}">
                        <i class="bi bi-grid me-2"></i>案例
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link {{ request()->is('about*') ? 'active' : '' }} fs-5" href="{{ url('/about') }}">
                        <i class="bi bi-info-circle me-2"></i>關於我們
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }} fs-5" href="{{ url('/contact') }}">
                        <i class="bi bi-envelope me-2"></i>聯絡我們
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-white py-6 mt-8" style="background-color: #EA580C;">
        <div class="container">
            <div class="row g-4">
                <!-- 公司資訊 -->
                <div class="col-lg-5">
                    <div class="pe-lg-5">
                        @if($logo = \App\Models\Setting::get('site_logo'))
                            <img src="{{ Storage::url($logo) }}" height="40" alt="{{ \App\Models\Setting::get('site_title', '網站標題') }}" class="mb-4">
                        @endif
                        <p class="text-white mb-4">
                            {{ \App\Models\Setting::get('meta_description', '') }}
                        </p>
                        <div class="d-flex gap-3">
                            @if($facebook = \App\Models\Setting::get('social_facebook'))
                                <a href="{{ $facebook }}" class="text-white hover-opacity" target="_blank">
                                    <i class="bi bi-facebook fs-5"></i>
                                </a>
                            @endif
                            @if($instagram = \App\Models\Setting::get('social_instagram'))
                                <a href="{{ $instagram }}" class="text-white hover-opacity" target="_blank">
                                    <i class="bi bi-instagram fs-5"></i>
                                </a>
                            @endif
                            @if($linkedin = \App\Models\Setting::get('social_linkedin'))
                                <a href="{{ $linkedin }}" class="text-white hover-opacity" target="_blank">
                                    <i class="bi bi-linkedin fs-5"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 快速連結 -->
                <div class="col-sm-6 col-lg-3">
                    <h5 class="text-white mb-4">快速連結</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="{{ url('/') }}" class="nav-link p-0 text-white hover-underline">首頁</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ url('/projects') }}" class="nav-link p-0 text-white hover-underline">案例</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ url('/about') }}" class="nav-link p-0 text-white hover-underline">關於我們</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ url('/contact') }}" class="nav-link p-0 text-white hover-underline">聯絡我們</a>
                        </li>
                    </ul>
                </div>

                <!-- 聯絡資訊 -->
                <div class="col-sm-6 col-lg-4">
                    <h5 class="text-white mb-4">聯絡資訊</h5>
                    <ul class="nav flex-column">
                        @if($phone = \App\Models\Setting::get('contact_phone'))
                            <li class="nav-item mb-2">
                                <a href="tel:{{ $phone }}" class="nav-link p-0 text-white-75">
                                    <i class="bi bi-telephone me-2"></i>{{ $phone }}
                                </a>
                            </li>
                        @endif
                        @if($email = \App\Models\Setting::get('contact_email'))
                            <li class="nav-item mb-2">
                                <a href="mailto:{{ $email }}" class="nav-link p-0 text-white-75">
                                    <i class="bi bi-envelope me-2"></i>{{ $email }}
                                </a>
                            </li>
                        @endif
                        @if($address = \App\Models\Setting::get('contact_address'))
                            <li class="nav-item mb-2">
                                <span class="nav-link p-0 text-white-75">
                                    <i class="bi bi-geo-alt me-2"></i>{{ $address }}
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- 版權資訊 -->
            <div class="border-top border-white border-opacity-25 pt-4 mt-5">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="text-white-75 mb-0">
                            © {{ date('Y') }} {{ \App\Models\Setting::get('site_title', '網站標題') }}. All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                        <p class="text-white-75 mb-0">
                            Designed by <a href="#" class="text-white text-decoration-none hover-opacity">Case Studio</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
    .hover-underline {
        position: relative;
        display: inline-block;
    }
    .hover-underline::after {
        content: '';
        position: absolute;
        width: 100%;
        transform: scaleX(0);
        height: 1px;
        bottom: 0;
        left: 0;
        background-color: white;
        transform-origin: bottom right;
        transition: transform 0.3s ease-out;
    }
    .hover-underline:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }
    </style>

    <!-- Bootstrap JavaScript: Bundle with Popper -->
    <script src="{{ asset('assets/libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libraries/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html> 