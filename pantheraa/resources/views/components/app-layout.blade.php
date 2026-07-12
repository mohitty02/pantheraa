@props([
    'title'       => null,
    'description' => null,
    'canonical'   => null,
    'ogImage'     => null,
    'ogType'      => 'website',
    'articleMeta' => [],
    'schema'      => [],
    'noindex'     => false,
])

@php
    $s      = config('site');
    $seo    = config('site.seo', []);
    $suffix = $seo['title_suffix'] ?? ($s['name'] ?? '');

    $pageTitle = $title
        ? ($suffix && ! \Illuminate\Support\Str::contains($title, $suffix) ? $title . ' | ' . $suffix : $title)
        : trim(($s['name'] ?? '') . ' — ' . ($s['short_desc'] ?? ''));

    $desc  = $description ?: ($seo['default_description'] ?? null) ?: ($s['short_desc'] ?? '');
    $desc  = \Illuminate\Support\Str::limit(trim(strip_tags($desc)), 300, '');
    $url   = $canonical ?: url()->current();
    $image = $ogImage ?: ($seo['default_image'] ?? null) ?: (rtrim($s['url'] ?? url('/'), '/') . '/images/logo.jpeg');
    if ($image && ! \Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])) {
        $image = url($image);
    }
@endphp
<!DOCTYPE html>
<html lang="en" class="no-js scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $desc }}">
    <link rel="canonical" href="{{ $url }}">
    @if($noindex)
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    @endif
    <meta name="theme-color" content="#ffffff">
    <meta name="author" content="{{ $seo['author_name'] ?? $s['name'] }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ $s['name'] }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:url" content="{{ $url }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:alt" content="{{ $s['name'] }}">
    <meta property="og:locale" content="en_US">
    @if($ogType === 'article')
        @isset($articleMeta['published']) <meta property="article:published_time" content="{{ $articleMeta['published'] }}"> @endisset
        @isset($articleMeta['modified']) <meta property="article:modified_time" content="{{ $articleMeta['modified'] }}"> @endisset
        @isset($articleMeta['section']) <meta property="article:section" content="{{ $articleMeta['section'] }}"> @endisset
        @foreach(($articleMeta['tags'] ?? []) as $tag)
            <meta property="article:tag" content="{{ $tag }}">
        @endforeach
    @endif

    {{-- Twitter / X --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $desc }}">
    <meta name="twitter:image" content="{{ $image }}">
    @if(!empty($seo['twitter_site']))
        <meta name="twitter:site" content="{{ $seo['twitter_site'] }}">
        <meta name="twitter:creator" content="{{ $seo['twitter_site'] }}">
    @endif

    {{-- Icons --}}
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/jpeg">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.jpeg') }}">

    {{-- RSS --}}
    <link rel="alternate" type="application/rss+xml" title="{{ $s['name'] }} — Learnings" href="{{ url('/learnings/feed') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    {{-- Structured data --}}
    @include('partials.schema', ['schema' => $schema])

    {{-- Analytics / verification --}}
    {!! \App\Support\Tracking::head() !!}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-white text-ink-600 antialiased selection:bg-flame-500">
    {!! \App\Support\Tracking::bodyOpen() !!}

    {{-- Skip link for a11y --}}
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[60] focus:rounded-lg focus:bg-ink-50 focus:px-4 focus:py-2 focus:text-ink-900">Skip to content</a>

    {{-- Scroll progress --}}
    <div class="fixed inset-x-0 top-0 z-[55] h-0.5 origin-left" id="scroll-progress"
         style="transform: scaleX(0); background-image: linear-gradient(90deg, var(--color-flame-500), var(--color-volt-500));"></div>

    <x-navbar />

    <main id="main">
        {{ $slot }}
    </main>

    <x-footer />

    <x-whatsapp-cta />
    <x-mobile-cta-bar />

    @livewireScripts
</body>
</html>
