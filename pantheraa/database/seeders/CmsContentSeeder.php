<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use App\Models\Faq;
use App\Models\ProcessStep;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Stat;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

/**
 * One-time import of the static config/site.php content into the CMS tables,
 * so everything becomes editable from the admin panel.
 */
class CmsContentSeeder extends Seeder
{
    public function run(): void
    {
        $site = require config_path('site.php'); // raw file defaults

        // ---- Settings ----
        foreach (['name', 'tagline', 'legal_name', 'short_desc', 'founded', 'email', 'phone', 'phone_link', 'hours', 'price_range'] as $k) {
            if (array_key_exists($k, $site)) {
                Setting::put($k, $site[$k]);
            }
        }
        Setting::put('address', $site['address'] ?? []);
        Setting::put('geo', $site['geo'] ?? []);
        Setting::put('social', $site['social'] ?? []);
        Setting::put('learnings_tagline', $site['learnings']['tagline'] ?? '');
        Setting::put('learnings_categories', $site['learnings']['categories'] ?? []);

        // ---- Services (keyed by slug → idempotent) ----
        foreach (($site['services'] ?? []) as $i => $svc) {
            Service::updateOrCreate(['slug' => $svc['slug']], [
                'name'         => $svc['name'],
                'short'        => $svc['short'] ?? null,
                'icon'         => $svc['icon'] ?? 'spark',
                'tagline'      => $svc['tagline'] ?? null,
                'description'  => $svc['desc'] ?? null,
                'overview'     => $svc['overview'] ?? null,
                'featured'     => $svc['featured'] ?? false,
                'points'       => $svc['points'] ?? [],
                'deliverables' => $svc['deliverables'] ?? [],
                'outcomes'     => $svc['outcomes'] ?? [],
                'faqs'         => $svc['faqs'] ?? [],
                'sort'         => $i,
                'is_active'    => true,
            ]);
        }

        // ---- Collections (only if empty → avoid duplicates on re-run) ----
        if (Stat::count() === 0) {
            foreach (($site['stats'] ?? []) as $i => $x) {
                Stat::create(['value' => (string) $x['value'], 'suffix' => $x['suffix'] ?? '', 'label' => $x['label'], 'sort' => $i]);
            }
        }
        if (ProcessStep::count() === 0) {
            foreach (($site['process'] ?? []) as $i => $x) {
                ProcessStep::create(['no' => $x['no'] ?? null, 'title' => $x['title'], 'description' => $x['desc'] ?? null, 'sort' => $i]);
            }
        }
        if (Testimonial::count() === 0) {
            foreach (($site['testimonials'] ?? []) as $i => $x) {
                Testimonial::create(['quote' => $x['quote'], 'name' => $x['name'], 'role' => $x['role'] ?? null, 'sort' => $i]);
            }
        }
        if (Faq::count() === 0) {
            foreach (($site['faqs'] ?? []) as $i => $x) {
                Faq::create(['question' => $x['q'], 'answer' => $x['a'], 'sort' => $i]);
            }
        }
        if (CaseStudy::count() === 0) {
            $cases = [
                ['client' => 'FinFlow SaaS', 'industry' => 'B2B SaaS', 'metric' => '+312%', 'kpi' => 'organic demos', 'description' => 'Topic-cluster SEO + AEO turned organic search into the #1 demo source in two quarters.', 'tags' => ['SEO', 'AEO']],
                ['client' => 'Lumen Skincare', 'industry' => 'D2C Beauty', 'metric' => '5.3x', 'kpi' => 'blended ROAS', 'description' => 'Creative-led Meta & Google scaling lifted ROAS from 1.9x to 5.3x at 4x the spend.', 'tags' => ['Paid Media', 'Social']],
                ['client' => 'Vault Commerce', 'industry' => 'Marketplace', 'metric' => '#1', 'kpi' => 'in AI answers', 'description' => 'GEO + schema work earned consistent citations inside ChatGPT and Google AI Overviews.', 'tags' => ['GEO', 'Web']],
            ];
            foreach ($cases as $i => $x) {
                CaseStudy::create(array_merge($x, ['sort' => $i]));
            }
        }
    }
}
