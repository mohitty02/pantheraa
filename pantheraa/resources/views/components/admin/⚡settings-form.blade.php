<?php

use Livewire\Component;
use App\Models\Setting;

new class extends Component
{
    public array $f = [];

    public function mount(): void
    {
        $s = Setting::map();
        $site = config('site');
        $g = fn ($k, $d = '') => $s[$k] ?? $d;

        $this->f = [
            'name'        => $g('name', $site['name'] ?? ''),
            'tagline'     => $g('tagline', $site['tagline'] ?? ''),
            'legal_name'  => $g('legal_name', $site['legal_name'] ?? ''),
            'short_desc'  => $g('short_desc', $site['short_desc'] ?? ''),
            'founded'     => $g('founded', $site['founded'] ?? ''),
            'email'       => $g('email', $site['email'] ?? ''),
            'phone'       => $g('phone', $site['phone'] ?? ''),
            'phone_link'  => $g('phone_link', $site['phone_link'] ?? ''),
            'hours'       => $g('hours', $site['hours'] ?? ''),
            'price_range' => $g('price_range', $site['price_range'] ?? ''),

            'addr_street'   => $s['address']['street']   ?? ($site['address']['street'] ?? ''),
            'addr_locality' => $s['address']['locality'] ?? ($site['address']['locality'] ?? ''),
            'addr_region'   => $s['address']['region']   ?? ($site['address']['region'] ?? ''),
            'addr_postal'   => $s['address']['postal']   ?? ($site['address']['postal'] ?? ''),
            'addr_country'  => $s['address']['country']  ?? ($site['address']['country'] ?? ''),

            'geo_lat' => $s['geo']['lat'] ?? ($site['geo']['lat'] ?? ''),
            'geo_lng' => $s['geo']['lng'] ?? ($site['geo']['lng'] ?? ''),

            'soc_linkedin'  => $s['social']['linkedin']  ?? ($site['social']['linkedin'] ?? ''),
            'soc_instagram' => $s['social']['instagram'] ?? ($site['social']['instagram'] ?? ''),
            'soc_x'         => $s['social']['x']         ?? ($site['social']['x'] ?? ''),
            'soc_youtube'   => $s['social']['youtube']   ?? ($site['social']['youtube'] ?? ''),

            'learnings_tagline'    => $g('learnings_tagline', $site['learnings']['tagline'] ?? ''),
            'learnings_categories' => implode(', ', $s['learnings_categories'] ?? ($site['learnings']['categories'] ?? [])),

            // SEO defaults
            'seo_title_suffix'        => $g('seo_title_suffix', $site['name'] ?? ''),
            'seo_default_description' => $g('seo_default_description', $site['short_desc'] ?? ''),
            'seo_default_image'       => $g('seo_default_image', ''),
            'seo_twitter_site'        => $g('seo_twitter_site', ''),
            'seo_author_name'         => $g('seo_author_name', $site['name'] ?? ''),

            // Tracking
            'gsc_verification' => $g('gsc_verification', ''),
            'ga4_id'           => $g('ga4_id', ''),
            'gtm_id'           => $g('gtm_id', ''),
            'meta_pixel_id'    => $g('meta_pixel_id', ''),
            'clarity_id'       => $g('clarity_id', ''),
            'hotjar_id'        => $g('hotjar_id', ''),
        ];
    }

    public function save(): void
    {
        $this->validate([
            'f.name'       => 'required|string|max:120',
            'f.tagline'    => 'nullable|string|max:120',
            'f.short_desc' => 'required|string|max:400',
            'f.email'      => 'required|email|max:160',
            'f.phone'      => 'nullable|string|max:40',
            'f.soc_linkedin'  => 'nullable|url',
            'f.soc_instagram' => 'nullable|url',
            'f.soc_x'         => 'nullable|url',
            'f.soc_youtube'   => 'nullable|url',
        ]);

        foreach ([
            'name', 'tagline', 'legal_name', 'short_desc', 'founded', 'email', 'phone', 'phone_link', 'hours', 'price_range', 'learnings_tagline',
            'seo_title_suffix', 'seo_default_description', 'seo_default_image', 'seo_twitter_site', 'seo_author_name',
            'gsc_verification', 'ga4_id', 'gtm_id', 'meta_pixel_id', 'clarity_id', 'hotjar_id',
        ] as $k) {
            Setting::put($k, $this->f[$k]);
        }

        Setting::put('address', [
            'street' => $this->f['addr_street'], 'locality' => $this->f['addr_locality'],
            'region' => $this->f['addr_region'], 'postal' => $this->f['addr_postal'],
            'country' => $this->f['addr_country'],
        ]);
        Setting::put('geo', ['lat' => (float) $this->f['geo_lat'], 'lng' => (float) $this->f['geo_lng']]);
        Setting::put('social', [
            'linkedin' => $this->f['soc_linkedin'], 'instagram' => $this->f['soc_instagram'],
            'x' => $this->f['soc_x'], 'youtube' => $this->f['soc_youtube'],
        ]);
        Setting::put('learnings_categories', collect(explode(',', $this->f['learnings_categories']))->map(fn ($t) => trim($t))->filter()->values()->all());

        $this->dispatch('saved');
        session()->flash('status', 'Settings saved.');
    }
}; ?>

<div class="max-w-3xl space-y-6">
    @if(session('status'))
        <div class="rounded-xl border border-volt-500/30 bg-volt-500/10 px-4 py-3 text-sm text-white">{{ session('status') }}</div>
    @endif

    <section class="card">
        <h3 class="text-lg">Brand</h3>
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <x-admin.field wire="f.name" label="Site name" />
            <x-admin.field wire="f.tagline" label="Tagline" />
            <x-admin.field wire="f.legal_name" label="Legal name" />
            <x-admin.field wire="f.founded" label="Founded year" />
            <div class="sm:col-span-2"><x-admin.field wire="f.short_desc" label="Short description" type="textarea" /></div>
        </div>
    </section>

    <section class="card">
        <h3 class="text-lg">Contact &amp; location</h3>
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <x-admin.field wire="f.email" label="Email" />
            <x-admin.field wire="f.phone" label="Phone (display)" />
            <x-admin.field wire="f.phone_link" label="Phone (tel: link)" />
            <x-admin.field wire="f.hours" label="Opening hours" />
            <x-admin.field wire="f.price_range" label="Price range" />
            <x-admin.field wire="f.addr_street" label="Street" />
            <x-admin.field wire="f.addr_locality" label="City / locality" />
            <x-admin.field wire="f.addr_region" label="Region / state" />
            <x-admin.field wire="f.addr_postal" label="Postal code" />
            <x-admin.field wire="f.addr_country" label="Country code" />
            <x-admin.field wire="f.geo_lat" label="Latitude" />
            <x-admin.field wire="f.geo_lng" label="Longitude" />
        </div>
    </section>

    <section class="card">
        <h3 class="text-lg">Social profiles</h3>
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <x-admin.field wire="f.soc_linkedin" label="LinkedIn URL" />
            <x-admin.field wire="f.soc_instagram" label="Instagram URL" />
            <x-admin.field wire="f.soc_x" label="X (Twitter) URL" />
            <x-admin.field wire="f.soc_youtube" label="YouTube URL" />
        </div>
    </section>

    <section class="card">
        <h3 class="text-lg">Learnings</h3>
        <div class="mt-4 grid gap-4">
            <x-admin.field wire="f.learnings_tagline" label="Learnings tagline" />
            <x-admin.field wire="f.learnings_categories" label="Default category suggestions (comma separated)" />
        </div>
    </section>

    <section class="card">
        <h3 class="text-lg">SEO defaults</h3>
        <p class="mt-1 text-sm text-white/50">Used when a page doesn't set its own values.</p>
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <x-admin.field wire="f.seo_title_suffix" label="Title suffix" ph="Pantheraa Space" />
            <x-admin.field wire="f.seo_twitter_site" label="Twitter/X handle" ph="@pantheraaspace" />
            <div class="sm:col-span-2"><x-admin.field wire="f.seo_default_description" label="Default meta description" type="textarea" /></div>
            <div class="sm:col-span-2"><x-admin.field wire="f.seo_default_image" label="Default share image URL (1200×630)" ph="https://…/og.jpg" /></div>
            <x-admin.field wire="f.seo_author_name" label="Default author name" />
        </div>
    </section>

    <section class="card">
        <h3 class="text-lg">Tracking &amp; analytics</h3>
        <p class="mt-1 text-sm text-white/50">Paste IDs only — snippets load automatically. Leave blank to disable.</p>
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <x-admin.field wire="f.ga4_id" label="Google Analytics 4 ID" ph="G-XXXXXXX" />
            <x-admin.field wire="f.gtm_id" label="Google Tag Manager ID" ph="GTM-XXXXXX" />
            <x-admin.field wire="f.meta_pixel_id" label="Meta Pixel ID" />
            <x-admin.field wire="f.clarity_id" label="Microsoft Clarity ID" />
            <x-admin.field wire="f.hotjar_id" label="Hotjar ID" />
            <x-admin.field wire="f.gsc_verification" label="Google Search Console verification" />
        </div>
    </section>

    <div class="sticky bottom-4 flex justify-end">
        <button wire:click="save" class="btn-primary shadow-lg" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save">Save settings</span>
            <span wire:loading wire:target="save">Saving…</span>
        </button>
    </div>
</div>
