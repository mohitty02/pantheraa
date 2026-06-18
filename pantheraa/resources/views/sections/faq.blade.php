@php $faqs = config('site.faqs'); @endphp

<section id="faq" class="section">
    <div class="container-px">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-4" data-reveal>
                <span class="kicker">Answers</span>
                <h2 class="mt-5 text-3xl sm:text-4xl lg:text-5xl">
                    Frequently asked <span class="text-gradient">questions.</span>
                </h2>
                <p class="mt-4 text-white/60">
                    Still curious? <a href="/contact" wire:navigate class="font-semibold text-volt-400 hover:text-volt-300">Talk to a strategist</a>
                    and get a free, no-pressure growth audit.
                </p>
            </div>

            <div class="lg:col-span-8" x-data="{ open: 0 }">
                <div class="divide-y divide-white/10 rounded-2xl border border-white/10 bg-white/[0.02]" data-reveal>
                    @foreach($faqs as $i => $faq)
                        <div>
                            <button type="button" @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                                    class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left"
                                    :aria-expanded="open === {{ $i }}">
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
    </div>
</section>
