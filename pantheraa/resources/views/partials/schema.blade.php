@props(['schema' => []])

@php
    $s   = config('site');
    $url = rtrim($s['url'], '/');
    $logo = $url . '/images/logo.jpeg';

    // ---- Base entities shared across every page (helps GEO / AEO / E-E-A-T) ----
    $organization = [
        '@type'       => 'Organization',
        '@id'         => $url . '/#organization',
        'name'        => $s['name'],
        'legalName'   => $s['legal_name'],
        'url'         => $url . '/',
        'logo'        => ['@type' => 'ImageObject', 'url' => $logo, 'width' => 1600, 'height' => 1600],
        'image'       => $logo,
        'description' => $s['short_desc'],
        'foundingDate'=> $s['founded'],
        'slogan'      => $s['tagline'],
        'email'       => $s['email'],
        'telephone'   => $s['phone'],
        'sameAs'      => array_values($s['social']),
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $s['address']['street'],
            'addressLocality' => $s['address']['locality'],
            'addressRegion'   => $s['address']['region'],
            'postalCode'      => $s['address']['postal'],
            'addressCountry'  => $s['address']['country'],
        ],
    ];

    $localBusiness = [
        '@type'       => 'ProfessionalService',
        '@id'         => $url . '/#business',
        'name'        => $s['name'],
        'image'       => $logo,
        'url'         => $url . '/',
        'telephone'   => $s['phone'],
        'email'       => $s['email'],
        'priceRange'  => $s['price_range'],
        'description' => $s['short_desc'],
        'parentOrganization' => ['@id' => $url . '/#organization'],
        'address'     => $organization['address'],
        'geo'         => ['@type' => 'GeoCoordinates', 'latitude' => $s['geo']['lat'], 'longitude' => $s['geo']['lng']],
        'openingHours'=> $s['hours'],
        'areaServed'  => 'Worldwide',
        'knowsAbout'  => array_map(fn ($x) => $x['name'], $s['services']),
    ];

    $website = [
        '@type'      => 'WebSite',
        '@id'        => $url . '/#website',
        'url'        => $url . '/',
        'name'       => $s['name'],
        'description'=> $s['short_desc'],
        'publisher'  => ['@id' => $url . '/#organization'],
        'inLanguage' => 'en',
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => ['@type' => 'EntryPoint', 'urlTemplate' => $url . '/learnings?q={search_term_string}'],
            'query-input' => 'required name=search_term_string',
        ],
    ];

    $graph = array_merge([$organization, $localBusiness, $website], $schema);

    // ---- Admin-managed structured-data blocks (Schema Manager) ----
    try {
        $isHome = request()->path() === '/';
        foreach (\App\Models\SchemaEntry::active()->get() as $entry) {
            if (($entry->placement ?? 'all') === 'home' && ! $isHome) {
                continue;
            }
            if (! empty($entry->data)) {
                $graph[] = $entry->data;
            }
        }
    } catch (\Throwable $e) {
        // table not migrated yet — ignore
    }

    $json = [
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
