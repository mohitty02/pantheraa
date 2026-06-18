<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LearningCategory extends Model
{
    protected $guarded = [];

    protected $casts = ['is_active' => 'boolean'];

    protected static function booted(): void
    {
        static::saving(function (LearningCategory $c) {
            if (blank($c->slug)) {
                $base = Str::slug($c->name) ?: 'category';
                $slug = $base;
                $i = 2;
                while (static::where('slug', $slug)->where('id', '!=', $c->id)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $c->slug = $slug;
            }
        });
    }

    public function learnings()
    {
        return $this->hasMany(Learning::class, 'category_id');
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true)->orderBy('sort')->orderBy('name');
    }
}
