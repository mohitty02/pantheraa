<?php

use Livewire\Component;
use App\Models\Service;

new class extends Component
{
    public function toggleActive(int $id): void
    {
        $s = Service::findOrFail($id);
        $s->update(['is_active' => ! $s->is_active]);
    }

    public function toggleFeatured(int $id): void
    {
        $s = Service::findOrFail($id);
        $s->update(['featured' => ! $s->featured]);
    }

    public function delete(int $id): void
    {
        Service::findOrFail($id)->delete();
    }

    public function move(int $id, string $dir): void
    {
        $ids = Service::orderBy('sort')->orderBy('id')->pluck('id')->all();
        $i = array_search($id, $ids, true);
        $j = $dir === 'up' ? $i - 1 : $i + 1;
        if ($i === false || $j < 0 || $j >= count($ids)) {
            return;
        }
        [$ids[$i], $ids[$j]] = [$ids[$j], $ids[$i]];
        foreach ($ids as $pos => $rid) {
            Service::where('id', $rid)->update(['sort' => $pos]);
        }
    }

    public function with(): array
    {
        return ['items' => Service::orderBy('sort')->orderBy('id')->get()];
    }
}; ?>

<div>
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl">Services</h2>
            <p class="mt-1 text-sm text-white/50">{{ $items->count() }} services · shown across the site, dropdown, schema &amp; detail pages</p>
        </div>
        <a href="/admin/services/create" class="btn-primary"><x-icon name="bolt" class="h-4 w-4" /> New service</a>
    </div>

    <div class="mt-5 overflow-hidden rounded-2xl border border-white/10">
        <table class="w-full text-left text-sm">
            <thead class="bg-white/[0.03] text-xs uppercase tracking-wider text-white/45">
                <tr>
                    <th class="px-4 py-3 font-semibold">Service</th>
                    <th class="hidden px-4 py-3 font-semibold sm:table-cell">Slug</th>
                    <th class="px-4 py-3 font-semibold">Featured</th>
                    <th class="px-4 py-3 font-semibold">Active</th>
                    <th class="px-4 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($items as $s)
                    <tr class="hover:bg-white/[0.02]" wire:key="svc-{{ $s->id }}">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                <span class="grid h-8 w-8 place-items-center rounded-lg border border-white/10 bg-gradient-to-br from-flame-500/20 to-volt-500/20 text-white">
                                    <x-icon :name="$s->icon" class="h-4 w-4" />
                                </span>
                                <a href="/admin/services/{{ $s->id }}/edit" class="font-medium text-white hover:text-volt-400">{{ $s->name }}</a>
                            </div>
                        </td>
                        <td class="hidden px-4 py-3 text-white/50 sm:table-cell">/{{ $s->slug }}</td>
                        <td class="px-4 py-3">
                            <button wire:click="toggleFeatured({{ $s->id }})" class="text-xs font-semibold {{ $s->featured ? 'text-flame-400' : 'text-white/40' }}">{{ $s->featured ? '★ Featured' : '☆' }}</button>
                        </td>
                        <td class="px-4 py-3">
                            <button wire:click="toggleActive({{ $s->id }})"
                                    class="inline-flex h-5 w-9 items-center rounded-full p-0.5 transition-colors {{ $s->is_active ? 'bg-volt-500' : 'bg-white/15' }}">
                                <span class="h-4 w-4 rounded-full bg-white transition-transform {{ $s->is_active ? 'translate-x-4' : '' }}"></span>
                            </button>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-1.5">
                                <button wire:click="move({{ $s->id }}, 'up')" class="rounded-lg border border-white/10 px-2 py-1 text-xs text-white/60 hover:text-white">↑</button>
                                <button wire:click="move({{ $s->id }}, 'down')" class="rounded-lg border border-white/10 px-2 py-1 text-xs text-white/60 hover:text-white">↓</button>
                                <a href="/admin/services/{{ $s->id }}/edit" class="rounded-lg border border-white/10 px-2.5 py-1 text-xs text-white/70 hover:text-white">Edit</a>
                                <button wire:click="delete({{ $s->id }})" wire:confirm="Delete this service?" class="rounded-lg border border-white/10 px-2.5 py-1 text-xs text-flame-400 hover:bg-flame-500/10">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-12 text-center text-white/45">No services yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
