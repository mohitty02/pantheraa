<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

/**
 * Websites we've built. Brand names, industries and one-liners are taken from
 * each site's own title/meta description — nothing invented.
 */
class WebsitesSeeder extends Seeder
{
    public function run(): void
    {
        $sites = [
            ['name' => 'Da Rosier',              'url' => 'https://darosier.com/',              'industry' => 'Luxury Fragrances',   'description' => 'Luxury perfumes, signature fragrances, attars & oud.'],
            ['name' => 'AFFASCI',                'url' => 'https://www.affasci.com/',           'industry' => 'Luxury Fragrances',   'description' => 'Luxury fragrances crafted with the finest ingredients from around the globe.'],
            ['name' => 'Reset Wellness',         'url' => 'https://reset-wellness.in/',         'industry' => 'Longevity & Wellness','description' => "India's first science-led longevity clinic in Gurgaon — hyperbaric oxygen, cryotherapy and NAD+ IV therapy."],
            ['name' => 'Smile Oracles',          'url' => 'https://www.smileoracles.com/',      'industry' => 'Dental Clinic',       'description' => 'Cosmetic dentistry, implants and root canal care in Greater Kailash.'],
            ['name' => 'Raem Designs',           'url' => 'https://raemdesigns.com/',           'industry' => 'Interior Design',     'description' => 'Modern modular kitchen and interior design specialists in Delhi NCR.'],
            ['name' => 'BMS Tech',               'url' => 'https://bmstech.ai/',                'industry' => 'Cybersecurity',       'description' => 'Smarter safety with proactive security and continuous compliance.'],
            ['name' => 'NeoVeritas Healthcare',  'url' => 'http://neoveritas.com/',             'industry' => 'Pharmaceuticals',     'description' => 'A new vision in healthcare, led by promoters with three decades in pharma.'],
            ['name' => 'MiniBoss',               'url' => 'https://miniboss.in/',               'industry' => 'Baby & Kids',         'description' => 'Premium newborn essentials, baby products and toys.'],
            ['name' => 'Com-Paint',              'url' => 'https://www.com-paint.com/',         'industry' => 'Automotive Paint',    'description' => 'Car spray paint and scratch repair, online.'],
            ['name' => 'Coatee Spray',           'url' => 'https://coateespray.com/',           'industry' => 'Aerosols & Paint',    'description' => 'Agri touch-up spray paint by Indian Aerosols Pvt Ltd.'],
            ['name' => 'Urbandienst',            'url' => 'http://urbandienst.com/',            'industry' => 'Software & Digital',  'description' => 'Scalable, high-performance apps and software products.'],
            ['name' => 'KLA World',              'url' => 'https://klaworld.com/',              'industry' => 'Construction',        'description' => 'We build your buildings better.'],
            ['name' => 'Mahavir Design Studio',  'url' => 'https://mdsdesigners.com/',          'industry' => 'Fashion',             'description' => 'Timeless everyday essentials, made to last.'],
            ['name' => 'Bhanot Med Spa',         'url' => 'https://bhanotmedspa.com/',          'industry' => 'Med Spa',             'description' => null],
            ['name' => 'Soil and Soul Cosmetics','url' => 'https://soilandsoulcosmetics.com/',  'industry' => 'Cosmetics',           'description' => null],
            ['name' => 'Nirvaan Arts',           'url' => 'https://nirvaanarts.com/',           'industry' => 'Arts',                'description' => null],
            ['name' => 'Accessorize Urselfs',    'url' => 'https://accessorizeurselfs.com/',    'industry' => 'Accessories',         'description' => null],
            ['name' => 'Manufacturers.sale',     'url' => 'http://manufacturers.sale/',         'industry' => 'B2B Manufacturing',   'description' => null],
            ['name' => 'Pixel Shield',           'url' => 'https://pixelshield.in/',            'industry' => null,                  'description' => 'Strong. Elegant. Durable.'],
            ['name' => 'Hilford',                'url' => 'https://hilford.in/',                'industry' => null,                  'description' => null],
            ['name' => 'Grindwolf',              'url' => 'https://grindwolf.in/',              'industry' => null,                  'description' => null],
            ['name' => 'Awesomenblackk',         'url' => 'https://awesomenblackk.in/',         'industry' => null,                  'description' => null],
            ['name' => 'huluNY',                 'url' => 'https://huluny.com/',                'industry' => null,                  'description' => null],
            ['name' => 'Kaimee',                 'url' => 'https://www.kaimee.in/',             'industry' => null,                  'description' => null],
            ['name' => 'Bloomolive',             'url' => 'https://bloomolive.com/',            'industry' => null,                  'description' => null],
        ];

        foreach ($sites as $i => $s) {
            Website::updateOrCreate(
                ['url' => $s['url']],
                $s + ['sort' => $i, 'is_active' => true]
            );
        }
    }
}
