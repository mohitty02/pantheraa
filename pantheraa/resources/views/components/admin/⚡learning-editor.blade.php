<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Learning;
use App\Models\LearningCategory;
use App\Support\Markdown;
use Illuminate\Support\Str;

new class extends Component
{
    use WithFileUploads;

    public ?int $learningId = null;

    public string $title = '';
    public string $slug = '';
    public string $excerpt = '';
    public string $body = '';
    public ?int $categoryId = null;
    public string $tagsInput = '';
    public string $status = 'draft';
    public ?string $publishedAt = null;
    public string $metaTitle = '';
    public string $metaDescription = '';
    public string $canonical = '';
    public bool $noindex = false;

    public $cover = null;            // newly uploaded file
    public ?string $coverPath = null; // existing stored path

    public function mount(?int $learningId = null): void
    {
        if ($learningId) {
            $l = Learning::findOrFail($learningId);
            $this->learningId = $l->id;
            $this->title = $l->title;
            $this->slug = $l->slug;
            $this->excerpt = (string) $l->excerpt;
            $this->body = (string) $l->body;
            $this->categoryId = $l->category_id;
            $this->tagsInput = implode(', ', $l->tag_list);
            $this->status = $l->status;
            $this->publishedAt = optional($l->published_at)->format('Y-m-d\TH:i');
            $this->metaTitle = (string) $l->meta_title;
            $this->metaDescription = (string) $l->meta_description;
            $this->canonical = (string) $l->canonical;
            $this->noindex = (bool) $l->noindex;
            $this->coverPath = $l->cover_path;
        }
    }

    public function save(bool $publish = false)
    {
        if ($publish) {
            $this->status = 'published';
        }

        $data = $this->validate([
            'title'           => ['required', 'string', 'max:200'],
            'slug'            => ['nullable', 'string', 'max:200'],
            'excerpt'         => ['nullable', 'string', 'max:500'],
            'body'            => ['required', 'string'],
            'categoryId'      => ['nullable', 'exists:learning_categories,id'],
            'status'          => ['required', 'in:draft,published'],
            'cover'           => ['nullable', 'image', 'max:6144'],
            'metaTitle'       => ['nullable', 'string', 'max:200'],
            'metaDescription' => ['nullable', 'string', 'max:320'],
            'canonical'       => ['nullable', 'string', 'max:255'],
        ]);

        if ($this->cover) {
            $name = Str::random(8) . '-' . Str::slug(pathinfo($this->cover->getClientOriginalName(), PATHINFO_FILENAME));
            $ext = $this->cover->getClientOriginalExtension() ?: 'jpg';
            $this->coverPath = $this->cover->storeAs('learnings', "{$name}.{$ext}", 'uploads');
        }

        $tags = collect(explode(',', $this->tagsInput))
            ->map(fn ($t) => trim($t))->filter()->values()->all();

        $publishedAt = $this->publishedAt
            ? \Illuminate\Support\Carbon::parse($this->publishedAt)
            : ($this->status === 'published' ? now() : null);

        $payload = [
            'title'            => $this->title,
            'slug'             => $this->slug ?: Learning::uniqueSlug($this->title, $this->learningId),
            'excerpt'          => $this->excerpt ?: Markdown::preview($this->body, 180),
            'body'             => $this->body,
            'category_id'      => $this->categoryId ?: null,
            'category'         => null, // denormalized name is set from category_id in the model
            'tags'             => $tags,
            'cover_path'       => $this->coverPath,
            'status'           => $this->status,
            'published_at'     => $publishedAt,
            'meta_title'       => $this->metaTitle ?: null,
            'meta_description' => $this->metaDescription ?: null,
            'canonical'        => $this->canonical ?: null,
            'noindex'          => $this->noindex,
        ];

        if ($this->learningId) {
            Learning::findOrFail($this->learningId)->update($payload);
        } else {
            Learning::create($payload);
        }

        session()->flash('status', 'Learning saved successfully.');

        return $this->redirect('/admin/learnings', navigate: true);
    }

    public function with(): array
    {
        return [
            'preview'    => Markdown::toHtml($this->body),
            'categories' => LearningCategory::active()->get(),
        ];
    }
}; ?>

<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="/admin/learnings" wire:navigate class="text-sm text-white/50 hover:text-white">← Back to Learnings</a>
            <h2 class="mt-1 text-2xl">{{ $learningId ? 'Edit learning' : 'New learning' }}</h2>
        </div>
        <div class="flex items-center gap-2">
            <button wire:click="save(false)" class="btn-ghost" wire:loading.attr="disabled">Save draft</button>
            <button wire:click="save(true)" class="btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">Publish</span>
                <span wire:loading wire:target="save">Saving…</span>
            </button>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        {{-- Editor --}}
        <div class="space-y-5">
            <div>
                <label class="mb-1.5 block text-sm font-medium text-white/80">Title <span class="text-flame-400">*</span></label>
                <input type="text" wire:model="title" placeholder="What did you learn today?"
                       class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-3 text-white placeholder-white/30 outline-none focus:border-volt-500">
                @error('title') <p class="mt-1 text-xs text-flame-400">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-white/80">Slug <span class="text-white/40">(auto)</span></label>
                    <input type="text" wire:model="slug" placeholder="auto-from-title"
                           class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-3 text-sm text-white placeholder-white/30 outline-none focus:border-volt-500">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-white/80">Category</label>
                    <select wire:model="categoryId"
                            class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-3 text-sm text-white outline-none focus:border-volt-500">
                        <option value="" class="bg-ink-900">— None —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" class="bg-ink-900">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @if($categories->isEmpty())
                        <p class="mt-1 text-xs text-white/40">No categories yet — <a href="/admin/content/categories" class="text-volt-400">add some</a>.</p>
                    @endif
                </div>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-white/80">Tags <span class="text-white/40">(comma separated)</span></label>
                <input type="text" wire:model="tagsInput" placeholder="rag, embeddings, vector-db"
                       class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-3 text-sm text-white placeholder-white/30 outline-none focus:border-volt-500">
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-white/80">Excerpt <span class="text-white/40">(optional)</span></label>
                <textarea wire:model="excerpt" rows="2" placeholder="Short summary (auto-generated if left blank)"
                          class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-3 text-sm text-white placeholder-white/30 outline-none focus:border-volt-500"></textarea>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-white/80">Cover image</label>
                <input type="file" wire:model="cover" accept="image/*"
                       class="block w-full text-sm text-white/60 file:mr-3 file:rounded-lg file:border-0 file:bg-white/10 file:px-3 file:py-2 file:text-sm file:text-white hover:file:bg-white/20">
                <div wire:loading wire:target="cover" class="mt-1 text-xs text-white/50">Uploading…</div>
                @error('cover') <p class="mt-1 text-xs text-flame-400">{{ $message }}</p> @enderror
                @if($cover)
                    <img src="{{ $cover->temporaryUrl() }}" class="mt-3 h-32 w-full rounded-xl object-cover" alt="preview">
                @elseif($coverPath)
                    <img src="{{ asset('uploads/' . $coverPath) }}" class="mt-3 h-32 w-full rounded-xl object-cover" alt="cover">
                @endif
            </div>

            <div>
                <label class="mb-1.5 flex items-center justify-between text-sm font-medium text-white/80">
                    <span>Body <span class="text-flame-400">*</span></span>
                    <span class="text-xs font-normal text-white/40">Markdown · ```code``` · $LaTeX$ · ![img](url)</span>
                </label>
                <textarea wire:model.live.debounce.500ms="body" rows="20" spellcheck="false"
                          class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-3 font-mono text-sm leading-relaxed text-white placeholder-white/30 outline-none focus:border-volt-500"
                          placeholder="# Heading&#10;&#10;Today I learned about **RAG**…&#10;&#10;```python&#10;print('hello')&#10;```&#10;&#10;Inline math like $E = mc^2$ and block:&#10;$$ \int_0^1 x^2 dx = \frac{1}{3} $$"></textarea>
                @error('body') <p class="mt-1 text-xs text-flame-400">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-white/80">Status</label>
                    <select wire:model="status" class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-3 text-sm text-white outline-none focus:border-volt-500">
                        <option value="draft" class="bg-ink-900">Draft</option>
                        <option value="published" class="bg-ink-900">Published</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-white/80">Publish date</label>
                    <input type="datetime-local" wire:model="publishedAt"
                           class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-3 text-sm text-white outline-none focus:border-volt-500">
                </div>
            </div>

            {{-- SEO --}}
            <div class="rounded-2xl border border-white/10 p-4">
                <h3 class="flex items-center gap-2 text-sm font-semibold text-white"><x-icon name="shield" class="h-4 w-4 text-volt-400" /> SEO</h3>
                <div class="mt-3 space-y-3">
                    <div>
                        <label class="mb-1 block text-xs font-medium text-white/70">Meta title <span class="text-white/40">(defaults to title)</span></label>
                        <input type="text" wire:model="metaTitle" class="w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-sm text-white outline-none focus:border-volt-500">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium text-white/70">Meta description <span class="text-white/40">(defaults to excerpt)</span></label>
                        <textarea wire:model="metaDescription" rows="2" class="w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-sm text-white outline-none focus:border-volt-500"></textarea>
                        @error('metaDescription') <p class="mt-1 text-xs text-flame-400">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium text-white/70">Canonical URL <span class="text-white/40">(optional)</span></label>
                        <input type="text" wire:model="canonical" placeholder="https://…" class="w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-sm text-white outline-none focus:border-volt-500">
                    </div>
                    <label class="flex items-center gap-2 text-sm text-white/70">
                        <input type="checkbox" wire:model="noindex" class="rounded border-white/20 bg-ink-950 text-flame-500"> Hide from search engines (noindex)
                    </label>
                </div>
            </div>
        </div>

        {{-- Live preview --}}
        <div class="lg:sticky lg:top-24 lg:self-start">
            <div class="mb-2 flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-white/40">
                <span class="h-1.5 w-1.5 rounded-full bg-volt-400"></span> Live preview
            </div>
            <div class="h-[36rem] overflow-y-auto rounded-2xl border border-white/10 bg-ink-950 p-6">
                <article data-rich class="prose-rich">
                    {!! $preview ?: '<p class="text-white/30">Start typing to see a preview…</p>' !!}
                </article>
            </div>
        </div>
    </div>
</div>
