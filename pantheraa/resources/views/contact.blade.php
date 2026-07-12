@php
    $s = config('site');
    $breadcrumb = [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Contact', 'item' => url('/contact')],
        ],
    ];
    $contactPage = [
        '@type' => 'ContactPage',
        'name'  => 'Contact ' . $s['name'],
        'url'   => url('/contact'),
    ];

    $details = [
        ['icon' => 'mail',  'label' => 'Email us',  'value' => $s['email'], 'href' => 'mailto:' . $s['email']],
        ['icon' => 'phone', 'label' => 'Call us',   'value' => $s['phone'], 'href' => 'tel:' . $s['phone_link']],
        ['icon' => 'pin',   'label' => 'Visit us',  'value' => $s['address']['locality'] . ', ' . $s['address']['region'], 'href' => null],
    ];
@endphp

<x-app-layout
    title="Contact — Get a Free Growth Audit"
    description="Tell us your goals and get a free digital marketing growth audit from Pantheraa Space within one business day."
    :schema="[$breadcrumb, $contactPage]"
>
    <section class="relative overflow-hidden pb-10 pt-36 sm:pt-44">
        <div class="grid-bg absolute inset-0"></div>
        <div class="orb -left-20 top-10 h-80 w-80 bg-flame-600/20"></div>
        <div class="orb -right-20 top-20 h-80 w-80 bg-volt-600/20"></div>
        <div class="container-px relative text-center">
            <span class="kicker" data-hero>Let's talk</span>
            <h1 class="mx-auto mt-6 max-w-3xl text-4xl font-bold leading-[1.05] sm:text-6xl" data-hero>
                Get your <span class="text-gradient">free growth audit.</span>
            </h1>
            <p class="mx-auto mt-6 max-w-xl text-lg text-ink-600" data-hero>
                Share your goals and current channels. We'll reply within one business day with
                quick wins and a recommended roadmap — no obligation.
            </p>
        </div>
    </section>

    <section class="pb-24">
        <div class="container-px">
            <div class="grid gap-8 lg:grid-cols-12">
                {{-- Form --}}
                <div class="lg:col-span-7" data-reveal>
                    <livewire:contact-form />
                </div>

                {{-- Details --}}
                <div class="lg:col-span-5" data-reveal data-delay="0.1">
                    <div class="space-y-4">
                        @foreach($details as $d)
                            <div class="card flex items-center gap-4">
                                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl border border-ink-200 bg-gradient-to-br from-volt-400/35 to-flame-500/25 text-ink-900">
                                    <x-icon :name="$d['icon']" class="h-6 w-6" />
                                </span>
                                <div>
                                    <div class="text-xs font-semibold uppercase tracking-[0.18em] text-steel-600">{{ $d['label'] }}</div>
                                    @if($d['href'])
                                        <a href="{{ $d['href'] }}" class="text-ink-900 transition-colors hover:text-volt-600">{{ $d['value'] }}</a>
                                    @else
                                        <span class="text-ink-900">{{ $d['value'] }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <div class="card">
                            <div class="text-xs font-semibold uppercase tracking-[0.18em] text-steel-600">Office hours</div>
                            <p class="mt-2 text-ink-600">Monday – Saturday<br>10:00 – 19:00 IST</p>
                            <div class="hairline my-5"></div>
                            <div class="flex items-center gap-2">
                                @foreach(['linkedin','instagram','x','youtube'] as $key)
                                    <a href="{{ $s['social'][$key] }}" target="_blank" rel="noopener noreferrer"
                                       class="grid h-9 w-9 place-items-center rounded-lg border border-ink-200 bg-ink-50 text-ink-600 transition-colors hover:border-ink-400 hover:text-ink-900"
                                       aria-label="{{ ucfirst($key) }}">
                                        <x-icon :name="$key" class="h-5 w-5" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
