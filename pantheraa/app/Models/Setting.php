<?php

namespace App\Models;

use App\Models\Concerns\FlushesSiteCache;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use FlushesSiteCache;

    protected $guarded = [];

    protected $casts = ['value' => 'array']; // JSON — decodes to native (string/array)

    public static function get(string $key, $default = null)
    {
        $row = static::query()->where('key', $key)->first();

        return $row ? $row->value : $default;
    }

    public static function put(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /** key => value map of all settings. */
    public static function map(): array
    {
        return static::query()->pluck('value', 'key')->all();
    }
}
