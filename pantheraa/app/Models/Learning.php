<?php

namespace App\Models;

use App\Support\Markdown;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Learning extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'body', 'category', 'category_id', 'tags',
        'cover_path', 'status', 'published_at', 'views',
        'reading_minutes', 'noindex', 'canonical', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'tags'         => 'array',
        'published_at' => 'datetime',
        'noindex'      => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Learning $learning) {
            if (blank($learning->slug)) {
                $learning->slug = static::uniqueSlug($learning->title, $learning->id);
            }
            // keep the denormalized category name in sync with the chosen category
            if ($learning->category_id) {
                $learning->category = optional(LearningCategory::find($learning->category_id))->name ?: $learning->category;
            }
            // estimate reading time from the body (~200 words/min)
            $words = str_word_count(strip_tags((string) $learning->body));
            $learning->reading_minutes = max(1, (int) ceil($words / 200));
        });
    }

    public function categoryModel()
    {
        return $this->belongsTo(LearningCategory::class, 'category_id');
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'learning';
        $slug = $base;
        $i = 2;
        while (static::withTrashed()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /** Published, visible now. */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function getIsLiveAttribute(): bool
    {
        return $this->status === 'published'
            && $this->published_at
            && $this->published_at->lessThanOrEqualTo(now());
    }

    public function getUrlAttribute(): string
    {
        return url('/learnings/' . $this->slug);
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_path ? asset('uploads/' . $this->cover_path) : null;
    }

    /** Rendered HTML from the Markdown body (code + math + images). */
    public function getRenderedBodyAttribute(): string
    {
        return Markdown::toHtml((string) $this->body);
    }

    public function getTagListAttribute(): array
    {
        return array_values(array_filter((array) ($this->tags ?? [])));
    }
}
