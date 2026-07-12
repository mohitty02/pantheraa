@php
    $services = config('site.services');
    $links = [
        ['label' => 'AI',        'href' => '/#ai'],
        ['label' => 'Learnings', 'href' => '/learnings'],
        ['label' => 'About',     'href' => '/about'],
        ['label' => 'Portfolio', 'href' => '/portfolio'],
        ['label' => 'FAQ',       'href' => '/#faq'],
    ];
@endphp

<header
    x-data="{ scrolled: false, open: false, sub: false }"
    x-init="scrolled = window.scrollY > 20"
    @scroll.window="scrolled = window.scrollY > 20"
    @keydown.escape.window="open = false"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
    :class="scrolled ? 'border-b border-ink-200 bg-white/85 backdrop-blur-xl' : 'border-b border-transparent'"
>
    <nav class="container-px flex h-18 items-center justify-between py-3.5" aria-label="Primary">
        <x-brand />

        {{-- Desktop links --}}
        <div class="hidden items-center gap-1 lg:flex">
            {{-- Services mega dropdown --}}
            <div class="relative" x-data="{ d: false }" @mouseenter="d = true" @mouseleave="d = false">
                <a href="/services" wire:navigate
                   class="flex items-center gap-1.5 rounded-full px-4 py-2 text-sm font-medium transition-colors hover:bg-ink-100"
                   :class="d ? 'text-ink-900' : 'text-ink-600'">
                    Services
                    <svg class="h-3.5 w-3.5 transition-transform duration-300" :class="d ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </a>

                <div x-show="d" x-cloak x-transition.opacity.duration.150ms
                     class="absolute left-0 top-full z-50 w-[42rem] pt-3">
                    <div class="rounded-2xl border border-ink-200 bg-white/95 p-3 shadow-2xl shadow-ink-900/10 backdrop-blur-xl">
                        <div class="grid grid-cols-2 gap-1">
                            @foreach($services as $service)
                                <a href="/services/{{ $service['slug'] }}" wire:navigate
                                   class="group/item flex items-start gap-3 rounded-xl p-3 transition-colors hover:bg-ink-100">
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-lg border border-ink-200 bg-gradient-to-br from-volt-400/35 to-flame-500/25 text-ink-900 transition-transform duration-300 group-hover/item:scale-110">
                                        <x-icon :name="$service['icon']" class="h-5 w-5" />
                                    </span>
                                    <span class="min-w-0">
                                        <span class="flex items-center gap-2">
                                            <span class="text-sm font-semibold text-ink-900">{{ $service['name'] }}</span>
                                            @if($service['featured'] ?? false)
                                                <span class="rounded-full bg-gradient-to-r from-volt-400 to-flame-500 px-1.5 py-px text-[9px] font-bold uppercase tracking-wide text-ink-950">New</span>
                                            @endif
                                        </span>
                                        <span class="mt-0.5 block truncate text-xs text-ink-400">{{ $service['tagline'] }}</span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                        <a href="/services" wire:navigate
                           class="mt-2 flex items-center justify-center gap-1.5 border-t border-ink-200 px-3 pt-3 text-sm font-semibold text-volt-600 transition-colors hover:text-volt-700">
                            View all services
                            <x-icon name="arrow" class="h-4 w-4" />
                        </a>
                    </div>
                </div>
            </div>

            @foreach($links as $link)
                <a href="{{ $link['href'] }}" wire:navigate
                   class="rounded-full px-4 py-2 text-sm font-medium text-ink-600 transition-colors hover:bg-ink-100 hover:text-ink-900">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="hidden items-center gap-3 lg:flex">
            <a href="{{ config('site.phone_link') ? 'tel:' . config('site.phone_link') : '#' }}"
               class="text-sm font-medium text-ink-600 transition-colors hover:text-ink-900">{{ config('site.phone') }}</a>
            <a href="/contact" wire:navigate class="btn-primary" data-magnetic>
                Get a free audit
                <x-icon name="arrow" class="h-4 w-4" />
            </a>
        </div>

        {{-- Mobile toggle --}}
        <button type="button" @click="open = !open"
                class="grid h-11 w-11 place-items-center rounded-xl border border-ink-200 bg-ink-50 text-ink-900 lg:hidden"
                :aria-expanded="open" aria-label="Toggle menu">
            <x-icon name="menu" x-show="!open" />
            <x-icon name="close" x-show="open" x-cloak />
        </button>
    </nav>

    {{-- Mobile menu --}}
    <div x-show="open" x-cloak x-transition.opacity class="lg:hidden">
        <div class="container-px max-h-[80vh] overflow-y-auto border-t border-ink-200 bg-white/95 pb-6 pt-2 backdrop-blur-xl">
            <div class="flex flex-col">
                {{-- Services expandable --}}
                <button type="button" @click="sub = !sub"
                        class="flex items-center justify-between border-b border-ink-100 py-3.5 text-base font-medium text-ink-700"
                        :aria-expanded="sub">
                    Services
                    <span class="grid h-6 w-6 place-items-center rounded-full border border-ink-200 text-sm transition-transform duration-300"
                          :class="sub ? 'rotate-45 border-flame-500 text-flame-600' : ''">+</span>
                </button>
                <div x-show="sub" x-collapse x-cloak>
                    <div class="border-b border-ink-100 py-2">
                        @foreach($services as $service)
                            <a href="/services/{{ $service['slug'] }}" wire:navigate @click="open = false"
                               class="flex items-center gap-3 py-2.5 pl-2 text-sm text-ink-600">
                                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg border border-ink-200 bg-gradient-to-br from-volt-400/35 to-flame-500/25 text-ink-900">
                                    <x-icon :name="$service['icon']" class="h-4 w-4" />
                                </span>
                                {{ $service['name'] }}
                            </a>
                        @endforeach
                        <a href="/services" wire:navigate @click="open = false"
                           class="mt-1 flex items-center gap-1.5 py-2 pl-2 text-sm font-semibold text-volt-600">
                            View all services <x-icon name="arrow" class="h-4 w-4" />
                        </a>
                    </div>
                </div>

                @foreach($links as $link)
                    <a href="{{ $link['href'] }}" wire:navigate @click="open = false"
                       class="border-b border-ink-100 py-3.5 text-base font-medium text-ink-700">
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
