<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contact;

new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filter = 'all';
    public ?int $openId = null;

    public array $statuses = ['new', 'contacted', 'won', 'lost'];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilter() { $this->resetPage(); }

    public function toggle(int $id): void { $this->openId = $this->openId === $id ? null : $id; }

    public function setStatus(int $id, string $status): void
    {
        if (in_array($status, $this->statuses, true)) {
            Contact::findOrFail($id)->update(['status' => $status]);
        }
    }

    public function delete(int $id): void
    {
        Contact::findOrFail($id)->delete();
        if ($this->openId === $id) {
            $this->openId = null;
        }
    }

    public function with(): array
    {
        $items = Contact::query()
            ->when($this->search, fn ($q) => $q->where(fn ($w) =>
                $w->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
                  ->orWhere('company', 'like', "%{$this->search}%")))
            ->when($this->filter !== 'all', fn ($q) => $q->where('status', $this->filter))
            ->latest()->paginate(12);

        return ['items' => $items, 'newCount' => Contact::where('status', 'new')->count()];
    }
}; ?>

<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl">Leads</h2>
            <p class="mt-1 text-sm text-ink-500">Contact-form submissions · <span class="text-flame-600">{{ $newCount }} new</span></p>
        </div>
        <div class="flex gap-3">
            <input type="search" wire:model.live.debounce.300ms="search" placeholder="Search name / email…"
                   class="rounded-xl border border-ink-200 bg-ink-50 px-4 py-2.5 text-sm text-ink-900 placeholder-ink-400 outline-none focus:border-volt-500">
            <select wire:model.live="filter" class="rounded-xl border border-ink-200 bg-ink-50 px-3 py-2.5 text-sm text-ink-900 outline-none focus:border-volt-500">
                <option value="all" class="bg-ink-50">All</option>
                @foreach($statuses as $st)<option value="{{ $st }}" class="bg-ink-50">{{ ucfirst($st) }}</option>@endforeach
            </select>
        </div>
    </div>

    <div class="mt-5 space-y-2">
        @forelse($items as $c)
            <div class="overflow-hidden rounded-xl border border-ink-200" wire:key="lead-{{ $c->id }}">
                <button wire:click="toggle({{ $c->id }})" class="flex w-full items-center justify-between gap-4 px-4 py-3 text-left hover:bg-ink-50">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-medium text-ink-900">{{ $c->name }}</span>
                            <span class="rounded-full px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide
                                {{ $c->status === 'new' ? 'bg-flame-500/15 text-flame-600' : ($c->status === 'won' ? 'bg-volt-500/15 text-volt-700' : 'bg-ink-100 text-ink-500') }}">{{ $c->status }}</span>
                        </div>
                        <div class="truncate text-sm text-ink-500">{{ $c->email }} @if($c->service) · {{ $c->service }} @endif</div>
                    </div>
                    <span class="shrink-0 text-xs text-ink-400">{{ $c->created_at->format('d M, H:i') }}</span>
                </button>

                @if($openId === $c->id)
                    <div class="border-t border-ink-200 bg-ink-50 px-4 py-4 text-sm">
                        <div class="grid gap-2 sm:grid-cols-2">
                            <div><span class="text-ink-400">Phone:</span> <span class="text-ink-700">{{ $c->phone ?: '—' }}</span></div>
                            <div><span class="text-ink-400">Company:</span> <span class="text-ink-700">{{ $c->company ?: '—' }}</span></div>
                            <div><span class="text-ink-400">Service:</span> <span class="text-ink-700">{{ $c->service ?: '—' }}</span></div>
                            <div><span class="text-ink-400">Budget:</span> <span class="text-ink-700">{{ $c->budget ?: '—' }}</span></div>
                        </div>
                        <p class="mt-3 whitespace-pre-line rounded-lg border border-ink-200 bg-ink-50 p-3 text-ink-700">{{ $c->message }}</p>
                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            <span class="text-xs text-ink-400">Set status:</span>
                            @foreach($statuses as $st)
                                <button wire:click="setStatus({{ $c->id }}, '{{ $st }}')"
                                        class="rounded-full px-3 py-1 text-xs font-medium {{ $c->status === $st ? 'bg-ink-50 text-ink-900' : 'border border-ink-200 text-ink-500 hover:text-ink-900' }}">{{ ucfirst($st) }}</button>
                            @endforeach
                            <a href="mailto:{{ $c->email }}" class="ml-auto rounded-lg border border-ink-200 px-3 py-1 text-xs text-volt-600">Reply</a>
                            <button wire:click="delete({{ $c->id }})" wire:confirm="Delete this lead?" class="rounded-lg border border-ink-200 px-3 py-1 text-xs text-flame-600">Delete</button>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="rounded-2xl border border-ink-200 bg-ink-50 py-16 text-center text-ink-400">No leads yet.</div>
        @endforelse
    </div>

    <div class="mt-5">{{ $items->links() }}</div>
</div>
