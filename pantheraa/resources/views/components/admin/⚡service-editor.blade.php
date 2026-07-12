<?php

use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Str;

new class extends Component
{
    public ?int $serviceId = null;

    public string $name = '';
    public string $slug = '';
    public string $short = '';
    public string $icon = 'spark';
    public string $tagline = '';
    public string $description = '';
    public string $overview = '';
    public bool $featured = false;
    public bool $is_active = true;
    public string $metaTitle = '';
    public string $metaDescription = '';

    public array $points = [''];
    public array $deliverables = [['title' => '', 'desc' => '']];
    public array $outcomes = [''];
    public array $faqs = [['q' => '', 'a' => '']];

    public array $icons = ['spark', 'search', 'mobile', 'target', 'chat', 'code', 'bot', 'workflow', 'wand', 'plug', 'mic', 'gauge', 'bolt', 'shield'];

    public function mount(?int $serviceId = null): void
    {
        if ($serviceId) {
            $s = Service::findOrFail($serviceId);
            $this->serviceId = $s->id;
            $this->name = $s->name;
            $this->slug = $s->slug;
            $this->short = (string) $s->short;
            $this->icon = $s->icon ?: 'spark';
            $this->tagline = (string) $s->tagline;
            $this->description = (string) $s->description;
            $this->overview = (string) $s->overview;
            $this->featured = (bool) $s->featured;
            $this->is_active = (bool) $s->is_active;
            $this->metaTitle = (string) $s->meta_title;
            $this->metaDescription = (string) $s->meta_description;
            $this->points = $s->points ?: [''];
            $this->deliverables = $s->deliverables ?: [['title' => '', 'desc' => '']];
            $this->outcomes = $s->outcomes ?: [''];
            $this->faqs = $s->faqs ?: [['q' => '', 'a' => '']];
        }
    }

    public function addPoint() { $this->points[] = ''; }
    public function removePoint($i) { unset($this->points[$i]); $this->points = array_values($this->points); }
    public function addOutcome() { $this->outcomes[] = ''; }
    public function removeOutcome($i) { unset($this->outcomes[$i]); $this->outcomes = array_values($this->outcomes); }
    public function addDeliverable() { $this->deliverables[] = ['title' => '', 'desc' => '']; }
    public function removeDeliverable($i) { unset($this->deliverables[$i]); $this->deliverables = array_values($this->deliverables); }
    public function addFaq() { $this->faqs[] = ['q' => '', 'a' => '']; }
    public function removeFaq($i) { unset($this->faqs[$i]); $this->faqs = array_values($this->faqs); }

    public function save()
    {
        $this->validate([
            'name'        => 'required|string|max:200',
            'slug'        => 'nullable|string|max:200',
            'icon'        => 'required|string',
            'tagline'     => 'nullable|string|max:200',
            'description' => 'nullable|string|max:1000',
            'overview'    => 'nullable|string|max:1000',
        ]);

        $clean = fn ($arr) => collect($arr)->map(fn ($v) => is_string($v) ? trim($v) : $v)
            ->filter(fn ($v) => is_array($v) ? collect($v)->filter()->isNotEmpty() : $v !== '')
            ->values()->all();

        $slug = $this->slug ?: Str::slug($this->name);
        $slug = Str::slug($slug);
        // ensure unique
        $exists = Service::where('slug', $slug)->when($this->serviceId, fn ($q) => $q->where('id', '!=', $this->serviceId))->exists();
        if ($exists) {
            $slug .= '-' . Str::random(4);
        }

        $payload = [
            'name'         => $this->name,
            'slug'         => $slug,
            'short'        => $this->short ?: null,
            'icon'         => $this->icon,
            'tagline'      => $this->tagline ?: null,
            'description'  => $this->description ?: null,
            'overview'     => $this->overview ?: null,
            'featured'     => $this->featured,
            'is_active'    => $this->is_active,
            'points'       => $clean($this->points),
            'deliverables' => $clean($this->deliverables),
            'outcomes'     => $clean($this->outcomes),
            'faqs'         => $clean($this->faqs),
            'meta_title'       => $this->metaTitle ?: null,
            'meta_description' => $this->metaDescription ?: null,
        ];

        if ($this->serviceId) {
            Service::findOrFail($this->serviceId)->update($payload);
        } else {
            $payload['sort'] = (int) Service::max('sort') + 1;
            Service::create($payload);
        }

        session()->flash('status', 'Service saved.');

        return $this->redirect('/admin/services', navigate: true);
    }
}; ?>

<div class="max-w-3xl">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="/admin/services" wire:navigate class="text-sm text-ink-500 hover:text-ink-900">← Back to Services</a>
            <h2 class="mt-1 text-2xl">{{ $serviceId ? 'Edit service' : 'New service' }}</h2>
        </div>
        <button wire:click="save" class="btn-primary" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save">Save service</span>
            <span wire:loading wire:target="save">Saving…</span>
        </button>
    </div>

    <div class="space-y-5">
        <div class="card grid gap-4 sm:grid-cols-2">
            <div class="sm:col-span-2"><x-admin.field wire="name" label="Name" /></div>
            <x-admin.field wire="slug" label="Slug (auto if blank)" />
            <x-admin.field wire="short" label="Short label (e.g. SEO)" />
            <div>
                <label class="mb-1.5 block text-sm font-medium text-ink-700">Icon</label>
                <div class="flex items-center gap-3">
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-lg border border-ink-200 bg-gradient-to-br from-flame-500/20 to-volt-500/20 text-ink-900">
                        <x-icon :name="$icon" class="h-5 w-5" />
                    </span>
                    <select wire:model.live="icon" class="w-full rounded-xl border border-ink-200 bg-ink-50 px-4 py-2.5 text-sm text-ink-900 outline-none focus:border-volt-500">
                        @foreach($icons as $ic)<option value="{{ $ic }}" class="bg-ink-50">{{ $ic }}</option>@endforeach
                    </select>
                </div>
            </div>
            <label class="flex items-center gap-2 text-sm text-ink-600">
                <input type="checkbox" wire:model="featured" class="rounded border-ink-300 bg-white text-flame-500"> Featured
            </label>
            <label class="flex items-center gap-2 text-sm text-ink-600">
                <input type="checkbox" wire:model="is_active" class="rounded border-ink-300 bg-white text-volt-500"> Active
            </label>
            <div class="sm:col-span-2"><x-admin.field wire="tagline" label="Tagline" /></div>
            <div class="sm:col-span-2"><x-admin.field wire="description" label="Short description (cards & schema)" type="textarea" /></div>
            <div class="sm:col-span-2"><x-admin.field wire="overview" label="Overview (detail page intro)" type="textarea" /></div>
            <div class="sm:col-span-2"><x-admin.field wire="metaTitle" label="SEO meta title (optional)" /></div>
            <div class="sm:col-span-2"><x-admin.field wire="metaDescription" label="SEO meta description (optional)" type="textarea" /></div>
        </div>

        {{-- Points --}}
        <div class="card">
            <div class="flex items-center justify-between"><h3 class="text-base font-semibold text-ink-900">Key points</h3>
                <button wire:click="addPoint" class="text-sm text-volt-600">+ Add</button></div>
            <div class="mt-3 space-y-2">
                @foreach($points as $i => $p)
                    <div class="flex gap-2" wire:key="pt-{{ $i }}">
                        <input type="text" wire:model="points.{{ $i }}" class="w-full rounded-lg border border-ink-200 bg-ink-50 px-3 py-2 text-sm text-ink-900 outline-none focus:border-volt-500">
                        <button wire:click="removePoint({{ $i }})" class="rounded-lg border border-ink-200 px-3 text-flame-600">✕</button>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Deliverables --}}
        <div class="card">
            <div class="flex items-center justify-between"><h3 class="text-base font-semibold text-ink-900">Deliverables (detail page)</h3>
                <button wire:click="addDeliverable" class="text-sm text-volt-600">+ Add</button></div>
            <div class="mt-3 space-y-3">
                @foreach($deliverables as $i => $d)
                    <div class="rounded-xl border border-ink-200 p-3" wire:key="dl-{{ $i }}">
                        <div class="flex items-center gap-2">
                            <input type="text" placeholder="Title" wire:model="deliverables.{{ $i }}.title" class="w-full rounded-lg border border-ink-200 bg-ink-50 px-3 py-2 text-sm text-ink-900 outline-none focus:border-volt-500">
                            <button wire:click="removeDeliverable({{ $i }})" class="rounded-lg border border-ink-200 px-3 text-flame-600">✕</button>
                        </div>
                        <textarea rows="2" placeholder="Description" wire:model="deliverables.{{ $i }}.desc" class="mt-2 w-full rounded-lg border border-ink-200 bg-ink-50 px-3 py-2 text-sm text-ink-900 outline-none focus:border-volt-500"></textarea>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Outcomes --}}
        <div class="card">
            <div class="flex items-center justify-between"><h3 class="text-base font-semibold text-ink-900">Outcomes</h3>
                <button wire:click="addOutcome" class="text-sm text-volt-600">+ Add</button></div>
            <div class="mt-3 space-y-2">
                @foreach($outcomes as $i => $o)
                    <div class="flex gap-2" wire:key="oc-{{ $i }}">
                        <input type="text" wire:model="outcomes.{{ $i }}" class="w-full rounded-lg border border-ink-200 bg-ink-50 px-3 py-2 text-sm text-ink-900 outline-none focus:border-volt-500">
                        <button wire:click="removeOutcome({{ $i }})" class="rounded-lg border border-ink-200 px-3 text-flame-600">✕</button>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- FAQs --}}
        <div class="card">
            <div class="flex items-center justify-between"><h3 class="text-base font-semibold text-ink-900">FAQs</h3>
                <button wire:click="addFaq" class="text-sm text-volt-600">+ Add</button></div>
            <div class="mt-3 space-y-3">
                @foreach($faqs as $i => $f)
                    <div class="rounded-xl border border-ink-200 p-3" wire:key="fq-{{ $i }}">
                        <div class="flex items-center gap-2">
                            <input type="text" placeholder="Question" wire:model="faqs.{{ $i }}.q" class="w-full rounded-lg border border-ink-200 bg-ink-50 px-3 py-2 text-sm text-ink-900 outline-none focus:border-volt-500">
                            <button wire:click="removeFaq({{ $i }})" class="rounded-lg border border-ink-200 px-3 text-flame-600">✕</button>
                        </div>
                        <textarea rows="2" placeholder="Answer" wire:model="faqs.{{ $i }}.a" class="mt-2 w-full rounded-lg border border-ink-200 bg-ink-50 px-3 py-2 text-sm text-ink-900 outline-none focus:border-volt-500"></textarea>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
