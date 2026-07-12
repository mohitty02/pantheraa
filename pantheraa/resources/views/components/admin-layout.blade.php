@props(['title' => 'Admin'])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title }} · {{ config('site.name') }} Admin</title>

    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/jpeg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-white text-ink-600 antialiased">
    @auth
        <div x-data="{ nav: false }" class="flex min-h-screen">
            {{-- Sidebar --}}
            <aside class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full border-r border-ink-200 bg-ink-50 transition-transform lg:translate-x-0"
                   :class="nav ? 'translate-x-0' : '-translate-x-full'">
                <div class="flex h-18 items-center border-b border-ink-200 px-5">
                    <x-brand size="md" />
                </div>
                <nav class="space-y-1 overflow-y-auto p-4 text-sm" style="max-height: calc(100vh - 4.5rem - 6rem);">
                    @php
                        $groups = [
                            'Overview' => [
                                ['label' => 'Dashboard', 'href' => '/admin', 'icon' => 'gauge', 'match' => 'admin'],
                            ],
                            'Learnings' => [
                                ['label' => 'All learnings', 'href' => '/admin/learnings', 'icon' => 'spark', 'match' => 'admin/learnings*'],
                                ['label' => 'Categories', 'href' => '/admin/content/categories', 'icon' => 'workflow', 'match' => 'admin/content/categories'],
                            ],
                            'Site content' => [
                                ['label' => 'Services', 'href' => '/admin/services', 'icon' => 'code', 'match' => 'admin/services*'],
                                ['label' => 'Testimonials', 'href' => '/admin/content/testimonials', 'icon' => 'chat', 'match' => 'admin/content/testimonials'],
                                ['label' => 'Stats', 'href' => '/admin/content/stats', 'icon' => 'gauge', 'match' => 'admin/content/stats'],
                                ['label' => 'FAQs', 'href' => '/admin/content/faqs', 'icon' => 'spark', 'match' => 'admin/content/faqs'],
                                ['label' => 'Process', 'href' => '/admin/content/process', 'icon' => 'workflow', 'match' => 'admin/content/process'],
                                ['label' => 'Case studies', 'href' => '/admin/content/cases', 'icon' => 'target', 'match' => 'admin/content/cases'],
                                ['label' => 'Websites built', 'href' => '/admin/content/websites', 'icon' => 'code', 'match' => 'admin/content/websites'],
                            ],
                            'SEO' => [
                                ['label' => 'Redirects', 'href' => '/admin/content/redirects', 'icon' => 'workflow', 'match' => 'admin/content/redirects'],
                                ['label' => 'Schema (JSON-LD)', 'href' => '/admin/content/schema', 'icon' => 'code', 'match' => 'admin/content/schema'],
                                ['label' => 'SEO & Tracking', 'href' => '/admin/settings', 'icon' => 'shield', 'match' => 'admin/settings'],
                            ],
                            'Inbox' => [
                                ['label' => 'Leads', 'href' => '/admin/leads', 'icon' => 'mail', 'match' => 'admin/leads'],
                                ['label' => 'Subscribers', 'href' => '/admin/subscribers', 'icon' => 'bot', 'match' => 'admin/subscribers'],
                            ],
                        ];
                    @endphp
                    @foreach($groups as $heading => $items)
                        <div class="px-3 pb-1 pt-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-ink-400">{{ $heading }}</div>
                        @foreach($items as $it)
                            @php $active = request()->is($it['match']); @endphp
                            <a href="{{ $it['href'] }}"
                               class="flex items-center gap-3 rounded-xl px-3 py-2 font-medium transition-colors {{ $active ? 'bg-ink-100 text-ink-900' : 'text-ink-500 hover:bg-ink-100 hover:text-ink-900' }}">
                                <x-icon :name="$it['icon']" class="h-5 w-5" />
                                {{ $it['label'] }}
                            </a>
                        @endforeach
                    @endforeach
                </nav>
                <div class="absolute inset-x-0 bottom-0 border-t border-ink-200 p-4">
                    <a href="/" target="_blank" class="mb-2 flex items-center gap-2 rounded-xl px-3 py-2 text-sm text-ink-500 hover:text-ink-900">
                        <x-icon name="arrow" class="h-4 w-4" /> View site
                    </a>
                    <form method="POST" action="/admin/logout">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-sm text-flame-600 hover:bg-ink-100">
                            <x-icon name="close" class="h-4 w-4" /> Log out
                        </button>
                    </form>
                </div>
            </aside>

            {{-- Main --}}
            <div class="flex min-w-0 flex-1 flex-col lg:pl-64">
                <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-ink-200 bg-white/85 px-5 backdrop-blur-xl">
                    <button @click="nav = !nav" class="grid h-10 w-10 place-items-center rounded-lg border border-ink-200 text-ink-900 lg:hidden">
                        <x-icon name="menu" class="h-5 w-5" />
                    </button>
                    <h1 class="font-display text-lg font-semibold text-ink-900">{{ $title }}</h1>
                    <span class="text-sm text-ink-500">{{ auth()->user()?->name }}</span>
                </header>

                <main class="flex-1 p-5 sm:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    @else
        {{-- Guest (login) --}}
        <div class="grid min-h-screen place-items-center px-5">
            {{ $slot }}
        </div>
    @endauth

    @livewireScripts
</body>
</html>
