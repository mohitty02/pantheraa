@php
    $total     = \App\Models\Learning::count();
    $published = \App\Models\Learning::where('status', 'published')->count();
    $drafts    = \App\Models\Learning::where('status', 'draft')->count();
    $views     = (int) \App\Models\Learning::sum('views');
    $recent    = \App\Models\Learning::latest()->take(5)->get();
@endphp

<x-admin-layout title="Dashboard">
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach([
            ['label' => 'Total learnings', 'value' => $total],
            ['label' => 'Published', 'value' => $published],
            ['label' => 'Drafts', 'value' => $drafts],
            ['label' => 'Total views', 'value' => number_format($views)],
        ] as $stat)
            <div class="card">
                <div class="font-display text-3xl font-bold text-white">{{ $stat['value'] }}</div>
                <div class="mt-1 text-sm text-white/50">{{ $stat['label'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 flex items-center justify-between">
        <h2 class="text-xl">Recent</h2>
        <a href="/admin/learnings/create" class="btn-primary"><x-icon name="bolt" class="h-4 w-4" /> New learning</a>
    </div>

    <div class="mt-4 divide-y divide-white/5 overflow-hidden rounded-2xl border border-white/10">
        @forelse($recent as $l)
            <a href="/admin/learnings/{{ $l->id }}/edit" class="flex items-center justify-between px-5 py-4 hover:bg-white/[0.02]">
                <div>
                    <div class="font-medium text-white">{{ $l->title }}</div>
                    <div class="text-xs text-white/40">{{ $l->category ?: 'Uncategorized' }} · {{ optional($l->created_at)->format('d M Y') }}</div>
                </div>
                <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $l->status === 'published' ? 'bg-volt-500/15 text-volt-300' : 'bg-white/10 text-white/60' }}">{{ ucfirst($l->status) }}</span>
            </a>
        @empty
            <div class="px-5 py-12 text-center text-white/45">No learnings yet. <a href="/admin/learnings/create" class="text-volt-400">Write your first →</a></div>
        @endforelse
    </div>
</x-admin-layout>
