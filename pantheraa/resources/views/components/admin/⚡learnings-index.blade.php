<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Learning;

new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filter = 'all';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilter() { $this->resetPage(); }

    public function togglePublish(int $id): void
    {
        $l = Learning::findOrFail($id);
        if ($l->status === 'published') {
            $l->update(['status' => 'draft']);
        } else {
            $l->update(['status' => 'published', 'published_at' => $l->published_at ?? now()]);
        }
    }

    public function delete(int $id): void
    {
        Learning::findOrFail($id)->delete();
        $this->dispatch('toast', message: 'Learning deleted.');
    }

    public function with(): array
    {
        $items = Learning::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->filter !== 'all', fn ($q) => $q->where('status', $this->filter))
            ->latest()
            ->paginate(10);

        return [
            'items' => $items,
            'counts' => [
                'all'       => Learning::count(),
                'published' => Learning::where('status', 'published')->count(),
                'draft'     => Learning::where('status', 'draft')->count(),
            ],
        ];
    }
}; ?>

<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl">Learnings</h2>
            <p class="mt-1 text-sm text-ink-500">{{ $counts['all'] }} total · {{ $counts['published'] }} live · {{ $counts['draft'] }} drafts</p>
        </div>
        <a href="/admin/learnings/create" class="btn-primary">
            <x-icon name="bolt" class="h-4 w-4" /> New learning
        </a>
    </div>

    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
        <div class="relative flex-1">
            <input type="search" wire:model.live.debounce.300ms="search" placeholder="Search by title…"
                   class="w-full rounded-xl border border-ink-200 bg-ink-50 px-4 py-2.5 text-sm text-ink-900 placeholder-ink-400 outline-none focus:border-volt-500">
        </div>
        <div class="flex gap-1 rounded-xl border border-ink-200 bg-ink-50 p-1 text-sm">
            @foreach(['all' => 'All', 'published' => 'Live', 'draft' => 'Drafts'] as $k => $label)
                <button wire:click="$set('filter', '{{ $k }}')"
                        class="rounded-lg px-3 py-1.5 font-medium transition-colors {{ $filter === $k ? 'bg-ink-100 text-ink-900' : 'text-ink-500 hover:text-ink-900' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="mt-5 overflow-hidden rounded-2xl border border-ink-200">
        <table class="w-full text-left text-sm">
            <thead class="bg-ink-50 text-xs uppercase tracking-wider text-ink-400">
                <tr>
                    <th class="px-4 py-3 font-semibold">Title</th>
                    <th class="hidden px-4 py-3 font-semibold sm:table-cell">Category</th>
                    <th class="hidden px-4 py-3 font-semibold md:table-cell">Date</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-ink-100">
                @forelse($items as $l)
                    <tr class="hover:bg-ink-50" wire:key="row-{{ $l->id }}">
                        <td class="px-4 py-3">
                            <a href="/admin/learnings/{{ $l->id }}/edit" class="font-medium text-ink-900 hover:text-volt-600">{{ $l->title }}</a>
                            <div class="text-xs text-ink-400">/{{ $l->slug }}</div>
                        </td>
                        <td class="hidden px-4 py-3 text-ink-500 sm:table-cell">{{ $l->category ?: '—' }}</td>
                        <td class="hidden px-4 py-3 text-ink-500 md:table-cell">{{ optional($l->published_at ?? $l->created_at)->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <button wire:click="togglePublish({{ $l->id }})"
                                    class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold {{ $l->status === 'published' ? 'bg-volt-500/15 text-volt-700' : 'bg-ink-100 text-ink-500' }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $l->status === 'published' ? 'bg-volt-500' : 'bg-ink-300' }}"></span>
                                {{ $l->status === 'published' ? 'Live' : 'Draft' }}
                            </button>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/admin/learnings/{{ $l->id }}/edit" class="rounded-lg border border-ink-200 px-2.5 py-1 text-xs text-ink-600 hover:text-ink-900">Edit</a>
                                <button wire:click="delete({{ $l->id }})" wire:confirm="Delete this learning?"
                                        class="rounded-lg border border-ink-200 px-2.5 py-1 text-xs text-flame-600 hover:bg-flame-500/10">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-12 text-center text-ink-400">No learnings yet. Write your first one →</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $items->links() }}</div>
</div>
