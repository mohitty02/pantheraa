<?php

namespace Database\Seeders;

use App\Models\Learning;
use App\Models\LearningCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LearningCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $names = collect(config('site.learnings.categories', []))
            ->merge(Learning::query()->whereNotNull('category')->pluck('category'))
            ->map(fn ($n) => trim($n))->filter()->unique()->values();

        foreach ($names as $i => $name) {
            LearningCategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'sort' => $i, 'is_active' => true]
            );
        }

        // Backfill category_id on existing learnings from their denormalized name.
        Learning::query()->whereNull('category_id')->whereNotNull('category')->get()
            ->each(function (Learning $l) {
                $cat = LearningCategory::where('slug', Str::slug($l->category))->first();
                if ($cat) {
                    $l->forceFill(['category_id' => $cat->id])->saveQuietly();
                }
            });
    }
}
