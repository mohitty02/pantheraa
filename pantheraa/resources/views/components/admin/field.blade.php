@props(['wire' => '', 'label' => '', 'type' => 'text', 'ph' => ''])

<div>
    <label class="mb-1.5 block text-sm font-medium text-ink-700">{{ $label }}</label>
    @if($type === 'textarea')
        <textarea wire:model="{{ $wire }}" rows="3" placeholder="{{ $ph }}"
                  class="w-full rounded-xl border border-ink-200 bg-ink-50 px-4 py-2.5 text-sm text-ink-900 placeholder-ink-400 outline-none focus:border-volt-500"></textarea>
    @else
        <input type="text" wire:model="{{ $wire }}" placeholder="{{ $ph }}"
               class="w-full rounded-xl border border-ink-200 bg-ink-50 px-4 py-2.5 text-sm text-ink-900 placeholder-ink-400 outline-none focus:border-volt-500">
    @endif
    @error($wire) <p class="mt-1 text-xs text-flame-600">{{ $message }}</p> @enderror
</div>
