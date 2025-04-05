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
                <a href="{{ url('/') }}">
                    @if($logo = \App\Models\Setting::get('site_logo'))
                        <img src="{{ Storage::url($logo) }}" height="40" alt="{{ \App\Models\Setting::get('site_title', '網站標題') }}">
                    @endif
                </a>

                <div class="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check2" viewbox="0 0 16 16">
                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
                        </symbol>
                        <symbol id="circle-half" viewbox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
                        </symbol>
                        <symbol id="moon-stars-fill" viewbox="0 0 16 16">
                            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
                            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
                        </symbol>
                        <symbol id="sun-fill" viewbox="0 0 16 16">
                            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
                        </symbol>
                    </svg>

                    <button class="btn btn-primary text-white btn-sm rounded dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                        <svg fill="currentColor" class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
                        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-hover end-0 p-1 rounded-3 bg-body-tertiary shadow" style="--bs-dropdown-min-width: 9rem;" aria-labelledby="bd-theme-text">
                        <li style="color: var(--bs-tertiary-bg);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="d-inline-block position-absolute top-0 end-0 translate-middle mt-n1" viewbox="0 0 16 16">
                                <path class="carret-dropdown-path" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"></path>
                            </svg>
                        </li>

                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center rounded-1" data-bs-theme-value="light" aria-pressed="false">
                                <svg fill="currentColor" class="bi me-2 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
                                Light
                                <svg fill="currentColor" class="bi ms-auto d-none active-check" width="1em" height="1em"><use href="#check2"></use></svg>
                            </button>
                        </li>

                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center rounded-1 my-1" data-bs-theme-value="dark" aria-pressed="false">
                                <svg fill="currentColor" class="bi me-2 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
                                Dark
                                <svg fill="currentColor" class="bi ms-auto d-none active-check" width="1em" height="1em"><use href="#check2"></use></svg>
                            </button>
                        </li>

                        <li>
                            <button type="button" class="dropdown-item d-flex align-items-center rounded-1 active" data-bs-theme-value="auto" aria-pressed="true">
                                <svg fill="currentColor" class="bi me-2 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
                                Auto
                                <svg fill="currentColor" class="bi ms-auto d-none active-check" width="1em" height="1em"><use href="#check2"></use></svg>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
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