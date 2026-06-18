<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('source')->unique();              // e.g. /old-url
            $table->string('destination');                   // path or absolute URL
            $table->unsignedSmallInteger('status_code')->default(301);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('hits')->default(0);
            $table->timestamp('last_hit_at')->nullable();
            $table->string('notes')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
            $table->index('is_active');
        });

        Schema::create('schema_entries', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // admin label
            $table->string('type')->default('Custom');       // Organization, WebSite, FAQPage, Custom…
            $table->string('placement')->default('all');     // all | home
            $table->json('data')->nullable();                // the JSON-LD object
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
            $table->index(['is_active', 'placement']);
        });

        Schema::table('learnings', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('category')
                ->constrained('learning_categories')->nullOnDelete();
            $table->boolean('noindex')->default(false)->after('status');
            $table->string('canonical')->nullable()->after('noindex');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 320)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description']);
        });
        Schema::table('learnings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn(['noindex', 'canonical']);
        });
        Schema::dropIfExists('schema_entries');
        Schema::dropIfExists('redirects');
        Schema::dropIfExists('learning_categories');
    }
};
