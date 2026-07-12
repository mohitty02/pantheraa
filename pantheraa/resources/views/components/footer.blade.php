@php $s = config('site'); @endphp

<footer class="relative overflow-hidden border-t border-ink-200 bg-ink-50">
    <div class="orb -left-20 bottom-0 h-72 w-72 bg-volt-600/20"></div>
    <div class="orb -right-20 top-0 h-72 w-72 bg-flame-600/20"></div>

    <div class="container-px relative py-16">
        <div class="grid gap-12 lg:grid-cols-12">
            {{-- Brand + newsletter --}}
            <div class="lg:col-span-5">
                <x-brand :showTagline="true" />
                <p class="mt-5 max-w-sm text-sm leading-relaxed text-ink-500">
                    {{ $s['short_desc'] }}
                </p>

                <div class="mt-7 max-w-sm">
                    <p class="text-sm font-semibold text-ink-900">Get growth insights — no spam.</p>
                    <livewire:newsletter-form />
                </div>
            </div>

            {{-- Services --}}
            <div class="lg:col-span-3">
                <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-steel-600">Services</h3>
                <ul class="mt-5 space-y-3 text-sm">
                    @foreach($s['services'] as $service)
                        <li>
                            <a href="/services/{{ $service['slug'] }}" wire:navigate
                               class="text-ink-500 transition-colors hover:text-ink-900">{{ $service['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Company --}}
            <div class="lg:col-span-2">
                <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-steel-600">Company</h3>
                <ul class="mt-5 space-y-3 text-sm">
                    <li><a href="/about" wire:navigate class="text-ink-500 transition-colors hover:text-ink-900">About</a></li>
                    <li><a href="/learnings" wire:navigate class="text-ink-500 transition-colors hover:text-ink-900">Learnings</a></li>
                    <li><a href="/portfolio" wire:navigate class="text-ink-500 transition-colors hover:text-ink-900">Portfolio</a></li>
                    <li><a href="/#faq" wire:navigate class="text-ink-500 transition-colors hover:text-ink-900">FAQ</a></li>
                    <li><a href="/contact" wire:navigate class="text-ink-500 transition-colors hover:text-ink-900">Contact</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="lg:col-span-2">
                <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-steel-600">Reach us</h3>
                <ul class="mt-5 space-y-3 text-sm text-ink-500">
                    <li><a href="mailto:{{ $s['email'] }}" class="transition-colors hover:text-ink-900">{{ $s['email'] }}</a></li>
                    <li><a href="tel:{{ $s['phone_link'] }}" class="transition-colors hover:text-ink-900">{{ $s['phone'] }}</a></li>
                    <li class="text-ink-400">{{ $s['address']['locality'] }}, {{ $s['address']['region'] }}</li>
                </ul>

                <div class="mt-5 flex items-center gap-2">
                    @foreach(['linkedin' => 'linkedin', 'instagram' => 'instagram', 'x' => 'x', 'youtube' => 'youtube'] as $key => $icon)
                        <a href="{{ $s['social'][$key] }}" target="_blank" rel="noopener noreferrer"
                           class="grid h-9 w-9 place-items-center rounded-lg border border-ink-200 bg-ink-50 text-ink-600 transition-colors hover:border-ink-400 hover:text-ink-900"
                           aria-label="{{ ucfirst($key) }}">
                            <x-icon :name="$icon" class="h-5 w-5" />
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="hairline mt-14"></div>

        <div class="mt-7 flex flex-col items-center justify-between gap-4 text-xs text-ink-400 sm:flex-row">
            <p>&copy; {{ date('Y') }} {{ $s['legal_name'] }}. All rights reserved.</p>
            <div class="flex items-center gap-5">
                <a href="/privacy" wire:navigate class="transition-colors hover:text-ink-900">Privacy Policy</a>
                <a href="/terms" wire:navigate class="transition-colors hover:text-ink-900">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
