<?php

namespace App\Models;

use App\Models\Concerns\FlushesSiteCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/** A website we built — shown in the portfolio. */
class Website extends Model
{
    use FlushesSiteCache;

    protected $guarded = [];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true)->orderBy('sort')->orderBy('id');
    }

    /** Bare domain, for display (e.g. "smileoracles.com"). */
    public function getDomainAttribute(): string
    {
        return preg_replace('#^www\.#', '', (string) parse_url($this->url, PHP_URL_HOST));
    }
}
