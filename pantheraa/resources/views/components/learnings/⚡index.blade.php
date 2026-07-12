<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Learning;
use App\Models\LearningCategory;

new class extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public string $category = ''; // category slug

    public function mount(string $category = ''): void
    {
        $this->category = $category;
    }

    public function updatingSearch() { $this->resetPage(); }

    public function setCategory(string $slug): void
    {
        $this->category = $this->category === $slug ? '' : $slug;
        $this->resetPage();
    }

    public function with(): array
    {
        $items = Learning::published()
            ->when($this->search, fn ($q) => $q->where(fn ($w) =>
                $w->where('title', 'like', "%{$this->search}%")
                  ->orWhere('excerpt', 'like', "%{$this->search}%")))
            ->when($this->category, fn ($q) => $q->whereHas('categoryModel', fn ($c) => $c->where('slug', $this->category)))
            ->orderByDesc('published_at')
            ->paginate(9);

        return [
            'items'      => $items,
            'categories' => LearningCategory::active()->get(),
        ];
    }
}; ?>

<div>
    {{-- Controls --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div class="flex flex-wrap gap-2">
            <button wire:click="setCategory('')"
                    class="rounded-full border px-4 py-1.5 text-sm font-medium transition-colors {{ $category === '' ? 'border-transparent bg-ink-50 text-ink-900' : 'border-ink-200 text-ink-600 hover:text-ink-900' }}">
                All
            </button>
            @foreach($categories as $c)
                <button wire:click="setCategory('{{ $c->slug }}')"
                        class="rounded-full border px-4 py-1.5 text-sm font-medium transition-colors {{ $category === $c->slug ? 'border-transparent bg-ink-50 text-ink-900' : 'border-ink-200 text-ink-600 hover:text-ink-900' }}">
                    {{ $c->name }}
                </button>
            @endforeach
        </div>
        <div class="lg:w-72">
            <input type="search" wire:model.live.debounce.300ms="search" placeholder="Search learnings…"
                   class="w-full rounded-full border border-ink-200 bg-ink-50 px-5 py-2.5 text-sm text-ink-900 placeholder-ink-400 outline-none focus:border-volt-500">
        </div>
    </div>

    {{-- Grid --}}
    <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" wire:key="page-{{ $items->currentPage() }}-{{ $category }}-{{ $search }}">
        @forelse($items as $l)
            <a href="/learnings/{{ $l->slug }}" wire:navigate wire:key="l-{{ $l->id }}"
               class="card group flex flex-col overflow-hidden !p-0">
                <div class="relative aspect-[16/9] overflow-hidden">
                    @if($l->cover_url)
                        <img src="{{ $l->cover_url }}" alt="{{ $l->title }}" loading="lazy"
                             class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="grid h-full w-full place-items-center bg-gradient-to-br from-volt-400/45 to-flame-500/35">
                            <x-panther class="h-14 w-14 text-ink-700" />
                        </div>
                    @endif
                    @if($l->category)
                        <span class="absolute left-3 top-3 rounded-full bg-white/85 px-2.5 py-1 text-[11px] font-semibold text-ink-900 backdrop-blur">{{ $l->category }}</span>
                    @endif
                </div>
                <div class="flex flex-1 flex-col p-6">
                    <h3 class="text-lg leading-snug text-ink-900 group-hover:text-volt-600">{{ $l->title }}</h3>
                    <p class="mt-2 flex-1 text-sm leading-relaxed text-ink-500">{{ \Illuminate\Support\Str::limit($l->excerpt, 120) }}</p>
                    <div class="mt-4 flex items-center gap-3 text-xs text-ink-400">
                        <span>{{ optional($l->published_at)->format('d M Y') }}</span>
                        <span class="h-1 w-1 rounded-full bg-ink-300"></span>
                        <span>{{ $l->reading_minutes }} min read</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full rounded-2xl border border-ink-200 bg-ink-50 py-16 text-center text-ink-400">
                No learnings found{{ $category ? ' in '.$category : '' }}. Check back soon. 🐾
            </div>
        @endforelse
    </div>

    <div class="mt-10">{{ $items->links() }}</div>
</div>
