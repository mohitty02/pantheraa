<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = true;

    public function login()
    {
        $data = $this->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $this->remember)) {
            $this->addError('email', 'These credentials do not match our records.');

            return;
        }

        session()->regenerate();

        return $this->redirect('/admin', navigate: true);
    }
}; ?>

<div class="w-full max-w-sm">
    <div class="mb-8 flex justify-center">
        <x-brand size="lg" :showTagline="true" />
    </div>

    <form wire:submit="login" class="card space-y-5">
        <div>
            <h1 class="text-2xl">Welcome back</h1>
            <p class="mt-1 text-sm text-ink-500">Sign in to manage your Learnings.</p>
        </div>

        <div>
            <label for="email" class="mb-1.5 block text-sm font-medium text-ink-700">Email</label>
            <input id="email" type="email" wire:model="email" autocomplete="username" autofocus
                   class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-ink-900 placeholder-ink-400 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500"
                   placeholder="you@pantheraa.space">
            @error('email') <p class="mt-1.5 text-xs text-flame-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-sm font-medium text-ink-700">Password</label>
            <input id="password" type="password" wire:model="password" autocomplete="current-password"
                   class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-ink-900 placeholder-ink-400 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500"
                   placeholder="••••••••">
            @error('password') <p class="mt-1.5 text-xs text-flame-600">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2 text-sm text-ink-500">
            <input type="checkbox" wire:model="remember" class="rounded border-ink-300 bg-white text-volt-500 focus:ring-volt-500">
            Remember me
        </label>

        <button type="submit" class="btn-primary w-full" wire:loading.attr="disabled" wire:target="login">
            <span wire:loading.remove wire:target="login">Sign in</span>
            <span wire:loading wire:target="login">Signing in…</span>
        </button>
    </form>
</div>
