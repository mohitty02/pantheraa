<?php

use App\Models\Learning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/services', 'services')->name('services');

// Individual service detail pages, e.g. /services/seo
Route::get('/services/{slug}', function (string $slug) {
    $service = collect(config('site.services'))->firstWhere('slug', $slug);
    abort_unless($service, 404);

    return view('service-detail', ['service' => $service]);
})->where('slug', '[a-z0-9-]+')->name('services.show');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

/*
| Learnings — public blog
*/
Route::view('/learnings', 'learnings.index')->name('learnings');

Route::get('/learnings/feed', function () {
    $items = Learning::published()->orderByDesc('published_at')->take(30)->get();

    return response()->view('learnings.feed', [
        'title'       => config('site.name') . ' — Learnings',
        'description' => config('site.learnings.tagline'),
        'lastBuild'   => optional($items->first()?->published_at)->toRssString() ?: now()->toRssString(),
        'items'       => $items,
    ])->header('Content-Type', 'application/rss+xml; charset=UTF-8');
})->name('learnings.feed');

Route::get('/learnings/category/{slug}', function (string $slug) {
    $category = \App\Models\LearningCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();

    return view('learnings.category', ['category' => $category]);
})->where('slug', '[a-z0-9-]+')->name('learnings.category');

Route::get('/learnings/{slug}', function (string $slug) {
    $learning = Learning::published()->where('slug', $slug)->firstOrFail();
    $learning->incrementQuietly('views');

    return view('learnings.show', ['learning' => $learning]);
})->where('slug', '[a-z0-9-]+')->name('learnings.show');

/*
| Admin (auth-protected) — manage Learnings
*/
Route::get('/admin/login', fn () => Auth::check() ? redirect('/admin') : view('admin.login'))->name('admin.login');

Route::middleware('auth')->group(function () {
    Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');

    // Learnings
    Route::view('/admin/learnings', 'admin.learnings')->name('admin.learnings');
    Route::get('/admin/learnings/create', fn () => view('admin.learning-edit', ['id' => null]))->name('admin.learnings.create');
    Route::get('/admin/learnings/{learning}/edit', fn (Learning $learning) => view('admin.learning-edit', ['id' => $learning->id]))->name('admin.learnings.edit');

    // Site settings
    Route::view('/admin/settings', 'admin.settings')->name('admin.settings');

    // Services
    Route::view('/admin/services', 'admin.services')->name('admin.services');
    Route::get('/admin/services/create', fn () => view('admin.service-edit', ['id' => null]))->name('admin.services.create');
    Route::get('/admin/services/{service}/edit', fn (\App\Models\Service $service) => view('admin.service-edit', ['id' => $service->id]))->name('admin.services.edit');

    // Generic content collections (testimonials, stats, faqs, process, cases)
    Route::get('/admin/content/{type}', function (string $type) {
        abort_unless(config("cms.collections.$type"), 404);

        return view('admin.collection', ['type' => $type]);
    })->name('admin.content');

    // Inbox
    Route::view('/admin/leads', 'admin.leads')->name('admin.leads');
    Route::view('/admin/subscribers', 'admin.subscribers')->name('admin.subscribers');

    Route::post('/admin/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    })->name('admin.logout');
});

/*
| Dynamic XML sitemap built from the named routes above.
*/
Route::get('/sitemap.xml', function () {
    $pages = [
        ['loc' => url('/'),         'priority' => '1.0', 'freq' => 'weekly'],
        ['loc' => url('/services'), 'priority' => '0.9', 'freq' => 'monthly'],
        ['loc' => url('/about'),    'priority' => '0.7', 'freq' => 'monthly'],
        ['loc' => url('/contact'),  'priority' => '0.8', 'freq' => 'monthly'],
    ];

    // each service detail page
    foreach (config('site.services') as $svc) {
        $pages[] = ['loc' => url('/services/' . $svc['slug']), 'priority' => '0.8', 'freq' => 'monthly'];
    }

    // learnings index + category archives + each published learning
    $pages[] = ['loc' => url('/learnings'), 'priority' => '0.7', 'freq' => 'daily'];
    foreach (\App\Models\LearningCategory::active()->get() as $cat) {
        $pages[] = ['loc' => url('/learnings/category/' . $cat->slug), 'priority' => '0.6', 'freq' => 'weekly'];
    }
    foreach (Learning::published()->orderByDesc('published_at')->get() as $learning) {
        $pages[] = ['loc' => $learning->url, 'priority' => '0.6', 'freq' => 'weekly', 'lastmod' => $learning->updated_at->toAtomString()];
    }

    return response()
        ->view('sitemap', ['pages' => $pages, 'lastmod' => now()->toAtomString()])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

/*
| robots.txt with an absolute sitemap URL resolved at runtime.
*/
Route::get('/robots.txt', function () {
    $body = "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml') . "\n";

    return response($body, 200, ['Content-Type' => 'text/plain']);
})->name('robots');

