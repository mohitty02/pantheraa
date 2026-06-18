@php $s = config('site'); @endphp

<section class="relative overflow-hidden pb-16 pt-32 sm:pt-40 lg:pb-24 lg:pt-44">
    {{-- Backdrop --}}
    <div class="grid-bg absolute inset-0"></div>
    <div class="orb -left-24 -top-24 h-[28rem] w-[28rem] bg-flame-600/25" data-parallax="0.08"></div>
    <div class="orb -right-24 top-40 h-[30rem] w-[30rem] bg-volt-600/25" data-parallax="0.12"></div>
    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-40 bg-gradient-to-b from-transparent to-ink-950"></div>

    <div class="container-px relative">
        <div class="grid items-center gap-14 lg:grid-cols-12">
            {{-- Copy --}}
            <div class="lg:col-span-7">
                <span class="kicker" data-hero>
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-flame-500"></span>
                    Digital Panther · Growth Agency
                </span>

                <h1 class="mt-6 text-4xl font-bold leading-[1.04] sm:text-6xl lg:text-7xl" data-hero>
                    We hunt
                    <span class="text-gradient">measurable growth</span>
                    for ambitious brands.
                </h1>

                <p class="mt-6 max-w-xl text-lg leading-relaxed text-white/65" data-hero>
                    {{ $s['name'] }} engineers SEO, AI-search (AEO &amp; GEO), ASO and paid media —
                    and builds the <span class="font-semibold text-white">AI chatbots &amp; agents</span>
                    that run your growth on autopilot. Measured in revenue, not vanity clicks.
                </p>

                <div class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center" data-hero>
                    <a href="/contact" wire:navigate class="btn-primary" data-magnetic>
                        Get a free growth audit
                        <x-icon name="arrow" class="h-4 w-4" />
                    </a>
                    <a href="/services" wire:navigate class="btn-ghost">
                        Explore services
                    </a>
                </div>

                <div class="mt-10 flex flex-wrap items-center gap-x-8 gap-y-4 text-sm text-white/50" data-hero>
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <span class="h-7 w-7 rounded-full border-2 border-ink-950 bg-flame-500"></span>
                            <span class="h-7 w-7 rounded-full border-2 border-ink-950 bg-volt-500"></span>
                            <span class="h-7 w-7 rounded-full border-2 border-ink-950 bg-steel-400"></span>
                        </div>
                        <span><span class="font-semibold text-white">65+ brands</span> scaled</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-flame-400">★★★★★</span>
                        <span><span class="font-semibold text-white">4.9/5</span> avg rating</span>
                    </div>
                </div>
            </div>

            {{-- Visual --}}
            <div class="lg:col-span-5" data-hero>
                <div class="relative mx-auto max-w-md">
                    {{-- glow rings --}}
                    <div class="absolute inset-0 -z-10 animate-pulse rounded-3xl bg-gradient-to-br from-flame-600/20 to-volt-600/20 blur-2xl"></div>

                    <div class="card overflow-hidden p-8">
                        {{-- Big dual-eye mark --}}
                        <div class="relative mx-auto grid h-40 w-40 place-items-center">
                            <span class="absolute inset-0 rounded-full border border-white/10"></span>
                            <span class="absolute inset-4 rounded-full border border-white/10"></span>
                            <span class="absolute inset-8 rounded-full border border-flame-500/30"></span>
                            <x-panther class="h-24 w-24 text-white" />
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <div class="rounded-xl border border-white/10 bg-ink-950/50 p-4">
                                <div class="font-display text-3xl font-bold text-white"><span data-counter="4.8">4.8</span>x</div>
                                <div class="mt-1 text-xs text-white/50">Average ROAS</div>
                            </div>
                            <div class="rounded-xl border border-white/10 bg-ink-950/50 p-4">
                                <div class="font-display text-3xl font-bold text-white"><span data-counter="320">320</span>+</div>
                                <div class="mt-1 text-xs text-white/50">Campaigns</div>
                            </div>
                        </div>

                        <div class="mt-3 flex items-center gap-3 rounded-xl border border-volt-500/20 bg-volt-500/10 p-4">
                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-volt-500/20 text-volt-300">
                                <x-icon name="spark" class="h-5 w-5" />
                            </span>
                            <p class="text-xs leading-snug text-white/70">
                                <span class="font-semibold text-white">Now optimizing</span> for AI Overviews &amp; ChatGPT citations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
