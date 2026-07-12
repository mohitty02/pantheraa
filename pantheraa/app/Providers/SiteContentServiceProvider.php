<?php

namespace App\Providers;

use App\Models\CaseStudy;
use App\Models\Faq;
use App\Models\ProcessStep;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Stat;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Makes the whole marketing site database-driven.
 *
 * The frontend keeps reading config('site.*'); here we transparently
 * override those values with what's stored in the CMS tables (cached,
 * busted automatically whenever a CMS record changes). If the tables are
 * missing or empty, the values from config/site.php are used as defaults.
 */
class SiteContentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        try {
            if (! Schema::hasTable('settings')) {
                return; // before migration
            }
        } catch (\Throwable $e) {
            return;
        }

        $overrides = Cache::rememberForever('site.content', fn () => self::buildOverrides());

        if (! empty($overrides)) {
            config(['site' => array_replace(config('site'), $overrides)]);
        }
    }

    /** Build the config('site') overrides from the CMS tables. */
    public static function buildOverrides(): array
    {
        $out = [];

        // ---- Settings ----
        $s = Setting::map();
        foreach (['name', 'tagline', 'legal_name', 'short_desc', 'founded', 'email', 'phone', 'phone_link', 'hours', 'price_range'] as $k) {
            if (array_key_exists($k, $s) && $s[$k] !== null && $s[$k] !== '') {
                $out[$k] = $s[$k];
            }
        }
        foreach (['address', 'geo', 'social'] as $k) {
            if (! empty($s[$k]) && is_array($s[$k])) {
                $out[$k] = $s[$k];
            }
        }

        $learnings = config('site.learnings', []);
        if (! empty($s['learnings_tagline'])) {
            $learnings['tagline'] = $s['learnings_tagline'];
        }
        if (! empty($s['learnings_categories']) && is_array($s['learnings_categories'])) {
            $learnings['categories'] = $s['learnings_categories'];
        }
        $out['learnings'] = $learnings;

        // ---- Tracking / analytics ----
        $out['tracking'] = [
            'gtm_id'           => $s['gtm_id'] ?? '',
            'ga4_id'           => $s['ga4_id'] ?? '',
            'meta_pixel_id'    => $s['meta_pixel_id'] ?? '',
            'clarity_id'       => $s['clarity_id'] ?? '',
            'hotjar_id'        => $s['hotjar_id'] ?? '',
            'gsc_verification' => $s['gsc_verification'] ?? '',
        ];

        // ---- SEO defaults ----
        $out['seo'] = [
            'title_suffix'        => $s['seo_title_suffix'] ?? '',
            'default_description' => $s['seo_default_description'] ?? '',
            'default_image'       => $s['seo_default_image'] ?? '',
            'twitter_site'        => $s['seo_twitter_site'] ?? '',
            // E-E-A-T: a real, named human behind the content
            'author_name'         => $s['seo_author_name'] ?? '',
            'author_role'         => $s['seo_author_role'] ?? '',
            'author_bio'          => $s['seo_author_bio'] ?? '',
            'author_image'        => $s['seo_author_image'] ?? '',
            'author_url'          => $s['seo_author_url'] ?? '',
        ];

        // ---- Trust / CRO signals (shown near every CTA) ----
        $out['trust'] = [
            'markers'  => is_array($s['trust_markers'] ?? null) ? $s['trust_markers'] : [],
            'badges'   => is_array($s['trust_badges'] ?? null) ? $s['trust_badges'] : [],
            'reassure' => $s['trust_reassure'] ?? '',
        ];

        // ---- Services ----
        $services = Service::active()->get();
        if ($services->isNotEmpty()) {
            $out['services'] = $services->map(fn (Service $x) => array_filter([
                'slug'         => $x->slug,
                'name'         => $x->name,
                'short'        => $x->short,
                'icon'         => $x->icon,
                'featured'     => $x->featured,
                'tagline'      => $x->tagline,
                'desc'         => $x->description,
                'overview'     => $x->overview,
                'points'       => $x->points ?: [],
                'deliverables' => $x->deliverables ?: [],
                'outcomes'     => $x->outcomes ?: [],
                'faqs'         => $x->faqs ?: [],
                'meta_title'       => $x->meta_title,
                'meta_description' => $x->meta_description,
            ], fn ($v) => $v !== null))->all();
        }

        // ---- Stats ----
        $stats = Stat::active()->get();
        if ($stats->isNotEmpty()) {
            $out['stats'] = $stats->map(fn (Stat $x) => [
                'value'  => is_numeric($x->value) ? $x->value + 0 : $x->value,
                'suffix' => (string) $x->suffix,
                'label'  => $x->label,
            ])->all();
        }

        // ---- Process ----
        $process = ProcessStep::active()->get();
        if ($process->isNotEmpty()) {
            $out['process'] = $process->map(fn (ProcessStep $x) => [
                'no'    => $x->no,
                'title' => $x->title,
                'desc'  => $x->description,
            ])->all();
        }

        // ---- Testimonials ----
        $testimonials = Testimonial::active()->get();
        if ($testimonials->isNotEmpty()) {
            $out['testimonials'] = $testimonials->map(fn (Testimonial $x) => [
                'quote' => $x->quote,
                'name'  => $x->name,
                'role'  => $x->role,
            ])->all();
        }

        // ---- FAQs ----
        $faqs = Faq::active()->get();
        if ($faqs->isNotEmpty()) {
            $out['faqs'] = $faqs->map(fn (Faq $x) => [
                'q' => $x->question,
                'a' => $x->answer,
            ])->all();
        }

        // ---- Case studies ----
        $cases = CaseStudy::active()->get();
        if ($cases->isNotEmpty()) {
            $out['cases'] = $cases->map(fn (CaseStudy $x) => [
                'client'   => $x->client,
                'industry' => $x->industry,
                'metric'   => $x->metric,
                'kpi'      => $x->kpi,
                'desc'     => $x->description,
                'tags'     => $x->tags ?: [],
            ])->all();
        }

        return $out;
    }
}
