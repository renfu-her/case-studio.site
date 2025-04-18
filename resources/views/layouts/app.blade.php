<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  data-bs-theme="light">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/libraries/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.5.0/github-markdown-light.min.css">

    <style>
        .markdown-body {
            font-family: inherit;
            line-height: 1.8;
            color: #4a5568;
            background-color: transparent !important;
        }
        .markdown-body h1,
        .markdown-body h2,
        .markdown-body h3,
        .markdown-body h4,
        .markdown-body h5,
        .markdown-body h6 {
            margin-top: 1.5em;
            margin-bottom: 1em;
            color: #2d3748;
            border-bottom: none;
        }
        .markdown-body p {
            margin-bottom: 1.25em;
        }
        .markdown-body ul,
        .markdown-body ol {
            margin-bottom: 1.25em;
            padding-left: 1.5em;
        }
        .markdown-body li {
            margin-bottom: 0.5em;
        }
        .markdown-body a {
            color: #EA580C;
            text-decoration: none;
        }
        .markdown-body a:hover {
            text-decoration: underline;
        }
        .markdown-body img {
            max-width: 100%;
            border-radius: 0.5rem;
            margin: 1.5em 0;
        }
        .markdown-body blockquote {
            border-left: 4px solid #EA580C;
            padding-left: 1em;
            margin: 1.5em 0;
            color: #718096;
        }
        .markdown-body code {
            background-color: #f7fafc;
            padding: 0.2em 0.4em;
            border-radius: 0.25rem;
            font-size: 0.875em;
        }
        .markdown-body pre {
            background-color: #f7fafc;
            padding: 1em;
            border-radius: 0.5rem;
            overflow-x: auto;
            margin: 1.5em 0;
        }
        .markdown-body table {
            width: 100%;
            margin: 1.5em 0;
            border-collapse: collapse;
        }
        .markdown-body th,
        .markdown-body td {
            padding: 0.75em;
            border: 1px solid #e2e8f0;
        }
        .markdown-body th {
            background-color: #f7fafc;
            font-weight: 600;
        }
    </style>

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
    <div class="py-4 bg-white">
        <nav class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ url('/') }}" class="navbar-brand">
                    @if(\App\Models\Setting::get('site_logo') != '')
                        <img src="{{ Storage::url(\App\Models\Setting::get('site_logo')) }}" height="40" alt="{{ \App\Models\Setting::get('site_title', '網站標題') }}">
                    @endif
                </a>

                <!-- Desktop Navigation Menu -->
                <div class="d-none d-lg-block">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link text-dark {{ request()->is('/') ? 'nav-active' : '' }}" href="{{ url('/') }}">
                                首頁
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark {{ request()->is('projects*') ? 'nav-active' : '' }}" href="{{ url('/projects') }}">
                                案例
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark {{ request()->is('about*') ? 'nav-active' : '' }}" href="{{ url('/about') }}">
                                關於我們
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark {{ request()->is('contact*') ? 'nav-active' : '' }}" href="{{ url('/contact') }}">
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
                    <a class="nav-link {{ request()->is('/') ? 'nav-active' : '' }} fs-5" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-2"></i>首頁
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link {{ request()->is('projects*') ? 'nav-active' : '' }} fs-5" href="{{ url('/projects') }}">
                        <i class="bi bi-grid me-2"></i>案例
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link {{ request()->is('about*') ? 'nav-active' : '' }} fs-5" href="{{ url('/about') }}">
                        <i class="bi bi-info-circle me-2"></i>關於我們
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link {{ request()->is('contact*') ? 'nav-active' : '' }} fs-5" href="{{ url('/contact') }}">
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
                        @if(\App\Models\Setting::get('site_logo') != '')
                            <img src="{{ Storage::url(\App\Models\Setting::get('site_logo')) }}" height="40" alt="{{ \App\Models\Setting::get('site_title', '網站標題') }}" class="mb-4">
                        @endif
                        <p class="text-white mb-4">
                            {{ \App\Models\Setting::get('meta_description', '') }}
                        </p>
                        <div class="d-flex gap-3">
                            @if(\App\Models\Setting::get('social_facebook') != '')
                                <a href="{{ \App\Models\Setting::get('social_facebook') }}" class="text-white hover-opacity" target="_blank">
                                    <i class="bi bi-facebook fs-5"></i>
                                </a>
                            @endif
                            @if(\App\Models\Setting::get('social_instagram') != '')
                                <a href="{{ \App\Models\Setting::get('social_instagram') }}" class="text-white hover-opacity" target="_blank">
                                    <i class="bi bi-instagram fs-5"></i>
                                </a>
                            @endif
                            @if(\App\Models\Setting::get('social_linkedin') != '')
                                <a href="{{ \App\Models\Setting::get('social_linkedin') }}" class="text-white hover-opacity" target="_blank">
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
                        @if(\App\Models\Setting::get('contact_phone') != '')
                            <li class="nav-item mb-2">
                                <a href="tel:{{ \App\Models\Setting::get('contact_phone') }}" class="nav-link p-0 text-white hover-underline">
                                    <i class="bi bi-telephone me-2"></i>{{ \App\Models\Setting::get('contact_phone') }}
                                </a>
                            </li>
                        @endif
                        @if(\App\Models\Setting::get('contact_email') != '')
                            <li class="nav-item mb-2">
                                <a href="mailto:{{ \App\Models\Setting::get('contact_email') }}" class="nav-link p-0 text-white hover-underline">
                                    <i class="bi bi-envelope me-2"></i>{{ \App\Models\Setting::get('contact_email') }}
                                </a>
                            </li>
                        @endif
                        @if(\App\Models\Setting::get('contact_address') != '')
                            <li class="nav-item mb-2">
                                <span class="nav-link p-0 text-white">
                                    <i class="bi bi-geo-alt me-2"></i>{{ \App\Models\Setting::get('contact_address') }}
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
    .nav-link {
        position: relative;
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
    }
    .nav-link:hover {
        background-color: rgba(234, 88, 12, 0.1) !important;
        color: #EA580C !important;
    }
    .nav-active {
        background-color: #EA580C !important;
        color: white !important;
    }
    .nav-link.active {
        background-color: #EA580C !important;
        color: white !important;
    }
    </style>

    <!-- Bootstrap JavaScript: Bundle with Popper -->
    <script src="{{ asset('assets/libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libraries/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        // 強制使用 light 模式
        document.addEventListener('DOMContentLoaded', function() {
            document.documentElement.setAttribute('data-bs-theme', 'light');
        });
    </script>
</body>
</html> 