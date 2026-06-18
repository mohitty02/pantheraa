@php
    $s   = config('site');
    $org = rtrim($s['url'], '/') . '/#organization';
    $cover = $learning->cover_url;

    $related = \App\Models\Learning::published()
        ->where('id', '!=', $learning->id)
        ->when($learning->category, fn ($q) => $q->where('category', $learning->category))
        ->orderByDesc('published_at')->take(3)->get();
    if ($related->count() < 3) {
        $related = \App\Models\Learning::published()->where('id', '!=', $learning->id)
            ->orderByDesc('published_at')->take(3)->get();
    }

    $breadcrumb = [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Learnings', 'item' => url('/learnings')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $learning->title, 'item' => $learning->url],
        ],
    ];
    $authorName = config('site.seo.author_name') ?: $s['name'];
    $author = config('site.seo.author_name')
        ? ['@type' => 'Person', 'name' => $authorName]
        : ['@type' => 'Organization', 'name' => $s['name'], '@id' => $org];

    $article = array_filter([
        '@type'            => 'BlogPosting',
        '@id'              => $learning->url . '#article',
        'headline'         => $learning->title,
        'description'      => $learning->excerpt,
        'image'            => $cover ? [$cover] : null,
        'datePublished'    => optional($learning->published_at)->toAtomString(),
        'dateModified'     => $learning->updated_at->toAtomString(),
        'articleSection'   => $learning->category,
        'keywords'         => implode(', ', $learning->tag_list),
        'wordCount'        => str_word_count(strip_tags($learning->body)),
        'author'           => $author,
        'publisher'        => ['@id' => $org],
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $learning->url],
    ]);

    $articleMeta = array_filter([
        'published' => optional($learning->published_at)->toAtomString(),
        'modified'  => $learning->updated_at->toAtomString(),
        'section'   => $learning->category,
        'tags'      => $learning->tag_list,
    ]);
@endphp

<x-app-layout
    :title="$learning->meta_title ?: $learning->title"
    :description="$learning->meta_description ?: $learning->excerpt"
    :canonical="$learning->canonical ?: $learning->url"
    :ogImage="$cover"
    ogType="article"
    :articleMeta="$articleMeta"
    :noindex="(bool) $learning->noindex"
    :schema="[$breadcrumb, $article]"
>
    <article>
        {{-- Header --}}
        <header class="relative overflow-hidden pb-8 pt-36 sm:pt-44">
            <div class="grid-bg absolute inset-0"></div>
            <div class="orb -left-20 top-10 h-72 w-72 bg-flame-600/20"></div>
            <div class="orb -right-20 top-16 h-72 w-72 bg-volt-600/20"></div>
            <div class="container-px relative">
                <nav class="flex items-center gap-2 text-sm text-white/45" aria-label="Breadcrumb" data-hero>
                    <a href="/" wire:navigate class="hover:text-white">Home</a><span>/</span>
                    <a href="/learnings" wire:navigate class="hover:text-white">Learnings</a><span>/</span>
                    <span class="truncate text-white/70">{{ \Illuminate\Support\Str::limit($learning->title, 40) }}</span>
                </nav>

                <div class="mt-6 flex flex-wrap items-center gap-3 text-sm text-white/50" data-hero>
                    @if($learning->category)
                        @if($learning->categoryModel)
                            <a href="/learnings/category/{{ $learning->categoryModel->slug }}" wire:navigate class="rounded-full bg-gradient-to-r from-flame-500 to-volt-500 px-3 py-1 text-xs font-semibold text-white">{{ $learning->category }}</a>
                        @else
                            <span class="rounded-full bg-gradient-to-r from-flame-500 to-volt-500 px-3 py-1 text-xs font-semibold text-white">{{ $learning->category }}</span>
                        @endif
                    @endif
                    <span>{{ optional($learning->published_at)->format('d M Y') }}</span>
                    <span class="h-1 w-1 rounded-full bg-white/30"></span>
                    <span>{{ $learning->reading_minutes }} min read</span>
                </div>

                <h1 class="mt-5 max-w-4xl text-4xl font-bold leading-[1.08] sm:text-5xl lg:text-6xl" data-hero>{{ $learning->title }}</h1>
                @if($learning->excerpt)
                    <p class="mt-5 max-w-2xl text-lg text-white/65" data-hero>{{ $learning->excerpt }}</p>
                @endif
            </div>
        </header>

        @if($cover)
            <div class="container-px" data-reveal>
                <img src="{{ $cover }}" alt="{{ $learning->title }}" class="aspect-[21/9] w-full rounded-3xl border border-white/10 object-cover">
            </div>
        @endif

        {{-- Body --}}
        <div class="container-px pb-16 pt-12">
            <div class="mx-auto max-w-3xl">
                <div data-rich class="prose-rich">
                    {!! $learning->rendered_body !!}
                </div>

                @if($learning->tag_list)
                    <div class="mt-10 flex flex-wrap gap-2 border-t border-white/10 pt-8">
                        @foreach($learning->tag_list as $tag)
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/60">#{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="mt-10 flex items-center justify-between rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                    <div class="flex items-center gap-3">
                        <x-panther class="h-10 w-10 text-white" />
                        <div>
                            <div class="text-sm font-semibold text-white">{{ $s['name'] }}</div>
                            <div class="text-xs text-white/50">{{ $s['tagline'] }}</div>
                        </div>
                    </div>
                    <a href="/contact" wire:navigate class="btn-primary">Work with us <x-icon name="arrow" class="h-4 w-4" /></a>
                </div>
            </div>
        </div>

        {{-- Related --}}
        @if($related->count())
            <section class="section pt-0">
                <div class="container-px">
                    <h2 class="text-2xl sm:text-3xl" data-reveal>Keep reading</h2>
                    <div class="mt-8 grid gap-5 sm:grid-cols-3" data-stagger>
                        @foreach($related as $r)
                            <a href="/learnings/{{ $r->slug }}" wire:navigate class="card group flex flex-col overflow-hidden !p-0">
                                <div class="relative aspect-[16/9] overflow-hidden">
                                    @if($r->cover_url)
                                        <img src="{{ $r->cover_url }}" alt="{{ $r->title }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div class="grid h-full w-full place-items-center bg-gradient-to-br from-flame-600/30 to-volt-600/30"><x-panther class="h-12 w-12 text-white/80" /></div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    @if($r->category)<span class="text-xs font-semibold text-steel-400">{{ $r->category }}</span>@endif
                                    <h3 class="mt-1 text-base leading-snug text-white group-hover:text-volt-300">{{ $r->title }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>
</x-app-layout>
