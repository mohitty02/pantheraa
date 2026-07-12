@php $testimonials = config('site.testimonials', []); @endphp

{{-- E-E-A-T: only ever show REAL testimonials. If there are none yet, show nothing —
     an empty section is honest; a fabricated one destroys trust (and can be detected). --}}
@if(!empty($testimonials))

<section class="section">
    <div class="container-px">
        <div class="mx-auto max-w-2xl text-center" data-reveal>
            <span class="kicker">Client love</span>
            <h2 class="mt-5 text-3xl sm:text-4xl lg:text-5xl">
                Trusted by founders &amp; <span class="text-gradient-flame">marketing leaders.</span>
            </h2>
        </div>

        <div class="mt-14 grid gap-5 lg:grid-cols-3" data-stagger>
            @foreach($testimonials as $t)
                <figure class="card flex flex-col justify-between">
                    <div>
                        <div class="text-flame-600" aria-hidden="true">★★★★★</div>
                        <blockquote class="mt-4 text-lg leading-relaxed text-ink-700">“{{ $t['quote'] }}”</blockquote>
                    </div>
                    <figcaption class="mt-7 flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-full bg-gradient-to-br from-flame-500 to-volt-500 font-display font-bold text-white">
                            {{ \Illuminate\Support\Str::of($t['name'])->explode(' ')->map(fn($w) => $w[0])->take(2)->implode('') }}
                        </span>
                        <span>
                            <span class="block text-sm font-semibold text-ink-900">{{ $t['name'] }}</span>
                            <span class="block text-xs text-ink-500">{{ $t['role'] }}</span>
                        </span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif
