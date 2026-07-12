@php $stats = config('site.stats'); @endphp

<section class="relative overflow-hidden border-y border-ink-200 bg-ink-50 py-16">
    <div class="orb left-1/2 top-0 h-60 w-[40rem] -translate-x-1/2 bg-volt-600/10"></div>
    <div class="container-px relative">
        <div class="grid grid-cols-2 gap-y-10 lg:grid-cols-4" data-stagger>
            @foreach($stats as $stat)
                <div class="text-center">
                    <div class="font-display text-4xl font-bold sm:text-5xl">
                        <span class="text-gradient"><span data-counter="{{ $stat['value'] }}">{{ $stat['value'] }}</span>{{ $stat['suffix'] }}</span>
                    </div>
                    <div class="mt-2 text-sm text-ink-500">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
