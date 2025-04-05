@php
    $applicationName = filament()->getApplicationName();
@endphp

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    class="antialiased filament js-focus-visible"
>
    <head>
        {{ \Filament\Support\Facades\FilamentView::renderHook('head.start') }}

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @foreach (\Filament\Support\Facades\FilamentAsset::getStyles() as $style)
            <link rel="stylesheet" href="{{ $style }}" />
        @endforeach

        <!-- Font Awesome 6 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        {{ filament()->getTheme()->getHtml() }}
        {{ filament()->getFontHtml() }}

        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        {{ \Filament\Support\Facades\FilamentView::renderHook('head.end') }}
    </head>

    <body class="fi-body min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white">
        {{ \Filament\Support\Facades\FilamentView::renderHook('body.start') }}

        {{ $slot }}

        @foreach (\Filament\Support\Facades\FilamentAsset::getScripts() as $script)
            <script src="{{ $script }}"></script>
        @endforeach

        @stack('scripts')

        {{ \Filament\Support\Facades\FilamentView::renderHook('body.end') }}
    </body>
</html> 