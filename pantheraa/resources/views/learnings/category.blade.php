@php
    $s = config('site');
    $url = url('/learnings/category/' . $category->slug);
    $count = \App\Models\Learning::published()->where('category_id', $category->id)->count();

    $breadcrumb = [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Learnings', 'item' => url('/learnings')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $category->name, 'item' => $url],
        ],
    ];
    $collection = array_filter([
        '@type'       => 'CollectionPage',
        '@id'         => $url,
        'name'        => $category->name . ' — Learnings',
        'description' => $category->description ?: null,
        'url'         => $url,
        'isPartOf'    => ['@id' => rtrim($s['url'], '/') . '/#website'],
    ]);
@endphp

<x-app-layout
    :title="$category->name . ' — Learnings'"
    :description="$category->description ?: ('Learnings on ' . $category->name . ' from ' . $s['name'] . '.')"
    :canonical="$url"
    :schema="[$breadcrumb, $collection]"
>
    <section class="relative overflow-hidden pb-8 pt-36 sm:pt-44">
        <div class="grid-bg absolute inset-0"></div>
        <div class="orb -left-20 top-10 h-80 w-80 bg-flame-600/20"></div>
        <div class="orb -right-20 top-20 h-80 w-80 bg-volt-600/20"></div>
        <div class="container-px relative text-center">
            <nav class="flex items-center justify-center gap-2 text-sm text-white/45" aria-label="Breadcrumb">
                <a href="/learnings" wire:navigate class="hover:text-white">Learnings</a><span>/</span>
                <span class="text-white/70">{{ $category->name }}</span>
            </nav>
            <h1 class="mx-auto mt-5 max-w-3xl text-4xl font-bold sm:text-6xl" data-hero>
                <span class="text-gradient">{{ $category->name }}</span>
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg text-white/65" data-hero>
                {{ $category->description ?: 'Everything I\'m learning about ' . $category->name . '.' }}
                <span class="text-white/40">· {{ $count }} {{ \Illuminate\Support\Str::plural('post', $count) }}</span>
            </p>
        </div>
    </section>

    <section class="pb-24">
        <div class="container-px">
            <livewire:learnings.index :category="$category->slug" />
        </div>
    </section>
</x-app-layout>
