<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subscriber;

new class extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch() { $this->resetPage(); }

    public function delete(int $id): void
    {
        Subscriber::findOrFail($id)->delete();
    }

    public function with(): array
    {
        return [
            'items' => Subscriber::query()
                ->when($this->search, fn ($q) => $q->where('email', 'like', "%{$this->search}%"))
                ->latest()->paginate(20),
            'total' => Subscriber::count(),
        ];
    }
}; ?>

<div>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl">Subscribers</h2>
            <p class="mt-1 text-sm text-ink-500">{{ $total }} newsletter subscribers</p>
        </div>
        <input type="search" wire:model.live.debounce.300ms="search" placeholder="Search email…"
               class="rounded-xl border border-ink-200 bg-ink-50 px-4 py-2.5 text-sm text-ink-900 placeholder-ink-400 outline-none focus:border-volt-500">
    </div>

    <div class="mt-5 overflow-hidden rounded-2xl border border-ink-200">
        <table class="w-full text-left text-sm">
            <thead class="bg-ink-50 text-xs uppercase tracking-wider text-ink-400">
                <tr>
                    <th class="px-4 py-3 font-semibold">Email</th>
                    <th class="hidden px-4 py-3 font-semibold sm:table-cell">Subscribed</th>
                    <th class="px-4 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-ink-100">
                @forelse($items as $sub)
                    <tr class="hover:bg-ink-50" wire:key="sub-{{ $sub->id }}">
                        <td class="px-4 py-3 text-ink-700">{{ $sub->email }}</td>
                        <td class="hidden px-4 py-3 text-ink-500 sm:table-cell">{{ $sub->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-4 py-3 text-right">
                            <button wire:click="delete({{ $sub->id }})" wire:confirm="Remove this subscriber?" class="rounded-lg border border-ink-200 px-2.5 py-1 text-xs text-flame-600 hover:bg-flame-500/10">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-4 py-12 text-center text-ink-400">No subscribers yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $items->links() }}</div>
</div>
