<?php

use Livewire\Component;
use App\Models\Contact;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $company = '';
    public string $service = '';
    public string $budget = '';
    public string $message = '';

    public bool $sent = false;

    protected function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:120'],
            'email'   => ['required', 'email:rfc', 'max:160'],
            'phone'   => ['nullable', 'string', 'max:40'],
            'company' => ['nullable', 'string', 'max:160'],
            'service' => ['nullable', 'string', 'max:120'],
            'budget'  => ['nullable', 'string', 'max:60'],
            'message' => ['required', 'string', 'min:10', 'max:4000'],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required'    => 'Please tell us your name.',
            'email.required'   => 'We need an email to reply to you.',
            'email.email'      => 'That email address looks off.',
            'message.required' => 'A short brief helps us help you.',
            'message.min'      => 'Add a little more detail (10+ characters).',
        ];
    }

    public function submit(): void
    {
        $data = $this->validate();

        Contact::create([
            ...$data,
            'status' => 'new',
            'ip'     => request()->ip(),
        ]);

        // Mail::to(config('site.email'))->send(...);  // wire up a Mailable when SMTP is ready

        $this->reset(['name', 'email', 'phone', 'company', 'service', 'budget', 'message']);
        $this->sent = true;
        $this->dispatch('contact-sent');
    }
}; ?>

<div class="relative">
    @if ($sent)
        <div data-reveal class="card flex flex-col items-center gap-4 py-14 text-center" role="status">
            <span class="grid h-16 w-16 place-items-center rounded-full bg-gradient-to-br from-flame-500 to-volt-500 text-white">
                <x-icon name="check" class="h-8 w-8" />
            </span>
            <h3 class="text-2xl">Message received. 🐾</h3>
            <p class="max-w-sm text-ink-500">
                Thanks — our team will reply within one business day with your free growth audit.
            </p>
            <button type="button" wire:click="$set('sent', false)" class="btn-ghost mt-2">
                Send another message
            </button>
        </div>
    @else
        <form wire:submit="submit" class="card space-y-5" novalidate>
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="cf-name" class="mb-1.5 block text-sm font-medium text-ink-700">Name <span class="text-flame-600">*</span></label>
                    <input id="cf-name" type="text" wire:model="name" autocomplete="name"
                           class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-ink-900 placeholder-ink-400 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500"
                           placeholder="Jane Cooper">
                    @error('name') <p class="mt-1.5 text-xs text-flame-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="cf-email" class="mb-1.5 block text-sm font-medium text-ink-700">Email <span class="text-flame-600">*</span></label>
                    <input id="cf-email" type="email" wire:model="email" autocomplete="email"
                           class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-ink-900 placeholder-ink-400 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500"
                           placeholder="jane@company.com">
                    @error('email') <p class="mt-1.5 text-xs text-flame-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="cf-phone" class="mb-1.5 block text-sm font-medium text-ink-700">Phone</label>
                    <input id="cf-phone" type="tel" wire:model="phone" autocomplete="tel"
                           class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-ink-900 placeholder-ink-400 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500"
                           placeholder="+91 98765 43210">
                    @error('phone') <p class="mt-1.5 text-xs text-flame-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="cf-company" class="mb-1.5 block text-sm font-medium text-ink-700">Company</label>
                    <input id="cf-company" type="text" wire:model="company" autocomplete="organization"
                           class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-ink-900 placeholder-ink-400 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500"
                           placeholder="Acme Inc.">
                </div>
                <div>
                    <label for="cf-service" class="mb-1.5 block text-sm font-medium text-ink-700">Service of interest</label>
                    <select id="cf-service" wire:model="service"
                            class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-ink-900 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500">
                        <option value="" class="bg-ink-50">Select a service</option>
                        @foreach(config('site.services') as $s)
                            <option value="{{ $s['name'] }}" class="bg-ink-50">{{ $s['name'] }}</option>
                        @endforeach
                        <option value="Not sure yet" class="bg-ink-50">Not sure yet</option>
                    </select>
                </div>
                <div>
                    <label for="cf-budget" class="mb-1.5 block text-sm font-medium text-ink-700">Monthly budget</label>
                    <select id="cf-budget" wire:model="budget"
                            class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-ink-900 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500">
                        <option value="" class="bg-ink-50">Select a range</option>
                        @foreach(['< $1k', '$1k – $5k', '$5k – $15k', '$15k+'] as $b)
                            <option value="{{ $b }}" class="bg-ink-50">{{ $b }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="cf-message" class="mb-1.5 block text-sm font-medium text-ink-700">Project brief <span class="text-flame-600">*</span></label>
                <textarea id="cf-message" rows="4" wire:model="message"
                          class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-ink-900 placeholder-ink-400 outline-none transition focus:border-volt-500 focus:ring-1 focus:ring-volt-500"
                          placeholder="Tell us about your goals, current channels and timeline…"></textarea>
                @error('message') <p class="mt-1.5 text-xs text-flame-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-primary w-full sm:w-auto" wire:loading.attr="disabled" wire:target="submit">
                <span wire:loading.remove wire:target="submit" class="inline-flex items-center gap-2">
                    Send message
                    <x-icon name="arrow" class="h-4 w-4" />
                </span>
                <span wire:loading wire:target="submit" class="inline-flex items-center gap-2">
                    <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" opacity="0.25"/>
                        <path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                    Sending…
                </span>
            </button>

            {{-- CRO: kill the last objections right at the submit button --}}
            <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-ink-500">
                <span class="flex items-center gap-1.5"><x-icon name="shield" class="h-4 w-4 text-flame-600" /> Your details stay private — no spam</span>
                <span class="flex items-center gap-1.5"><x-icon name="bolt" class="h-4 w-4 text-flame-600" /> Reply within 1 business day</span>
                <span class="flex items-center gap-1.5"><x-icon name="check" class="h-4 w-4 text-flame-600" /> Free audit, no obligation</span>
            </div>
        </form>
    @endif
</div>
