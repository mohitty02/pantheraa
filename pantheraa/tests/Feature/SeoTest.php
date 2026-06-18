<?php

namespace Tests\Feature;

use App\Models\Learning;
use App\Models\LearningCategory;
use App\Models\Redirect;
use App\Models\SchemaEntry;
use App\Models\User;
use App\Support\Tracking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::create(['name' => 'Admin', 'email' => 'a@b.com', 'password' => bcrypt('secret123')]);
    }

    public function test_category_archive_page_loads(): void
    {
        $cat = LearningCategory::create(['name' => 'Retrieval', 'slug' => 'retrieval']);
        Learning::create([
            'title' => 'A RAG note', 'body' => 'Body here.', 'status' => 'published',
            'published_at' => now(), 'category_id' => $cat->id,
        ]);

        $this->get('/learnings/category/retrieval')
            ->assertOk()
            ->assertSee('Retrieval', false)
            ->assertSee('"@type":"CollectionPage"', false);

        $this->get('/learnings/category/nope')->assertNotFound();
    }

    public function test_learning_detail_is_article_with_canonical(): void
    {
        $l = Learning::create([
            'title' => 'Indexed note', 'body' => 'Body', 'status' => 'published', 'published_at' => now(),
        ]);

        $this->get('/learnings/' . $l->slug)
            ->assertOk()
            ->assertSee('property="og:type" content="article"', false)
            ->assertSee('"@type":"BlogPosting"', false)
            ->assertSee('article:published_time', false);
    }

    public function test_noindex_learning_outputs_noindex(): void
    {
        $l = Learning::create([
            'title' => 'Secret', 'body' => 'x', 'status' => 'published', 'published_at' => now(), 'noindex' => true,
        ]);

        $this->get('/learnings/' . $l->slug)->assertSee('noindex, nofollow', false);
    }

    public function test_rss_feed_renders(): void
    {
        Learning::create(['title' => 'Feed item', 'body' => 'x', 'status' => 'published', 'published_at' => now()]);

        $this->get('/learnings/feed')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/rss+xml; charset=UTF-8')
            ->assertSee('<rss', false)
            ->assertSee('Feed item', false);
    }

    public function test_redirect_middleware_redirects(): void
    {
        Redirect::create(['source' => '/old-page', 'destination' => '/contact', 'status_code' => 301, 'is_active' => true]);

        $this->get('/old-page')->assertRedirect('/contact')->assertStatus(301);
    }

    public function test_inactive_redirect_is_ignored(): void
    {
        Redirect::create(['source' => '/dead', 'destination' => '/contact', 'status_code' => 301, 'is_active' => false]);
        Cache::forget(Redirect::CACHE_KEY);

        $this->get('/dead')->assertNotFound();
    }

    public function test_tracking_emits_ga4_when_configured(): void
    {
        config(['site.tracking.ga4_id' => 'G-TEST123']);
        $this->assertStringContainsString('G-TEST123', Tracking::head());
        $this->assertStringContainsString('gtag', Tracking::head());

        config(['site.tracking' => []]);
        $this->assertSame('', Tracking::head());
    }

    public function test_admin_can_manage_categories_and_redirects(): void
    {
        $admin = $this->admin();

        Livewire::actingAs($admin)->test('admin.collection-manager', ['type' => 'categories'])
            ->call('create')->set('form.name', 'Vector DBs')->call('save')->assertHasNoErrors();
        $this->assertDatabaseHas('learning_categories', ['slug' => 'vector-dbs']);

        Livewire::actingAs($admin)->test('admin.collection-manager', ['type' => 'redirects'])
            ->call('create')
            ->set('form.source', '/x')->set('form.destination', '/y')->set('form.status_code', '301')
            ->call('save')->assertHasNoErrors();
        $this->assertDatabaseHas('redirects', ['source' => '/x', 'destination' => '/y']);
    }

    public function test_schema_entry_json_is_parsed_and_output(): void
    {
        Livewire::actingAs($this->admin())->test('admin.collection-manager', ['type' => 'schema'])
            ->call('create')
            ->set('form.name', 'Test Org')
            ->set('form.placement', 'all')
            ->set('form.data', '{"@type":"Organization","name":"ZZTOP"}')
            ->call('save')->assertHasNoErrors();

        $entry = SchemaEntry::first();
        $this->assertSame('Organization', $entry->data['@type']);

        $this->get('/')->assertSee('ZZTOP', false);
    }

    public function test_invalid_schema_json_shows_error(): void
    {
        Livewire::actingAs($this->admin())->test('admin.collection-manager', ['type' => 'schema'])
            ->call('create')
            ->set('form.name', 'Bad')
            ->set('form.data', '{not valid json')
            ->call('save')
            ->assertHasErrors('form.data');
    }
}
