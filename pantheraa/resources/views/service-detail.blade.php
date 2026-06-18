@php
    $s   = config('site');
    $org = rtrim($s['url'], '/') . '/#organization';
    $url = url('/services/' . $service['slug']);

    $others = collect($s['services'])->where('slug', '!=', $service['slug'])->take(3);
    $overview = $service['overview'] ?? $service['desc'];

    // ---- Structured data ----
    $breadcrumb = [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => url('/services')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $service['name'], 'item' => $url],
        ],
    ];

    $serviceSchema = [
        '@type'       => 'Service',
        '@id'         => $url . '#service',
        'name'        => $service['name'],
        'serviceType' => $service['short'],
        'description' => $overview,
        'url'         => $url,
        'provider'    => ['@id' => $org],
        'areaServed'  => 'Worldwide',
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name'  => $service['name'] . ' deliverables',
            'itemListElement' => collect($service['deliverables'] ?? [])->map(fn ($d) => [
                '@type'       => 'Offer',
                'itemOffered' => ['@type' => 'Service', 'name' => $d['title'], 'description' => $d['desc']],
            ])->all(),
        ],
    ];

    $pageSchema = [$breadcrumb, $serviceSchema];

    if (! empty($service['faqs'])) {
        $pageSchema[] = [
            '@type'      => 'FAQPage',
            '@id'        => $url . '#faq',
            'mainEntity' => collect($service['faqs'])->map(fn ($f) => [
                '@type'          => 'Question',
                'name'           => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ])->all(),
        ];
    }
@endphp

<x-app-layout
    :title="($service['meta_title'] ?? null) ?: $service['name']"
    :description="($service['meta_description'] ?? null) ?: $overview"
    :canonical="url('/services/' . $service['slug'])"
    :canonical="$url"
    :schema="$pageSchema"
>
    {{-- Header --}}
    <section class="relative overflow-hidden pb-12 pt-36 sm:pt-44">
        <div class="grid-bg absolute inset-0"></div>
        <div class="orb -left-20 top-10 h-80 w-80 bg-flame-600/20" data-parallax="0.06"></div>
        <div class="orb -right-24 top-24 h-80 w-80 bg-volt-600/20" data-parallax="0.1"></div>

        <div class="container-px relative">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-white/45" aria-label="Breadcrumb" data-hero>
                <a href="/" wire:navigate class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <a href="/services" wire:navigate class="transition-colors hover:text-white">Services</a>
                <span>/</span>
                <span class="text-white/80">{{ $service['name'] }}</span>
            </nav>

            <div class="mt-8 grid items-center gap-12 lg:grid-cols-12">
                <div class="lg:col-span-7">
                    <div class="flex items-center gap-4" data-hero>
                        <span class="grid h-14 w-14 place-items-center rounded-2xl border border-white/10 bg-gradient-to-br from-flame-500/20 to-volt-500/20 text-white">
                            <x-icon :name="$service['icon']" class="h-7 w-7" />
                        </span>
                        <span class="kicker">{{ $service['short'] }}</span>
                    </div>

                    <h1 class="mt-6 text-4xl font-bold leading-[1.06] sm:text-5xl lg:text-6xl" data-hero>{{ $service['name'] }}</h1>
                    <p class="mt-4 text-xl font-medium text-gradient-flame" data-hero>{{ $service['tagline'] }}</p>
                    <p class="mt-5 max-w-xl text-lg leading-relaxed text-white/65" data-hero>{{ $overview }}</p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row" data-hero>
                        <a href="/contact" wire:navigate class="btn-primary" data-magnetic>
                            Get a free audit
                            <x-icon name="arrow" class="h-4 w-4" />
                        </a>
                        <a href="/services" wire:navigate class="btn-ghost">All services</a>
                    </div>
                </div>

                {{-- Quick highlights --}}
                <div class="lg:col-span-5" data-hero>
                    <div class="card">
                        <h2 class="text-xs font-semibold uppercase tracking-[0.2em] text-steel-400">At a glance</h2>
                        <ul class="mt-5 space-y-3">
                            @foreach($service['points'] as $point)
                                <li class="flex items-start gap-3 text-white/80">
                                    <x-icon name="check" class="mt-0.5 h-5 w-5 shrink-0 text-volt-400" />
                                    {{ $point }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Deliverables --}}
    @if(!empty($service['deliverables']))
        <section class="section pt-4">
            <div class="container-px">
                <div class="max-w-2xl" data-reveal>
                    <span class="kicker">What's included</span>
                    <h2 class="mt-5 text-3xl sm:text-4xl">Everything you get with <span class="text-gradient">{{ $service['short'] }}</span>.</h2>
                </div>
                <div class="mt-12 grid gap-5 sm:grid-cols-2" data-stagger>
                    @foreach($service['deliverables'] as $d)
                        <article class="card">
                            <span class="grid h-11 w-11 place-items-center rounded-xl border border-white/10 bg-gradient-to-br from-flame-500/20 to-volt-500/20 text-white">
                                <x-icon :name="$service['icon']" class="h-5 w-5" />
                            </span>
                            <h3 class="mt-5 text-lg">{{ $d['title'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-white/55">{{ $d['desc'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Outcomes --}}
    @if(!empty($service['outcomes']))
        <section class="relative overflow-hidden border-y border-white/10 bg-ink-900/60 py-16">
            <div class="orb left-1/2 top-0 h-60 w-[40rem] -translate-x-1/2 bg-volt-600/10"></div>
            <div class="container-px relative">
                <div class="mx-auto mb-10 max-w-2xl text-center" data-reveal>
                    <span class="kicker">Outcomes</span>
                    <h2 class="mt-5 text-3xl sm:text-4xl">What you can <span class="text-gradient-flame">expect.</span></h2>
                </div>
                <div class="grid gap-5 sm:grid-cols-3" data-stagger>
                    @foreach($service['outcomes'] as $i => $outcome)
                        <div class="card text-center">
                            <div class="font-display text-3xl font-bold text-white/10">0{{ $i + 1 }}</div>
                            <p class="mt-2 text-white/80">{{ $outcome }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Process --}}
    @include('sections.process')

    {{-- Service FAQ --}}
    @if(!empty($service['faqs']))
        <section class="section">
            <div class="container-px">
                <div class="mx-auto max-w-2xl text-center" data-reveal>
                    <span class="kicker">FAQ</span>
                    <h2 class="mt-5 text-3xl sm:text-4xl">{{ $service['short'] }} questions, answered.</h2>
                </div>
                <div class="mx-auto mt-10 max-w-3xl" x-data="{ open: 0 }" data-reveal>
                    <div class="divide-y divide-white/10 rounded-2xl border border-white/10 bg-white/[0.02]">
                        @foreach($service['faqs'] as $i => $faq)
                            <div>
                                <button type="button" @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                                        class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left" :aria-expanded="open === {{ $i }}">
                                    <span class="text-base font-semibold text-white sm:text-lg">{{ $faq['q'] }}</span>
                                    <span class="grid h-7 w-7 shrink-0 place-items-center rounded-full border border-white/15 text-white transition-transform duration-300"
                                          :class="open === {{ $i }} ? 'rotate-45 border-flame-500 text-flame-400' : ''">+</span>
                                </button>
                                <div x-show="open === {{ $i }}" x-collapse x-cloak>
                                    <p class="px-6 pb-6 text-sm leading-relaxed text-white/60">{{ $faq['a'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Related services --}}
    <section class="section pt-0">
        <div class="container-px">
            <div class="flex items-end justify-between" data-reveal>
                <h2 class="text-2xl sm:text-3xl">Explore other services</h2>
                <a href="/services" wire:navigate class="hidden text-sm font-semibold text-volt-400 hover:text-volt-300 sm:inline">View all</a>
            </div>
            <div class="mt-8 grid gap-5 sm:grid-cols-3" data-stagger>
                @foreach($others as $o)
                    <a href="/services/{{ $o['slug'] }}" wire:navigate class="card group">
                        <div class="flex items-center gap-3">
                            <span class="grid h-11 w-11 place-items-center rounded-xl border border-white/10 bg-gradient-to-br from-flame-500/20 to-volt-500/20 text-white transition-transform duration-500 group-hover:scale-110">
                                <x-icon :name="$o['icon']" class="h-5 w-5" />
                            </span>
                            <h3 class="text-base font-semibold text-white">{{ $o['name'] }}</h3>
                        </div>
                        <p class="mt-3 text-sm leading-relaxed text-white/55">{{ $o['desc'] }}</p>
                        <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-volt-400">
                            Learn more <x-icon name="arrow" class="h-4 w-4" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('sections.cta')
</x-app-layout>
