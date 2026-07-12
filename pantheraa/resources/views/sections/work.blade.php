@php
    $cases = config('site.cases', [
        ['client' => 'FinFlow SaaS',    'industry' => 'B2B SaaS',     'metric' => '+312%', 'kpi' => 'organic demos', 'desc' => 'Topic-cluster SEO + AEO turned organic search into the #1 demo source in two quarters.', 'tags' => ['SEO', 'AEO']],
        ['client' => 'Lumen Skincare',  'industry' => 'D2C Beauty',   'metric' => '5.3x',  'kpi' => 'blended ROAS', 'desc' => 'Creative-led Meta & Google scaling lifted ROAS from 1.9x to 5.3x at 4x the spend.', 'tags' => ['Paid Media', 'Social']],
        ['client' => 'Vault Commerce',  'industry' => 'Marketplace',  'metric' => '#1',    'kpi' => 'in AI answers', 'desc' => 'GEO + schema work earned consistent citations inside ChatGPT and Google AI Overviews.', 'tags' => ['GEO', 'Web']],
    ]);
@endphp

<section id="work" class="section">
    <div class="container-px">
        <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end" data-reveal>
            <div class="max-w-xl">
                <span class="kicker">Selected work</span>
                <h2 class="mt-5 text-3xl sm:text-4xl lg:text-5xl">
                    Results we're <span class="text-gradient">proud to hunt down.</span>
                </h2>
            </div>
            <a href="/contact" wire:navigate class="btn-ghost shrink-0">
                Become our next case study
                <x-icon name="arrow" class="h-4 w-4" />
            </a>
        </div>

        <div class="mt-14 grid gap-5 lg:grid-cols-3" data-stagger>
            @foreach($cases as $case)
                <article class="card group flex flex-col">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-steel-600">{{ $case['industry'] }}</span>
                        <div class="flex gap-1.5">
                            @foreach($case['tags'] as $tag)
                                <span class="rounded-full border border-ink-200 px-2.5 py-0.5 text-[10px] font-semibold text-ink-500">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 flex items-end gap-2">
                        <span class="font-display text-5xl font-bold text-gradient">{{ $case['metric'] }}</span>
                        <span class="mb-1.5 text-sm text-ink-500">{{ $case['kpi'] }}</span>
                    </div>

                    <h3 class="mt-6 text-lg">{{ $case['client'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $case['desc'] }}</p>

                    <div class="mt-6 h-px w-full bg-gradient-to-r from-flame-500/40 via-volt-500/40 to-transparent transition-all duration-500 group-hover:from-flame-500 group-hover:via-volt-500"></div>
                </article>
            @endforeach
        </div>
    </div>
</section>
