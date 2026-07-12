<?php

use Livewire\Component;
use App\Models\Subscriber;

new class extends Component
{
    public string $email = '';
    public bool $done = false;

    public function subscribe(): void
    {
        $data = $this->validate([
            'email' => ['required', 'email:rfc', 'max:160'],
        ]);

        Subscriber::firstOrCreate(
            ['email' => strtolower($data['email'])],
            ['ip' => request()->ip()]
        );

        $this->reset('email');
        $this->done = true;
    }
}; ?>

<div class="mt-3">
    @if ($done)
        <p class="flex items-center gap-2 rounded-xl border border-volt-500/30 bg-volt-500/10 px-4 py-3 text-sm text-ink-900">
            <x-icon name="check" class="h-4 w-4 text-volt-600" />
            You're in. Watch your inbox.
        </p>
    @else
        <form wire:submit="subscribe" class="flex flex-col gap-2 sm:flex-row">
            <div class="flex-1">
                <label for="nl-email" class="sr-only">Email address</label>
                <input id="nl-email" type="email" wire:model="email" placeholder="you@email.com"
                       class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-sm text-ink-900 placeholder-ink-400 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500">
                @error('email') <p class="mt-1 text-xs text-flame-600">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="btn-primary shrink-0" wire:loading.attr="disabled" wire:target="subscribe">
                <span wire:loading.remove wire:target="subscribe">Subscribe</span>
                <span wire:loading wire:target="subscribe">…</span>
            </button>
        </form>
    @endif
</div>
