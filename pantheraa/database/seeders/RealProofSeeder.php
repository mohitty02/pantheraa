<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use App\Models\Stat;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

/**
 * Replaces the placeholder social proof with the REAL, verifiable results
 * taken from the client Search Console / Analytics / Business Profile
 * screenshots in /uploads/portfolio.
 *
 * Testimonials are intentionally left EMPTY — a testimonial is a client's own
 * words. They must be collected from the client, never written on their behalf.
 */
class RealProofSeeder extends Seeder
{
    public function run(): void
    {
        // ── Real, defensible headline numbers (aggregated from client data) ──
        Stat::query()->delete();
        $stats = [
            ['value' => '16',  'suffix' => 'M+', 'label' => 'Search impressions generated'],
            ['value' => '620', 'suffix' => 'K+', 'label' => 'Organic clicks delivered'],
            ['value' => '99',  'suffix' => 'K+', 'label' => 'Google Business Profile views'],
            ['value' => '6',   'suffix' => '',   'label' => 'Brands scaled across 3 countries'],
        ];
        foreach ($stats as $i => $s) {
            Stat::create($s + ['sort' => $i, 'is_active' => true]);
        }

        // ── Real case studies (every number is from a client screenshot) ──
        CaseStudy::query()->delete();
        $cases = [
            [
                'client' => 'Boult',
                'industry' => 'D2C Audio · India',
                'metric' => '14.5M',
                'kpi' => 'search impressions',
                'description' => 'Scaled organic search to 611K clicks and 14.5M impressions, holding an average position of 9.6 across the catalogue.',
                'tags' => ['SEO'],
            ],
            [
                'client' => 'Frozen King',
                'industry' => 'Food Manufacturing · UAE',
                'metric' => '#1',
                'kpi' => 'in the UAE',
                'description' => 'Ranked #1 for "frozen food supplier in UAE" with a 700% domain authority lift, 289 referring links and a 5.0★ profile.',
                'tags' => ['SEO', 'GMB'],
            ],
            [
                'client' => 'Soxytoes',
                'industry' => 'D2C Apparel · India',
                'metric' => '1.47M',
                'kpi' => 'search impressions',
                'description' => 'Grew organic visibility to 1.47M impressions and 8.06K clicks, with an average position of 8.1.',
                'tags' => ['SEO'],
            ],
            [
                'client' => 'Tejas Tours & Travels',
                'industry' => 'Travel · Mysore',
                'metric' => '4.9★',
                'kpi' => 'with 46 reviews',
                'description' => 'Built the Google Business Profile into a lead engine — 4.9★ rating and 108 customer interactions from the map pack.',
                'tags' => ['GMB', 'Local SEO'],
            ],
            [
                'client' => 'Harmonia',
                'industry' => 'Healthcare · Hong Kong',
                'metric' => '99K+',
                'kpi' => 'profile views',
                'description' => 'Google Business Profile optimization for Dr. Raman Sidhu driving 99,458 profile views and 1,533 website clicks.',
                'tags' => ['GMB'],
            ],
            [
                'client' => 'Biocity Healthcare',
                'industry' => 'Healthcare · India',
                'metric' => '7.1K',
                'kpi' => 'active users',
                'description' => 'Grew to 7.1K active users with organic search among the top acquisition channels.',
                'tags' => ['SEO', 'Web'],
            ],
        ];
        foreach ($cases as $i => $c) {
            CaseStudy::create($c + ['sort' => $i, 'is_active' => true]);
        }

        // ── Testimonials: only real client words belong here ──
        // Left empty on purpose. Collect quotes from clients, then add them in
        // Admin → Testimonials. The section hides itself while empty.
        Testimonial::query()->delete();
    }
}
