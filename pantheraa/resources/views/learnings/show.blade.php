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
    // E-E-A-T: a named, credentialed human is a far stronger authorship signal
    // than a faceless brand. Falls back to the Organization if no author is set.
    $authorName  = config('site.seo.author_name');
    $authorRole  = config('site.seo.author_role');
    $authorBio   = config('site.seo.author_bio');
    $authorImage = config('site.seo.author_image');
    $authorUrl   = config('site.seo.author_url') ?: url('/about');

    $author = $authorName
        ? array_filter([
            '@type'       => 'Person',
            'name'        => $authorName,
            'jobTitle'    => $authorRole ?: null,
            'description' => $authorBio ?: null,
            'image'       => $authorImage ?: null,
            'url'         => $authorUrl,
            'worksFor'    => ['@type' => 'Organization', 'name' => $s['name'], '@id' => $org],
        ])
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
                <nav class="flex items-center gap-2 text-sm text-ink-400" aria-label="Breadcrumb" data-hero>
                    <a href="/" wire:navigate class="hover:text-ink-900">Home</a><span>/</span>
                    <a href="/learnings" wire:navigate class="hover:text-ink-900">Learnings</a><span>/</span>
                    <span class="truncate text-ink-600">{{ \Illuminate\Support\Str::limit($learning->title, 40) }}</span>
                </nav>

                <div class="mt-6 flex flex-wrap items-center gap-3 text-sm text-ink-500" data-hero>
                    @if($learning->category)
                        @if($learning->categoryModel)
                            <a href="/learnings/category/{{ $learning->categoryModel->slug }}" wire:navigate class="rounded-full bg-gradient-to-r from-flame-500 to-volt-500 px-3 py-1 text-xs font-semibold text-white">{{ $learning->category }}</a>
                        @else
                            <span class="rounded-full bg-gradient-to-r from-flame-500 to-volt-500 px-3 py-1 text-xs font-semibold text-white">{{ $learning->category }}</span>
                        @endif
                    @endif
                    @if($authorName)
                        <span>By <span class="font-semibold text-ink-800">{{ $authorName }}</span></span>
                        <span class="h-1 w-1 rounded-full bg-ink-300"></span>
                    @endif
                    <span>{{ optional($learning->published_at)->format('d M Y') }}</span>
                    @if($learning->updated_at && $learning->published_at && $learning->updated_at->gt($learning->published_at->addDay()))
                        <span class="h-1 w-1 rounded-full bg-ink-300"></span>
                        <span>Updated {{ $learning->updated_at->format('d M Y') }}</span>
                    @endif
                    <span class="h-1 w-1 rounded-full bg-ink-300"></span>
                    <span>{{ $learning->reading_minutes }} min read</span>
                </div>

                <h1 class="mt-5 max-w-4xl text-4xl font-bold leading-[1.08] sm:text-5xl lg:text-6xl" data-hero>{{ $learning->title }}</h1>
                @if($learning->excerpt)
                    <p class="mt-5 max-w-2xl text-lg text-ink-600" data-hero>{{ $learning->excerpt }}</p>
                @endif
            </div>
        </header>

        @if($cover)
            <div class="container-px" data-reveal>
                <img src="{{ $cover }}" alt="{{ $learning->title }}" class="aspect-[21/9] w-full rounded-3xl border border-ink-200 object-cover">
            </div>
        @endif

        {{-- Body --}}
        <div class="container-px pb-16 pt-12">
            <div class="mx-auto max-w-3xl">
                <div data-rich class="prose-rich">
                    {!! $learning->rendered_body !!}
                </div>

                @if($learning->tag_list)
                    <div class="mt-10 flex flex-wrap gap-2 border-t border-ink-200 pt-8">
                        @foreach($learning->tag_list as $tag)
                            <span class="rounded-full border border-ink-200 bg-ink-50 px-3 py-1 text-xs text-ink-500">#{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif

                {{-- E-E-A-T: author box — who wrote this, and why they are worth trusting --}}
                <div class="mt-10 rounded-2xl border border-ink-200 bg-ink-50 p-6">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-start">
                        <span class="grid h-14 w-14 shrink-0 place-items-center overflow-hidden rounded-full border border-ink-200 bg-white">
                            @if($authorImage)
                                <img src="{{ $authorImage }}" alt="{{ $authorName }}" class="h-full w-full object-cover">
                            @else
                                <x-panther class="h-9 w-9 text-ink-900" />
                            @endif
                        </span>
                        <div class="min-w-0 flex-1">
                            <div class="text-xs font-semibold uppercase tracking-[0.18em] text-ink-400">Written by</div>
                            <div class="mt-1 text-base font-semibold text-ink-900">{{ $authorName ?: $s['name'] }}</div>
                            @if($authorRole)
                                <div class="text-sm text-steel-600">{{ $authorRole }}</div>
                            @endif
                            <p class="mt-2 text-sm leading-relaxed text-ink-600">
                                {{ $authorBio ?: $s['short_desc'] }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 flex flex-col gap-3 border-t border-ink-200 pt-5 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-ink-500">Want this done for your business?</p>
                        <a href="/contact" wire:navigate class="btn-primary shrink-0">
                            Get a free audit <x-icon name="arrow" class="h-4 w-4" />
                        </a>
                    </div>
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
                                        <div class="grid h-full w-full place-items-center bg-gradient-to-br from-flame-600/30 to-volt-600/30"><x-panther class="h-12 w-12 text-ink-700" /></div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    @if($r->category)<span class="text-xs font-semibold text-steel-600">{{ $r->category }}</span>@endif
                                    <h3 class="mt-1 text-base leading-snug text-ink-900 group-hover:text-volt-600">{{ $r->title }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>
</x-app-layout>
