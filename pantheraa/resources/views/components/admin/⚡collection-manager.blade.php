<?php

use Livewire\Component;

new class extends Component
{
    public string $type;
    public ?int $editingId = null;
    public bool $showForm = false;
    public array $form = [];

    public function mount(string $type): void
    {
        abort_unless(config("cms.collections.$type"), 404);
        $this->type = $type;
        $this->resetForm();
    }

    public function schema(): array
    {
        return config("cms.collections.{$this->type}");
    }

    private function modelClass(): string
    {
        return $this->schema()['model'];
    }

    private function resetForm(): void
    {
        $this->form = [];
        foreach ($this->schema()['fields'] as $f) {
            // select fields default to their first option so required selects validate
            $this->form[$f['key']] = $f['type'] === 'select' ? ($f['options'][0] ?? '') : '';
        }
        $this->editingId = null;
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $m = $this->modelClass()::findOrFail($id);
        foreach ($this->schema()['fields'] as $f) {
            $val = $m->{$f['key']};
            if ($f['type'] === 'tags') {
                $this->form[$f['key']] = implode(', ', (array) ($val ?? []));
            } elseif ($f['type'] === 'json') {
                $this->form[$f['key']] = $val ? json_encode($val, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '';
            } else {
                $this->form[$f['key']] = $val;
            }
        }
        $this->editingId = $id;
        $this->showForm = true;
    }

    public function save(): void
    {
        $rules = [];
        $attrs = [];
        foreach ($this->schema()['fields'] as $f) {
            $rules["form.{$f['key']}"] = $f['rules'] ?? 'nullable';
            $attrs["form.{$f['key']}"] = strtolower($f['label']);
        }
        $this->validate($rules, [], $attrs);

        $data = [];
        foreach ($this->schema()['fields'] as $f) {
            $val = $this->form[$f['key']] ?? null;
            if ($f['type'] === 'tags') {
                $val = collect(explode(',', (string) $val))->map(fn ($t) => trim($t))->filter()->values()->all();
            } elseif ($f['type'] === 'json') {
                $decoded = json_decode((string) $val, true);
                if ((string) $val !== '' && json_last_error() !== JSON_ERROR_NONE) {
                    $this->addError("form.{$f['key']}", 'Invalid JSON: ' . json_last_error_msg());

                    return;
                }
                $val = $decoded;
            }
            $data[$f['key']] = $val;
        }

        $model = $this->modelClass();
        try {
            if ($this->editingId) {
                $model::findOrFail($this->editingId)->update($data);
            } else {
                $data['sort'] = (int) $model::max('sort') + 1;
                $model::create($data);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $this->addError('form.' . $this->schema()['fields'][0]['key'], 'Could not save — a value may need to be unique.');

            return;
        }

        $this->showForm = false;
        $this->resetForm();
        $this->dispatch('saved');
    }

    public function toggleActive(int $id): void
    {
        $m = $this->modelClass()::findOrFail($id);
        $m->update(['is_active' => ! $m->is_active]);
    }

    public function delete(int $id): void
    {
        $this->modelClass()::findOrFail($id)->delete();
    }

    public function move(int $id, string $dir): void
    {
        $model = $this->modelClass();
        $ids = $model::orderBy('sort')->orderBy('id')->pluck('id')->all();
        $i = array_search($id, $ids, true);
        $j = $dir === 'up' ? $i - 1 : $i + 1;
        if ($i === false || $j < 0 || $j >= count($ids)) {
            return;
        }
        [$ids[$i], $ids[$j]] = [$ids[$j], $ids[$i]];
        foreach ($ids as $pos => $rid) {
            $model::where('id', $rid)->update(['sort' => $pos]);
        }
    }

    public function with(): array
    {
        $model = $this->modelClass();

        return ['items' => $model::orderBy('sort')->orderBy('id')->get()];
    }
}; ?>

<div>
    @php $schema = $this->schema(); @endphp

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl">{{ $schema['title'] }}</h2>
            <p class="mt-1 text-sm text-white/50">{{ $items->count() }} {{ \Illuminate\Support\Str::plural($schema['singular'], $items->count()) }} · drag-free reorder with ↑ ↓</p>
        </div>
        <button wire:click="create" class="btn-primary"><x-icon name="bolt" class="h-4 w-4" /> Add</button>
    </div>

    {{-- Editor panel --}}
    @if($showForm)
        <div class="card mt-5">
            <h3 class="text-lg">{{ $editingId ? 'Edit' : 'New' }} {{ $schema['singular'] }}</h3>
            <div class="mt-4 space-y-4">
                @foreach($schema['fields'] as $f)
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-white/80">{{ $f['label'] }}</label>
                        @if($f['type'] === 'textarea')
                            <textarea wire:model="form.{{ $f['key'] }}" rows="3"
                                      class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-2.5 text-sm text-white outline-none focus:border-volt-500"></textarea>
                        @elseif($f['type'] === 'json')
                            <textarea wire:model="form.{{ $f['key'] }}" rows="8" spellcheck="false"
                                      class="w-full rounded-xl border border-white/10 bg-ink-950 px-4 py-2.5 font-mono text-xs text-white outline-none focus:border-volt-500"
                                      placeholder='Paste a JSON-LD object, e.g. { "name": "Acme", "url": "https://…" }'></textarea>
                        @elseif($f['type'] === 'select')
                            <select wire:model="form.{{ $f['key'] }}"
                                    class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-2.5 text-sm text-white outline-none focus:border-volt-500">
                                @foreach(($f['options'] ?? []) as $opt)<option value="{{ $opt }}" class="bg-ink-900">{{ $opt }}</option>@endforeach
                            </select>
                        @else
                            <input type="text" wire:model="form.{{ $f['key'] }}"
                                   class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-2.5 text-sm text-white outline-none focus:border-volt-500">
                        @endif
                        @error('form.'.$f['key']) <p class="mt-1 text-xs text-flame-400">{{ $message }}</p> @enderror
                    </div>
                @endforeach
            </div>
            <div class="mt-5 flex gap-2">
                <button wire:click="save" class="btn-primary">Save</button>
                <button wire:click="$set('showForm', false)" class="btn-ghost">Cancel</button>
            </div>
        </div>
    @endif

    {{-- List --}}
    <div class="mt-5 overflow-hidden rounded-2xl border border-white/10">
        <table class="w-full text-left text-sm">
            <thead class="bg-white/[0.03] text-xs uppercase tracking-wider text-white/45">
                <tr>
                    @foreach($schema['columns'] as $col)
                        <th class="px-4 py-3 font-semibold">{{ \Illuminate\Support\Str::headline($col) }}</th>
                    @endforeach
                    <th class="px-4 py-3 font-semibold">Active</th>
                    <th class="px-4 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($items as $row)
                    <tr class="align-top hover:bg-white/[0.02]" wire:key="row-{{ $row->id }}">
                        @foreach($schema['columns'] as $col)
                            <td class="px-4 py-3 text-white/80">{{ \Illuminate\Support\Str::limit((string) $row->{$col}, 70) ?: '—' }}</td>
                        @endforeach
                        <td class="px-4 py-3">
                            <button wire:click="toggleActive({{ $row->id }})"
                                    class="inline-flex h-5 w-9 items-center rounded-full p-0.5 transition-colors {{ $row->is_active ? 'bg-volt-500' : 'bg-white/15' }}">
                                <span class="h-4 w-4 rounded-full bg-white transition-transform {{ $row->is_active ? 'translate-x-4' : '' }}"></span>
                            </button>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-1.5">
                                <button wire:click="move({{ $row->id }}, 'up')" class="rounded-lg border border-white/10 px-2 py-1 text-xs text-white/60 hover:text-white">↑</button>
                                <button wire:click="move({{ $row->id }}, 'down')" class="rounded-lg border border-white/10 px-2 py-1 text-xs text-white/60 hover:text-white">↓</button>
                                <button wire:click="edit({{ $row->id }})" class="rounded-lg border border-white/10 px-2.5 py-1 text-xs text-white/70 hover:text-white">Edit</button>
                                <button wire:click="delete({{ $row->id }})" wire:confirm="Delete this {{ $schema['singular'] }}?" class="rounded-lg border border-white/10 px-2.5 py-1 text-xs text-flame-400 hover:bg-flame-500/10">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ count($schema['columns']) + 2 }}" class="px-4 py-12 text-center text-white/45">Nothing yet. Click “Add”.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
