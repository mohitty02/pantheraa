<?php

use App\Models\CaseStudy;
use App\Models\Faq;
use App\Models\LearningCategory;
use App\Models\ProcessStep;
use App\Models\Redirect;
use App\Models\SchemaEntry;
use App\Models\Stat;
use App\Models\Testimonial;

/*
| Schema for the generic admin Collection Manager. Each entry defines a
| simple content type: its model and the fields shown in the editor/table.
| field types: text | textarea | number | tags | toggle
*/
return [
    'collections' => [
        'testimonials' => [
            'model'    => Testimonial::class,
            'title'    => 'Testimonials',
            'singular' => 'testimonial',
            'icon'     => 'chat',
            'primary'  => 'name',
            'columns'  => ['name', 'role'],
            'fields'   => [
                ['key' => 'quote', 'label' => 'Quote', 'type' => 'textarea', 'rules' => 'required|string|max:1000'],
                ['key' => 'name',  'label' => 'Name',  'type' => 'text', 'rules' => 'required|string|max:120'],
                ['key' => 'role',  'label' => 'Role / Company', 'type' => 'text', 'rules' => 'nullable|string|max:160'],
            ],
        ],
        'stats' => [
            'model'    => Stat::class,
            'title'    => 'Stats',
            'singular' => 'stat',
            'icon'     => 'gauge',
            'primary'  => 'label',
            'columns'  => ['value', 'suffix', 'label'],
            'fields'   => [
                ['key' => 'value',  'label' => 'Value (e.g. 4.8 or 320)', 'type' => 'text', 'rules' => 'required|string|max:20'],
                ['key' => 'suffix', 'label' => 'Suffix (e.g. x, +, %)',  'type' => 'text', 'rules' => 'nullable|string|max:10'],
                ['key' => 'label',  'label' => 'Label', 'type' => 'text', 'rules' => 'required|string|max:120'],
            ],
        ],
        'faqs' => [
            'model'    => Faq::class,
            'title'    => 'FAQs',
            'singular' => 'FAQ',
            'icon'     => 'spark',
            'primary'  => 'question',
            'columns'  => ['question'],
            'fields'   => [
                ['key' => 'question', 'label' => 'Question', 'type' => 'text', 'rules' => 'required|string|max:255'],
                ['key' => 'answer',   'label' => 'Answer', 'type' => 'textarea', 'rules' => 'required|string|max:2000'],
            ],
        ],
        'process' => [
            'model'    => ProcessStep::class,
            'title'    => 'Process steps',
            'singular' => 'step',
            'icon'     => 'workflow',
            'primary'  => 'title',
            'columns'  => ['no', 'title'],
            'fields'   => [
                ['key' => 'no',          'label' => 'Number (e.g. 01)', 'type' => 'text', 'rules' => 'nullable|string|max:10'],
                ['key' => 'title',       'label' => 'Title', 'type' => 'text', 'rules' => 'required|string|max:120'],
                ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
            ],
        ],
        'cases' => [
            'model'    => CaseStudy::class,
            'title'    => 'Case studies',
            'singular' => 'case study',
            'icon'     => 'target',
            'primary'  => 'client',
            'columns'  => ['client', 'industry', 'metric'],
            'fields'   => [
                ['key' => 'client',      'label' => 'Client', 'type' => 'text', 'rules' => 'required|string|max:120'],
                ['key' => 'industry',    'label' => 'Industry', 'type' => 'text', 'rules' => 'nullable|string|max:120'],
                ['key' => 'metric',      'label' => 'Headline metric (e.g. 5.3x)', 'type' => 'text', 'rules' => 'nullable|string|max:40'],
                ['key' => 'kpi',         'label' => 'KPI label (e.g. blended ROAS)', 'type' => 'text', 'rules' => 'nullable|string|max:80'],
                ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                ['key' => 'tags',        'label' => 'Tags (comma separated)', 'type' => 'tags', 'rules' => 'nullable|string|max:200'],
            ],
        ],
        'categories' => [
            'model'    => LearningCategory::class,
            'title'    => 'Learning categories',
            'singular' => 'category',
            'icon'     => 'spark',
            'primary'  => 'name',
            'columns'  => ['name', 'slug'],
            'fields'   => [
                ['key' => 'name',        'label' => 'Name', 'type' => 'text', 'rules' => 'required|string|max:80'],
                ['key' => 'description', 'label' => 'Description (used on the category page)', 'type' => 'textarea', 'rules' => 'nullable|string|max:300'],
            ],
        ],
        'redirects' => [
            'model'    => Redirect::class,
            'title'    => 'Redirects',
            'singular' => 'redirect',
            'icon'     => 'workflow',
            'primary'  => 'source',
            'columns'  => ['source', 'destination', 'status_code'],
            'fields'   => [
                ['key' => 'source',      'label' => 'Source path (e.g. /old-url)', 'type' => 'text', 'rules' => 'required|string|max:255'],
                ['key' => 'destination', 'label' => 'Destination (path or full URL)', 'type' => 'text', 'rules' => 'required|string|max:255'],
                ['key' => 'status_code', 'label' => 'Status code', 'type' => 'select', 'options' => ['301', '302'], 'rules' => 'required'],
                ['key' => 'notes',       'label' => 'Notes', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            ],
        ],
        'schema' => [
            'model'    => SchemaEntry::class,
            'title'    => 'Schema (JSON-LD)',
            'singular' => 'schema block',
            'icon'     => 'code',
            'primary'  => 'name',
            'columns'  => ['name', 'type', 'placement'],
            'fields'   => [
                ['key' => 'name',      'label' => 'Label (internal)', 'type' => 'text', 'rules' => 'required|string|max:120'],
                ['key' => 'type',      'label' => 'Type (e.g. Organization, FAQPage)', 'type' => 'text', 'rules' => 'nullable|string|max:60'],
                ['key' => 'placement', 'label' => 'Show on', 'type' => 'select', 'options' => ['all', 'home'], 'rules' => 'required'],
                ['key' => 'data',      'label' => 'JSON-LD object', 'type' => 'json', 'rules' => 'nullable'],
            ],
        ],
    ],
];
