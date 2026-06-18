@props(['wire' => '', 'label' => '', 'type' => 'text', 'ph' => ''])

<div>
    <label class="mb-1.5 block text-sm font-medium text-white/80">{{ $label }}</label>
    @if($type === 'textarea')
        <textarea wire:model="{{ $wire }}" rows="3" placeholder="{{ $ph }}"
                  class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-2.5 text-sm text-white placeholder-white/30 outline-none focus:border-volt-500"></textarea>
    @else
        <input type="text" wire:model="{{ $wire }}" placeholder="{{ $ph }}"
               class="w-full rounded-xl border border-white/10 bg-ink-900 px-4 py-2.5 text-sm text-white placeholder-white/30 outline-none focus:border-volt-500">
    @endif
    @error($wire) <p class="mt-1 text-xs text-flame-400">{{ $message }}</p> @enderror
</div>
