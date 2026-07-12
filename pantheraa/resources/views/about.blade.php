@php
    $s = config('site');
    $breadcrumb = [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'About', 'item' => url('/about')],
        ],
    ];

    $values = [
        ['icon' => 'gauge',  'title' => 'Revenue over vanity', 'desc' => 'We optimize for pipeline, ROAS and revenue — never likes that don\'t pay rent.'],
        ['icon' => 'spark',  'title' => 'Built for AI search', 'desc' => 'We were early to AEO & GEO, so your brand gets cited where buyers now ask: AI.'],
        ['icon' => 'shield', 'title' => 'Radical transparency', 'desc' => 'Live dashboards and honest reporting. You always know what we did and why.'],
        ['icon' => 'bolt',   'title' => 'Speed as a habit',     'desc' => 'Weekly momentum, fast experiments, and compounding wins — not quarterly stalls.'],
    ];
@endphp

<x-app-layout
    title="About Pantheraa Space — A Performance Digital Marketing Agency"
    description="Pantheraa Space is a performance-driven digital marketing agency. Meet the Digital Panther: a team obsessed with SEO, AI-search, ASO and paid growth that compounds."
    :schema="[$breadcrumb]"
>
    <section class="relative overflow-hidden pb-10 pt-36 sm:pt-44">
        <div class="grid-bg absolute inset-0"></div>
        <div class="orb -left-20 top-10 h-80 w-80 bg-volt-600/20"></div>
        <div class="orb right-0 top-24 h-80 w-80 bg-flame-600/20"></div>
        <div class="container-px relative">
            <div class="max-w-3xl">
                <span class="kicker" data-hero>About us</span>
                <h1 class="mt-6 text-4xl font-bold leading-[1.05] sm:text-6xl" data-hero>
                    We're the <span class="text-gradient">Digital Panther</span> behind your growth.
                </h1>
                <p class="mt-6 max-w-2xl text-lg text-ink-600" data-hero>
                    {{ $s['name'] }} is a performance-first digital marketing agency founded in {{ $s['founded'] }}.
                    Like our namesake, we move with patience and precision — studying the terrain, then
                    striking where growth is fastest. SEO, AEO, GEO, ASO, paid media and conversion,
                    engineered as one relentless system.
                </p>
            </div>
        </div>
    </section>

    @include('sections.stats')

    {{-- Values --}}
    <section class="section">
        <div class="container-px">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <span class="kicker">What we stand for</span>
                <h2 class="mt-5 text-3xl sm:text-4xl lg:text-5xl">Principles that <span class="text-gradient-flame">drive results.</span></h2>
            </div>
            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                @foreach($values as $v)
                    <div class="card">
                        <span class="grid h-12 w-12 place-items-center rounded-xl border border-ink-200 bg-gradient-to-br from-volt-400/35 to-flame-500/25 text-ink-900">
                            <x-icon :name="$v['icon']" class="h-6 w-6" />
                        </span>
                        <h3 class="mt-5 text-lg">{{ $v['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $v['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('sections.testimonials')
    @include('sections.cta')
</x-app-layout>
