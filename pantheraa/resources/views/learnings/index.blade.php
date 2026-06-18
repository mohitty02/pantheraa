@php
    $s = config('site');
    $breadcrumb = [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Learnings', 'item' => url('/learnings')],
        ],
    ];
    $blog = [
        '@type'       => 'Blog',
        '@id'         => url('/learnings') . '#blog',
        'name'        => $s['name'] . ' — Learnings',
        'description' => $s['learnings']['tagline'],
        'url'         => url('/learnings'),
        'publisher'   => ['@id' => rtrim($s['url'], '/') . '/#organization'],
    ];
@endphp

<x-app-layout
    title="Learnings — Daily Notes on AI, LLMs, RAG & Building"
    :description="$s['learnings']['tagline']"
    :schema="[$breadcrumb, $blog]"
>
    <section class="relative overflow-hidden pb-8 pt-36 sm:pt-44">
        <div class="grid-bg absolute inset-0"></div>
        <div class="orb -left-20 top-10 h-80 w-80 bg-flame-600/20"></div>
        <div class="orb -right-20 top-20 h-80 w-80 bg-volt-600/20"></div>
        <div class="container-px relative text-center">
            <span class="kicker" data-hero>Learnings</span>
            <h1 class="mx-auto mt-6 max-w-3xl text-4xl font-bold leading-[1.06] sm:text-6xl" data-hero>
                Notes from the <span class="text-gradient">frontier.</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-white/65" data-hero>
                {{ $s['learnings']['tagline'] }} Everything I learn — code, math, experiments and ideas — shared in the open.
            </p>
        </div>
    </section>

    <section class="pb-24">
        <div class="container-px">
            <livewire:learnings.index />
        </div>
    </section>
</x-app-layout>
