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
                <div class="font-display text-3xl font-bold text-ink-900">{{ $stat['value'] }}</div>
                <div class="mt-1 text-sm text-ink-500">{{ $stat['label'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 flex items-center justify-between">
        <h2 class="text-xl">Recent</h2>
        <a href="/admin/learnings/create" class="btn-primary"><x-icon name="bolt" class="h-4 w-4" /> New learning</a>
    </div>

    <div class="mt-4 divide-y divide-ink-100 overflow-hidden rounded-2xl border border-ink-200">
        @forelse($recent as $l)
            <a href="/admin/learnings/{{ $l->id }}/edit" class="flex items-center justify-between px-5 py-4 hover:bg-ink-50">
                <div>
                    <div class="font-medium text-ink-900">{{ $l->title }}</div>
                    <div class="text-xs text-ink-400">{{ $l->category ?: 'Uncategorized' }} · {{ optional($l->created_at)->format('d M Y') }}</div>
                </div>
                <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $l->status === 'published' ? 'bg-volt-500/15 text-volt-700' : 'bg-ink-100 text-ink-500' }}">{{ ucfirst($l->status) }}</span>
            </a>
        @empty
            <div class="px-5 py-12 text-center text-ink-400">No learnings yet. <a href="/admin/learnings/create" class="text-volt-600">Write your first →</a></div>
        @endforelse
    </div>
</x-admin-layout>
