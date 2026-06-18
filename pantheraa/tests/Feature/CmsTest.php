<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use App\Providers\SiteContentServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CmsTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::create(['name' => 'Admin', 'email' => 'a@b.com', 'password' => bcrypt('secret123')]);
    }

    public function test_overrides_reflect_database_content(): void
    {
        Setting::put('name', 'Acme Co');
        Service::create([
            'slug' => 'demo', 'name' => 'Demo Service', 'icon' => 'bot',
            'description' => 'A demo.', 'is_active' => true, 'sort' => 0,
        ]);

        $over = SiteContentServiceProvider::buildOverrides();

        $this->assertSame('Acme Co', $over['name']);
        $this->assertSame('Demo Service', $over['services'][0]['name']);
        $this->assertSame('A demo.', $over['services'][0]['desc']); // column 'description' -> config key 'desc'
    }

    public function test_admin_cms_pages_require_auth(): void
    {
        $this->get('/admin/settings')->assertRedirect('/admin/login');
        $this->get('/admin/services')->assertRedirect('/admin/login');
        $this->get('/admin/content/testimonials')->assertRedirect('/admin/login');
        $this->get('/admin/leads')->assertRedirect('/admin/login');
    }

    public function test_unknown_collection_type_404(): void
    {
        $this->actingAs($this->admin())->get('/admin/content/nope')->assertNotFound();
    }

    public function test_settings_form_saves(): void
    {
        Livewire::actingAs($this->admin())->test('admin.settings-form')
            ->set('f.name', 'Pantheraa X')
            ->set('f.short_desc', 'We do growth.')
            ->set('f.email', 'hello@x.com')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame('Pantheraa X', Setting::get('name'));
        $this->assertSame('hello@x.com', Setting::get('email'));
    }

    public function test_collection_manager_creates_testimonial(): void
    {
        Livewire::actingAs($this->admin())->test('admin.collection-manager', ['type' => 'testimonials'])
            ->call('create')
            ->set('form.quote', 'They are brilliant.')
            ->set('form.name', 'Jane Doe')
            ->set('form.role', 'CEO, Acme')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('testimonials', ['name' => 'Jane Doe', 'role' => 'CEO, Acme']);
    }

    public function test_collection_manager_parses_tags(): void
    {
        Livewire::actingAs($this->admin())->test('admin.collection-manager', ['type' => 'cases'])
            ->call('create')
            ->set('form.client', 'BigCo')
            ->set('form.tags', 'SEO, Paid Media, GEO')
            ->call('save')
            ->assertHasNoErrors();

        $case = \App\Models\CaseStudy::where('client', 'BigCo')->first();
        $this->assertSame(['SEO', 'Paid Media', 'GEO'], $case->tags);
    }

    public function test_service_editor_creates_service(): void
    {
        Livewire::actingAs($this->admin())->test('admin.service-editor')
            ->set('name', 'AI Audits')
            ->set('icon', 'bot')
            ->set('tagline', 'Find the gaps.')
            ->set('points', ['Point one', ''])
            ->call('save')
            ->assertHasNoErrors();

        $svc = Service::where('name', 'AI Audits')->first();
        $this->assertNotNull($svc);
        $this->assertSame('ai-audits', $svc->slug);
        $this->assertSame(['Point one'], $svc->points); // blank point filtered out
    }
}
