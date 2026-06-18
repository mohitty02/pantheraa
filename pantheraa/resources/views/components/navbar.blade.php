@php
    $services = config('site.services');
    $links = [
        ['label' => 'AI',        'href' => '/#ai'],
        ['label' => 'Learnings', 'href' => '/learnings'],
        ['label' => 'About',     'href' => '/about'],
        ['label' => 'Work',      'href' => '/#work'],
        ['label' => 'FAQ',       'href' => '/#faq'],
    ];
@endphp

<header
    x-data="{ scrolled: false, open: false, sub: false }"
    x-init="scrolled = window.scrollY > 20"
    @scroll.window="scrolled = window.scrollY > 20"
    @keydown.escape.window="open = false"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
    :class="scrolled ? 'border-b border-white/10 bg-ink-950/80 backdrop-blur-xl' : 'border-b border-transparent'"
>
    <nav class="container-px flex h-18 items-center justify-between py-3.5" aria-label="Primary">
        <x-brand />

        {{-- Desktop links --}}
        <div class="hidden items-center gap-1 lg:flex">
            {{-- Services mega dropdown --}}
            <div class="relative" x-data="{ d: false }" @mouseenter="d = true" @mouseleave="d = false">
                <a href="/services" wire:navigate
                   class="flex items-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition-colors hover:bg-white/5"
                   :class="d ? 'text-white' : 'text-white/70'">
                    Services
                    <svg class="h-3.5 w-3.5 transition-transform duration-300" :class="d ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </a>

                <div x-show="d" x-cloak x-transition.opacity.duration.150ms
                     class="absolute left-0 top-full z-50 w-[42rem] pt-3">
                    <div class="rounded-2xl border border-white/10 bg-ink-900/95 p-3 shadow-2xl shadow-black/40 backdrop-blur-xl">
                        <div class="grid grid-cols-2 gap-1">
                            @foreach($services as $service)
                                <a href="/services/{{ $service['slug'] }}" wire:navigate
                                   class="group/item flex items-start gap-3 rounded-xl p-3 transition-colors hover:bg-white/5">
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-lg border border-white/10 bg-gradient-to-br from-flame-500/20 to-volt-500/20 text-white transition-transform duration-300 group-hover/item:scale-110">
                                        <x-icon :name="$service['icon']" class="h-5 w-5" />
                                    </span>
                                    <span class="min-w-0">
                                        <span class="flex items-center gap-2">
                                            <span class="text-sm font-semibold text-white">{{ $service['name'] }}</span>
                                            @if($service['featured'] ?? false)
                                                <span class="rounded-full bg-gradient-to-r from-flame-500 to-volt-500 px-1.5 py-px text-[9px] font-bold uppercase tracking-wide text-white">New</span>
                                            @endif
                                        </span>
                                        <span class="mt-0.5 block truncate text-xs text-white/45">{{ $service['tagline'] }}</span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                        <a href="/services" wire:navigate
                           class="mt-2 flex items-center justify-center gap-1.5 border-t border-white/10 px-3 pt-3 text-sm font-semibold text-volt-400 transition-colors hover:text-volt-300">
                            View all services
                            <x-icon name="arrow" class="h-4 w-4" />
                        </a>
                    </div>
                </div>
            </div>

            @foreach($links as $link)
                <a href="{{ $link['href'] }}" wire:navigate
                   class="rounded-full px-4 py-2 text-sm font-medium text-white/70 transition-colors hover:bg-white/5 hover:text-white">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="hidden items-center gap-3 lg:flex">
            <a href="{{ config('site.phone_link') ? 'tel:' . config('site.phone_link') : '#' }}"
               class="text-sm font-medium text-white/70 transition-colors hover:text-white">{{ config('site.phone') }}</a>
            <a href="/contact" wire:navigate class="btn-primary" data-magnetic>
                Get a free audit
                <x-icon name="arrow" class="h-4 w-4" />
            </a>
        </div>

        {{-- Mobile toggle --}}
        <button type="button" @click="open = !open"
                class="grid h-11 w-11 place-items-center rounded-xl border border-white/10 bg-white/5 text-white lg:hidden"
                :aria-expanded="open" aria-label="Toggle menu">
            <x-icon name="menu" x-show="!open" />
            <x-icon name="close" x-show="open" x-cloak />
        </button>
    </nav>

    {{-- Mobile menu --}}
    <div x-show="open" x-cloak x-transition.opacity class="lg:hidden">
        <div class="container-px max-h-[80vh] overflow-y-auto border-t border-white/10 bg-ink-950/95 pb-6 pt-2 backdrop-blur-xl">
            <div class="flex flex-col">
                {{-- Services expandable --}}
                <button type="button" @click="sub = !sub"
                        class="flex items-center justify-between border-b border-white/5 py-3.5 text-base font-medium text-white/80"
                        :aria-expanded="sub">
                    Services
                    <span class="grid h-6 w-6 place-items-center rounded-full border border-white/15 text-sm transition-transform duration-300"
                          :class="sub ? 'rotate-45 border-flame-500 text-flame-400' : ''">+</span>
                </button>
                <div x-show="sub" x-collapse x-cloak>
                    <div class="border-b border-white/5 py-2">
                        @foreach($services as $service)
                            <a href="/services/{{ $service['slug'] }}" wire:navigate @click="open = false"
                               class="flex items-center gap-3 py-2.5 pl-2 text-sm text-white/70">
                                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg border border-white/10 bg-gradient-to-br from-flame-500/20 to-volt-500/20 text-white">
                                    <x-icon :name="$service['icon']" class="h-4 w-4" />
                                </span>
                                {{ $service['name'] }}
                            </a>
                        @endforeach
                        <a href="/services" wire:navigate @click="open = false"
                           class="mt-1 flex items-center gap-1.5 py-2 pl-2 text-sm font-semibold text-volt-400">
                            View all services <x-icon name="arrow" class="h-4 w-4" />
                        </a>
                    </div>
                </div>

                @foreach($links as $link)
                    <a href="{{ $link['href'] }}" wire:navigate @click="open = false"
                       class="border-b border-white/5 py-3.5 text-base font-medium text-white/80">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
            <a href="/contact" wire:navigate @click="open = false" class="btn-primary mt-5 w-full">
                Get a free audit
                <x-icon name="arrow" class="h-4 w-4" />
            </a>
        </div>
    </div>
</header>
