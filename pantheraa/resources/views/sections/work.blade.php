@php $cases = config('site.cases', []); @endphp

{{-- E-E-A-T: real case studies only. No clients yet? Show nothing rather than fiction. --}}
@if(!empty($cases))
<section id="work" class="section">
    <div class="container-px">
        <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end" data-reveal>
            <div class="max-w-xl">
                <span class="kicker">Selected work</span>
                <h2 class="mt-5 text-3xl sm:text-4xl lg:text-5xl">
                    Results we're <span class="text-gradient">proud to hunt down.</span>
                </h2>
            </div>
            <a href="/portfolio" wire:navigate class="btn-ghost shrink-0">
                See the proof
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

                    <div class="mt-6 h-px w-full bg-gradient-to-r from-volt-400/50 via-flame-500/40 to-transparent transition-all duration-500 group-hover:from-volt-400 group-hover:via-flame-500"></div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
