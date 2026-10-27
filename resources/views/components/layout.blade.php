@props([
    'title' => null,
    'description' => null,
    'page' => 'page',
    'palette' => 'trading',
    'image' => null,
])
@php
    $company = config('lifopu.company');
    $contact = config('lifopu.contact');
    $metaTitle = $title ?? __('home.meta_title');
    $metaDescription = $description ?? __('common.meta_description');
    $shareImage = $image ?? asset('images/og-lifopu.jpg');
    $organization = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $company['name'],
        'alternateName' => 'LiFoPu',
        'slogan' => $company['tagline'],
        'foundingDate' => $company['founded'],
        'url' => url('/'),
        'logo' => asset('images/lifopu-logo.png'),
        'email' => $contact['email'],
        'telephone' => $contact['phone_href'],
        'areaServed' => $company['country'],
        'sameAs' => array_values(config('lifopu.social')),
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-quality="enhanced" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
    <meta name="theme-color" content="#0d0c0b">
    <meta name="color-scheme" content="dark light">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon-32.png') }}" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $company['name'] }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $shareImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $shareImage }}">

    {{-- Choose the visual tier before first paint so nothing flashes or shifts. --}}
    <script>
        (function () {
            var d = document.documentElement, saved = null;
            d.classList.remove('no-js'); d.classList.add('js');
            try { saved = localStorage.getItem('lf-quality'); } catch (e) {}
            var reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
            var c = navigator.connection || {};
            var slow = c.saveData || /2g/.test(c.effectiveType || '');
            var weak = (navigator.deviceMemory || 8) < 4 || (navigator.hardwareConcurrency || 8) < 4 || c.effectiveType === '3g';
            var small = matchMedia('(max-width: 767px)').matches;
            var auto = reduce || slow ? 'essential' : (weak || small ? 'enhanced' : 'cinematic');
            d.dataset.quality = saved || auto;
            d.dataset.qualityAuto = auto;
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script type="application/ld+json">{!! json_encode($organization, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @stack('head')
</head>
<body class="page page--{{ $page }}" data-page="{{ $page }}" data-palette="{{ $palette }}">
    <a class="skip-link" href="#main">{{ __('common.skip') }}</a>
    @include('partials.brand-sprite')
    @include('partials.nav')
    @include('partials.spine')

    <main id="main" tabindex="-1">
        {{ $slot }}
    </main>

    @include('partials.footer')
    @include('partials.palette')
    @include('partials.settings')

    <div class="toast" role="status" aria-live="polite" data-toast>{{ session('status') }}</div>
</body>
</html>
