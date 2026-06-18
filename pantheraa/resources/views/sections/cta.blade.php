<section class="section">
    <div class="container-px">
        <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-ink-900 px-6 py-16 text-center sm:px-12 sm:py-20" data-reveal>
            <div class="grid-bg absolute inset-0 opacity-60"></div>
            <div class="orb -left-10 -top-10 h-64 w-64 bg-flame-600/30"></div>
            <div class="orb -bottom-10 -right-10 h-64 w-64 bg-volt-600/30"></div>

            <div class="relative mx-auto max-w-2xl">
                <h2 class="text-3xl font-bold sm:text-5xl">
                    Ready to let the <span class="text-gradient">panther hunt</span> your growth?
                </h2>
                <p class="mx-auto mt-5 max-w-xl text-lg text-white/65">
                    Get a free growth audit. We'll show you exactly where the fastest revenue is hiding —
                    no obligation, no fluff.
                </p>
                <div class="mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <a href="/contact" wire:navigate class="btn-primary" data-magnetic>
                        Get my free audit
                        <x-icon name="arrow" class="h-4 w-4" />
                    </a>
                    <a href="mailto:{{ config('site.email') }}" class="btn-ghost">
                        <x-icon name="mail" class="h-4 w-4" />
                        {{ config('site.email') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
