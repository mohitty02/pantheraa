<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active'   => 'boolean',
        'last_hit_at' => 'datetime',
    ];

    public const CACHE_KEY = 'redirects.map';

    protected static function booted(): void
    {
        $flush = fn () => Cache::forget(self::CACHE_KEY);
        static::saved($flush);
        static::deleted($flush);
    }

    /** Normalized [source => [destination, status]] of active redirects. */
    public static function activeMap(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return static::where('is_active', true)->get()
                ->mapWithKeys(fn ($r) => [
                    '/' . ltrim($r->source, '/') => ['to' => $r->destination, 'status' => $r->status_code, 'id' => $r->id],
                ])->all();
        });
    }
}
