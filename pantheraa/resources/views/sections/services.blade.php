@php $services = config('site.services'); @endphp

<section id="services" class="section">
    <div class="container-px">
        <div class="mx-auto max-w-2xl text-center" data-reveal>
            <span class="kicker">What we do</span>
            <h2 class="mt-5 text-3xl sm:text-4xl lg:text-5xl">
                Everything you need to <span class="text-gradient-flame">grow online.</span>
            </h2>
            <p class="mt-4 text-ink-500">
                Website &amp; software development, Google and Meta Ads, SEO, Google Business Profile
                and AI search optimization — under one roof, working together.
            </p>
        </div>

        <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
            @foreach($services as $service)
                @php $featured = $service['featured'] ?? false; @endphp
                <article class="card group {{ $featured ? 'ring-1 ring-flame-500/40 lg:col-span-1' : '' }}" id="card-{{ $service['slug'] }}">
                    @if($featured)
                        <span class="absolute right-5 top-5 rounded-full bg-gradient-to-r from-flame-500 to-volt-500 px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-white">Featured</span>
                    @endif
                    <div class="flex items-center gap-3">
                        <span class="grid h-12 w-12 place-items-center rounded-xl border border-ink-200 bg-gradient-to-br from-flame-500/20 to-volt-500/20 text-ink-900 transition-transform duration-500 group-hover:scale-110">
                            <x-icon :name="$service['icon']" class="h-6 w-6" />
                        </span>
                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-steel-600">{{ $service['short'] }}</span>
                    </div>

                    <h3 class="mt-5 text-xl">{{ $service['name'] }}</h3>
                    <p class="mt-1 text-sm font-medium text-flame-600">{{ $service['tagline'] }}</p>
                    <p class="mt-3 text-sm leading-relaxed text-ink-500">{{ $service['desc'] }}</p>

                    <ul class="mt-5 space-y-2">
                        @foreach($service['points'] as $point)
                            <li class="flex items-start gap-2 text-sm text-ink-600">
                                <x-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-volt-600" />
                                {{ $point }}
                            </li>
                        @endforeach
                    </ul>

                    <span class="mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-volt-600">
                        Learn more <x-icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-1" />
                    </span>

                    {{-- full-card link to the detail page --}}
                    <a href="/services/{{ $service['slug'] }}" wire:navigate class="absolute inset-0 rounded-2xl"
                       aria-label="Learn more about {{ $service['name'] }}"></a>
                </article>
            @endforeach
        </div>
    </div>
</section>
