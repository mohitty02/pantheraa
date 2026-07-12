@php
    $s = config('site');
    $cases = config('site.cases', []);

    // Proof screenshots (Search Console / Analytics / Business Profile exports)
    $proofs = collect(glob(public_path('uploads/portfolio/*.jpg')))
        ->map(fn ($p) => 'uploads/portfolio/' . basename($p))
        ->values()->all();

    $breadcrumb = [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Portfolio', 'item' => url('/portfolio')],
        ],
    ];
    $itemList = [
        '@type' => 'ItemList',
        'name'  => 'Client results',
        'itemListElement' => collect($cases)->values()->map(fn ($c, $i) => [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $c['client'] . ' — ' . $c['metric'] . ' ' . $c['kpi'],
        ])->all(),
    ];
@endphp

<x-app-layout
    title="Portfolio — Real Client Results (SEO, GMB & Growth)"
    description="Real, verifiable results from real clients: 16M+ search impressions, #1 rankings in the UAE, and Google Business Profiles turned into lead engines. See the screenshots."
    :schema="[$breadcrumb, $itemList]"
>
    {{-- Header --}}
    <section class="relative overflow-hidden pb-10 pt-36 sm:pt-44">
        <div class="grid-bg absolute inset-0"></div>
        <div class="orb -left-20 top-10 h-80 w-80 bg-flame-600/20"></div>
        <div class="orb -right-20 top-20 h-80 w-80 bg-volt-600/20"></div>
        <div class="container-px relative text-center">
            <span class="kicker" data-hero>Portfolio</span>
            <h1 class="mx-auto mt-6 max-w-4xl text-4xl font-bold leading-[1.05] sm:text-6xl" data-hero>
                Real clients. Real numbers.
                <span class="text-gradient">Receipts included.</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-ink-600" data-hero>
                We don't ask you to take our word for it. Every number below comes straight from the client's
                Google Search Console, Analytics or Business Profile — screenshots and all.
            </p>
        </div>
    </section>

    {{-- Real case studies --}}
    @if(!empty($cases))
        <section class="section pt-8">
            <div class="container-px">
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                    @foreach($cases as $c)
                        <article class="card group flex flex-col">
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-xs font-semibold uppercase tracking-[0.16em] text-steel-600">{{ $c['industry'] }}</span>
                                <div class="flex flex-wrap justify-end gap-1.5">
                                    @foreach(($c['tags'] ?? []) as $tag)
                                        <span class="rounded-full border border-ink-200 px-2.5 py-0.5 text-[10px] font-semibold text-ink-500">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-7 flex items-end gap-2">
                                <span class="font-display text-5xl font-bold text-gradient">{{ $c['metric'] }}</span>
                                <span class="mb-1.5 text-sm text-ink-500">{{ $c['kpi'] }}</span>
                            </div>

                            <h2 class="mt-5 text-lg text-ink-900">{{ $c['client'] }}</h2>
                            <p class="mt-2 flex-1 text-sm leading-relaxed text-ink-600">{{ $c['desc'] ?? '' }}</p>

                            <div class="mt-6 h-px w-full bg-gradient-to-r from-flame-500/40 via-volt-500/40 to-transparent transition-all duration-500 group-hover:from-flame-500 group-hover:via-volt-500"></div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Websites we've built --}}
    @php $websites = config('site.websites', []); @endphp
    @if(!empty($websites))
        <section class="section border-t border-ink-200 pt-16">
            <div class="container-px">
                <div class="mx-auto max-w-2xl text-center" data-reveal>
                    <span class="kicker">Websites we've built</span>
                    <h2 class="mt-5 text-3xl sm:text-4xl">
                        {{ count($websites) }} brands, <span class="text-gradient-flame">live on the web.</span>
                    </h2>
                    <p class="mt-4 text-ink-500">
                        From luxury fragrance houses to dental clinics, longevity labs and manufacturers —
                        every one of these is live. Click through and see for yourself.
                    </p>
                </div>

                <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                    @foreach($websites as $w)
                        <a href="{{ $w['url'] }}" target="_blank" rel="noopener nofollow"
                           class="card group flex flex-col !p-6">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-lg font-semibold text-ink-900 group-hover:text-volt-700">{{ $w['name'] }}</h3>
                                <span class="mt-1 shrink-0 text-ink-400 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5">
                                    <x-icon name="arrow" class="h-4 w-4 -rotate-45" />
                                </span>
                            </div>

                            @if(!empty($w['industry']))
                                <span class="mt-2 w-fit rounded-full border border-ink-200 bg-ink-50 px-2.5 py-0.5 text-[11px] font-semibold text-steel-600">
                                    {{ $w['industry'] }}
                                </span>
                            @endif

                            @if(!empty($w['description']))
                                <p class="mt-3 flex-1 text-sm leading-relaxed text-ink-600">{{ $w['description'] }}</p>
                            @else
                                <div class="flex-1"></div>
                            @endif

                            <span class="mt-4 flex items-center gap-1.5 text-xs font-medium text-ink-400">
                                <x-icon name="code" class="h-3.5 w-3.5" />
                                {{ $w['domain'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Proof gallery --}}
    @if(!empty($proofs))
        <section class="relative overflow-hidden border-y border-ink-200 bg-ink-50 py-16 sm:py-24"
                 x-data="{ open: false, src: '', show(s) { this.src = s; this.open = true } }"
                 @keydown.escape.window="open = false">
            <div class="container-px">
                <div class="mx-auto max-w-2xl text-center" data-reveal>
                    <span class="kicker">The receipts</span>
                    <h2 class="mt-5 text-3xl sm:text-4xl">Straight from the <span class="text-gradient-flame">client dashboards.</span></h2>
                    <p class="mt-4 text-ink-500">
                        {{ count($proofs) }} unedited screenshots — Search Console, Analytics and Google Business Profile.
                        Click any one to view it full size.
                    </p>
                </div>

                <div class="mt-12 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach($proofs as $p)
                        <button type="button" @click="show('{{ asset($p) }}')"
                                class="group relative aspect-[16/10] overflow-hidden rounded-xl border border-ink-200 bg-white transition-all hover:border-ink-400 hover:shadow-lg">
                            <img src="{{ asset($p) }}" alt="Client result screenshot" loading="lazy"
                                 class="h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute inset-0 bg-ink-900/0 transition-colors group-hover:bg-ink-900/5"></span>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Lightbox --}}
            <div x-show="open" x-cloak x-transition.opacity
                 @click="open = false"
                 class="fixed inset-0 z-[60] grid place-items-center bg-ink-900/80 p-4 backdrop-blur-sm">
                <button type="button" @click="open = false"
                        class="absolute right-5 top-5 grid h-10 w-10 place-items-center rounded-full bg-white text-ink-900 shadow-lg"
                        aria-label="Close">
                    <x-icon name="close" class="h-5 w-5" />
                </button>
                <img :src="src" @click.stop alt="Client result screenshot"
                     class="max-h-[88vh] max-w-full rounded-xl border border-white/20 shadow-2xl">
            </div>
        </section>
    @endif

    @include('sections.cta')
</x-app-layout>
