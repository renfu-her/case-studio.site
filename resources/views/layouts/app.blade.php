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

    <!-- Bootstrap JavaScript: Bundle with Popper -->
    <script src="{{ asset('assets/libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libraries/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html> 