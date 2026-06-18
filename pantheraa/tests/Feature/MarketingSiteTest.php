<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MarketingSiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_with_seo_and_schema(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('measurable growth', false)
            ->assertSee('"@type":"Organization"', false)
            ->assertSee('"@type":"FAQPage"', false);
    }

    public function test_core_pages_load(): void
    {
        $this->get('/services')->assertOk();
        $this->get('/about')->assertOk();
        $this->get('/contact')->assertOk();
        $this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type', 'application/xml');
        $this->get('/robots.txt')->assertOk()->assertSee('Sitemap:');
    }

    public function test_every_service_detail_page_loads_with_schema(): void
    {
        foreach (config('site.services') as $service) {
            $this->get('/services/' . $service['slug'])
                ->assertOk()
                ->assertSee($service['name'], false)
                ->assertSee('"@type":"Service"', false)
                ->assertSee('"@type":"BreadcrumbList"', false);
        }
    }

    public function test_unknown_service_returns_404(): void
    {
        $this->get('/services/does-not-exist')->assertNotFound();
    }

    public function test_contact_form_rejects_invalid_input(): void
    {
        Livewire::test('contact-form')
            ->set('name', '')
            ->set('email', 'not-an-email')
            ->set('message', 'short')
            ->call('submit')
            ->assertHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('contacts', 0);
    }

    public function test_contact_form_saves_a_lead(): void
    {
        Livewire::test('contact-form')
            ->set('name', 'Jane Cooper')
            ->set('email', 'jane@example.com')
            ->set('phone', '+91 99999 88888')
            ->set('service', 'Search Engine Optimization')
            ->set('message', 'We need help ranking our SaaS product across search and AI.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('sent', true);

        $this->assertDatabaseHas('contacts', [
            'email'  => 'jane@example.com',
            'name'   => 'Jane Cooper',
            'status' => 'new',
        ]);
    }

    public function test_newsletter_subscribes_unique_email(): void
    {
        Livewire::test('newsletter-form')
            ->set('email', 'Sub@Example.com')
            ->call('subscribe')
            ->assertHasNoErrors()
            ->assertSet('done', true);

        // stored lowercased
        $this->assertDatabaseHas('subscribers', ['email' => 'sub@example.com']);
        $this->assertDatabaseCount('subscribers', 1);
    }
}
