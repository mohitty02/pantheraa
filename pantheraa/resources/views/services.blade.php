@php
    $s   = config('site');
    $org = rtrim($s['url'], '/') . '/#organization';

    $breadcrumb = [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => url('/services')],
        ],
    ];

    $serviceNodes = collect($s['services'])->map(fn ($svc) => [
        '@type'       => 'Service',
        'name'        => $svc['name'],
        'serviceType' => $svc['short'],
        'description' => $svc['desc'],
        'provider'    => ['@id' => $org],
        'areaServed'  => 'Worldwide',
    ])->all();

    $pageSchema = array_merge([$breadcrumb], $serviceNodes);
@endphp

<x-app-layout
    title="Digital Marketing Services — SEO, AEO, GEO, ASO & Paid Media"
    description="Explore Pantheraa Space's full-stack digital marketing services: SEO, AI-search (AEO & GEO), App Store Optimization, performance marketing, social and web design."
    :schema="$pageSchema"
>
    {{-- Page header --}}
    <section class="relative overflow-hidden pb-10 pt-36 sm:pt-44">
        <div class="grid-bg absolute inset-0"></div>
        <div class="orb -left-20 top-10 h-80 w-80 bg-flame-600/20"></div>
        <div class="orb -right-20 top-20 h-80 w-80 bg-volt-600/20"></div>
        <div class="container-px relative text-center">
            <span class="kicker" data-hero>Services</span>
            <h1 class="mx-auto mt-6 max-w-4xl text-4xl font-bold leading-[1.05] sm:text-6xl" data-hero>
                Full-stack growth, <span class="text-gradient">under one roof.</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-white/65" data-hero>
                From classic search to AI answer engines and app stores — we build the channels that
                turn attention into revenue, and we make them work together.
            </p>
        </div>
    </section>

    @include('sections.services')
    @include('sections.ai')
    @include('sections.process')
    @include('sections.faq')
    @include('sections.cta')
</x-app-layout>
