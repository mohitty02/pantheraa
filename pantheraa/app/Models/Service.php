<?php

namespace App\Models;

use App\Models\Concerns\FlushesSiteCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use FlushesSiteCache;

    protected $guarded = [];

    protected $casts = [
        'points'       => 'array',
        'deliverables' => 'array',
        'outcomes'     => 'array',
        'faqs'         => 'array',
        'featured'     => 'boolean',
        'is_active'    => 'boolean',
    ];

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true)->orderBy('sort')->orderBy('id');
    }
}
