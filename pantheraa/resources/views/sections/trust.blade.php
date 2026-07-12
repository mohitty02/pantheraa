@php
    // CRO: risk-reversal signals placed immediately under the hero, where
    // the visitor's first objection ("can I trust these people?") appears.
    // These are PROMISES you must be able to keep — not invented social proof.
    $markers = config('site.trust.markers', []) ?: [
        ['icon' => 'shield', 'title' => 'Free audit, no obligation', 'note' => 'We show you the gaps before you pay anything.'],
        ['icon' => 'check',  'title' => 'No lock-in contracts',      'note' => 'Stay because it works, not because you signed.'],
        ['icon' => 'bolt',   'title' => 'Reply in 1 business day',   'note' => 'Real humans, on WhatsApp or email.'],
        ['icon' => 'gauge',  'title' => 'Transparent reporting',     'note' => 'You see exactly what we did and what it returned.'],
    ];
    $badges = config('site.trust.badges', []);
@endphp

<section aria-label="Why you can trust us" class="border-y border-ink-200 bg-ink-50">
    <div class="container-px py-8">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
            @foreach($markers as $m)
                <div class="flex items-start gap-3">
                    <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-lg border border-ink-200 bg-white text-flame-600">
                        <x-icon :name="$m['icon'] ?? 'check'" class="h-5 w-5" />
                    </span>
                    <div>
                        <div class="text-sm font-semibold text-ink-900">{{ $m['title'] }}</div>
                        @if(!empty($m['note']))
                            <div class="mt-0.5 text-xs leading-snug text-ink-500">{{ $m['note'] }}</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Partner / certification badges — only ever show REAL ones --}}
        @if(!empty($badges))
            <div class="mt-7 flex flex-wrap items-center justify-center gap-x-8 gap-y-3 border-t border-ink-200 pt-6">
                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-ink-400">Certified &amp; partnered with</span>
                @foreach($badges as $b)
                    <span class="text-sm font-semibold text-ink-600">{{ is_array($b) ? ($b['label'] ?? '') : $b }}</span>
                @endforeach
            </div>
        @endif
    </div>
</section>
