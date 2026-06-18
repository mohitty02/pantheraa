@php
    $s   = config('site');
    $org = rtrim($s['url'], '/') . '/#organization';

    $faqSchema = [
        '@type'      => 'FAQPage',
        '@id'        => url('/') . '/#faq',
        'mainEntity' => collect($s['faqs'])->map(fn ($f) => [
            '@type'          => 'Question',
            'name'           => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ])->all(),
    ];

    $servicesSchema = [
        '@type'           => 'ItemList',
        'name'            => 'Digital marketing services',
        'itemListElement' => collect($s['services'])->values()->map(fn ($svc, $i) => [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'item'     => [
                '@type'       => 'Service',
                'name'        => $svc['name'],
                'description' => $svc['desc'],
                'serviceType' => $svc['short'],
                'provider'    => ['@id' => $org],
            ],
        ])->all(),
    ];

    $pageSchema = [$faqSchema, $servicesSchema];
@endphp

<x-app-layout :schema="$pageSchema">
    @include('sections.hero')
    @include('sections.stats')
    @include('sections.services')
    @include('sections.ai')
    @include('sections.process')
    @include('sections.work')
    @include('sections.testimonials')
    @include('sections.faq')
    @include('sections.cta')
</x-app-layout>
