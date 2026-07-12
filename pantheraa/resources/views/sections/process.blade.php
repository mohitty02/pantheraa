@php $process = config('site.process'); @endphp

<section id="process" class="section">
    <div class="container-px">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-4" data-reveal>
                <span class="kicker">How we work</span>
                <h2 class="mt-5 text-3xl sm:text-4xl lg:text-5xl">
                    A predictable path to <span class="text-gradient-flame">growth.</span>
                </h2>
                <p class="mt-4 text-ink-500">
                    No black boxes. A clear, four-step system that turns strategy into momentum —
                    and momentum into compounding results.
                </p>
                <a href="/contact" wire:navigate class="btn-ghost mt-8">
                    Start with a free audit
                    <x-icon name="arrow" class="h-4 w-4" />
                </a>
            </div>

            <div class="lg:col-span-8">
                <div class="grid gap-5 sm:grid-cols-2" data-stagger>
                    @foreach($process as $step)
                        <div class="card">
                            <div class="font-display text-5xl font-bold text-ink-200">{{ $step['no'] }}</div>
                            <h3 class="mt-3 text-xl">{{ $step['title'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
