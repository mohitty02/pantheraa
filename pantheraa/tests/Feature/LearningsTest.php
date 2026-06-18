<?php

namespace Tests\Feature;

use App\Models\Learning;
use App\Models\User;
use App\Support\Markdown;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LearningsTest extends TestCase
{
    use RefreshDatabase;

    private function makeLearning(array $overrides = []): Learning
    {
        return Learning::create(array_merge([
            'title'        => 'Test Learning About RAG',
            'body'         => "Intro with `inline` code and inline math \$x_i\$.\n\n```python\nprint('hi')\n```\n\n\$\$ E = mc^2 \$\$",
            'status'       => 'published',
            'published_at' => now(),
        ], $overrides));
    }

    public function test_learnings_index_loads(): void
    {
        $this->get('/learnings')->assertOk()->assertSee('frontier', false);
    }

    public function test_published_learning_renders_code_and_keeps_math(): void
    {
        $l = $this->makeLearning();

        $this->get('/learnings/' . $l->slug)
            ->assertOk()
            ->assertSee('class="language-python"', false)   // fenced code highlighted target
            ->assertSee('<code>inline</code>', false)        // inline code
            ->assertSee('E = mc^2', false)                   // math delimiters kept for KaTeX
            ->assertSee('"@type":"BlogPosting"', false);     // Article schema
    }

    public function test_draft_learning_is_not_public(): void
    {
        $l = $this->makeLearning(['status' => 'draft', 'published_at' => null]);

        $this->get('/learnings/' . $l->slug)->assertNotFound();
    }

    public function test_views_increment_on_visit(): void
    {
        $l = $this->makeLearning();
        $this->get('/learnings/' . $l->slug)->assertOk();
        $this->assertSame(1, $l->fresh()->views);
    }

    public function test_admin_routes_require_auth(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/learnings')->assertRedirect('/admin/login');
        $this->get('/admin/learnings/create')->assertRedirect('/admin/login');
    }

    public function test_admin_login_page_loads(): void
    {
        $this->get('/admin/login')->assertOk()->assertSee('Sign in', false);
    }

    public function test_admin_can_log_in(): void
    {
        $user = User::create([
            'name' => 'Admin', 'email' => 'a@b.com', 'password' => bcrypt('secret123'),
        ]);

        Livewire::test('admin.login-form')
            ->set('email', 'a@b.com')
            ->set('password', 'secret123')
            ->call('login');

        $this->assertAuthenticatedAs($user);
    }

    public function test_editor_creates_a_learning(): void
    {
        $user = User::create(['name' => 'Admin', 'email' => 'a@b.com', 'password' => bcrypt('secret123')]);

        Livewire::actingAs($user)->test('admin.learning-editor')
            ->set('title', 'A Brand New Note')
            ->set('body', "# Hello\n\nSome **markdown** body.")
            ->call('save', true);

        $this->assertDatabaseHas('learnings', [
            'title'  => 'A Brand New Note',
            'slug'   => 'a-brand-new-note',
            'status' => 'published',
        ]);
    }

    public function test_markdown_protects_code_and_math(): void
    {
        $html = Markdown::toHtml("Use `npm` here and \$x_i\$ inline.\n\n```js\nlet a = 1;\n```\n\n\$\$ \\frac{1}{2} \$\$");

        $this->assertStringContainsString('<code>npm</code>', $html);
        $this->assertStringContainsString('language-js', $html);
        $this->assertStringContainsString('$x_i$', $html);          // inline math preserved
        $this->assertStringContainsString('\\frac{1}{2}', $html);   // LaTeX backslash not mangled
    }
}
