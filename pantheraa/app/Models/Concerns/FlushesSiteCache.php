<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Cache;

/** Clears the cached site content whenever a CMS record changes. */
trait FlushesSiteCache
{
    public static function bootFlushesSiteCache(): void
    {
        $flush = fn () => Cache::forget('site.content');
        static::saved($flush);
        static::deleted($flush);
    }
}
