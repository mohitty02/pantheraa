@php
    $phone = preg_replace('/\D/', '', (string) config('site.phone_link'));
    $msg   = urlencode('Hi Pantheraa Space, I need help with my website / ads / SEO.');
@endphp

@if($phone)
    {{-- CRO: on mobile (where most Indian traffic is) the fastest path to a lead
         is a thumb-reachable bar that is always visible. Three intents, one tap. --}}
    <div class="fixed inset-x-0 bottom-0 z-50 border-t border-ink-200 bg-white/95 backdrop-blur-xl sm:hidden"
         style="padding-bottom: env(safe-area-inset-bottom);">
        <div class="grid grid-cols-3 divide-x divide-ink-200">
            <a href="tel:+{{ $phone }}"
               class="flex flex-col items-center justify-center gap-1 py-3 text-ink-700 active:bg-ink-50">
                <x-icon name="phone" class="h-5 w-5" />
                <span class="text-[11px] font-semibold">Call</span>
            </a>

            <a href="https://wa.me/{{ $phone }}?text={{ $msg }}" target="_blank" rel="noopener"
               class="flex flex-col items-center justify-center gap-1 py-3 text-[#128C4A] active:bg-ink-50">
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor" aria-hidden="true">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884a9.82 9.82 0 0 1 6.988 2.896 9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.885-9.885 9.885m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413"/>
                </svg>
                <span class="text-[11px] font-semibold">WhatsApp</span>
            </a>

            <a href="/contact" wire:navigate
               class="flex flex-col items-center justify-center gap-1 bg-gradient-to-r from-flame-500 to-volt-500 py-3 text-white">
                <x-icon name="bolt" class="h-5 w-5" />
                <span class="text-[11px] font-semibold">Free audit</span>
            </a>
        </div>
    </div>

    {{-- keep the sticky bar from covering the last bit of page content --}}
    <div class="h-16 sm:hidden" aria-hidden="true"></div>
@endif
