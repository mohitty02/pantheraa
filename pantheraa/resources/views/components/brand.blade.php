@props(['showTagline' => false, 'size' => 'md'])

@php
    $mark = $size === 'lg' ? 'h-12 w-12' : 'h-10 w-10';
    $text = $size === 'lg' ? 'text-2xl' : 'text-lg';
@endphp

<a href="/" wire:navigate {{ $attributes->merge(['class' => 'group inline-flex items-center gap-3']) }} aria-label="{{ config('site.name') }} home">
    {{-- Dual-eye panther mark (echoes the logo's red + blue eyes) --}}
    <span class="relative grid {{ $mark }} place-items-center rounded-xl border border-white/10 bg-ink-800 transition-transform duration-300 group-hover:scale-105">
        <x-panther class="h-full w-full p-1.5 text-white" />
    </span>
    <span class="flex flex-col leading-none">
        <span class="font-display {{ $text }} font-bold tracking-tight">
            <span class="text-white">Pantheraa</span>&nbsp;<span class="text-steel-400">Space</span>
        </span>
        @if($showTagline)
            <span class="mt-1 text-[10px] font-semibold uppercase tracking-[0.34em] text-steel-500">Digital Panther</span>
        @endif
    </span>
</a>
