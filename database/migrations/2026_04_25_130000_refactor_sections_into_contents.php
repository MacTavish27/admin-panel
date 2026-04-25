<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('sections', 'name')) {
            Schema::table('sections', function (Blueprint $table) {
                $table->string('name')->nullable()->after('type');
            });
        }

        foreach (DB::table('sections')->select('id', 'type', 'title')->get() as $section) {
            $name = $section->title ?: Str::headline(str_replace('_', ' ', $section->type));

            DB::table('sections')
                ->where('id', $section->id)
                ->update(['name' => $name]);
        }

        if (Schema::hasTable('section_items') && ! Schema::hasTable('section_contents')) {
            Schema::rename('section_items', 'section_contents');
        }

        if (Schema::hasTable('section_contents')) {
            if (! Schema::hasColumn('section_contents', 'key')) {
                Schema::table('section_contents', function (Blueprint $table) {
                    $table->string('key')->nullable()->after('section_id');
                });
            }

            if (! Schema::hasColumn('section_contents', 'kind')) {
                Schema::table('section_contents', function (Blueprint $table) {
                    $table->string('kind')->default('content')->after('key');
                });
            }
        }

        foreach (
            DB::table('section_contents')
                ->join('sections', 'sections.id', '=', 'section_contents.section_id')
                ->select('section_contents.id', 'sections.type')
                ->get() as $content
        ) {
            $kind = match ($content->type) {
                'faq' => 'faq_item',
                'header' => 'rich_text',
                default => 'content',
            };

            DB::table('section_contents')
                ->where('id', $content->id)
                ->update(['kind' => $kind]);
        }

        if (! Schema::hasTable('section_content_translations')) {
            Schema::create('section_content_translations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('section_content_id')->constrained('section_contents')->cascadeOnDelete();
                $table->string('locale');
                $table->string('title')->nullable();
                $table->text('content')->nullable();
                $table->timestamps();

                $table->index('section_content_id');
                $table->index('locale');
                $table->unique(['section_content_id', 'locale']);
            });
        }

        $timestamp = now();
        $hasSectionTranslations = Schema::hasTable('section_translations');

        foreach (DB::table('sections')->select('id', 'title', 'content')->get() as $section) {
            $hasDefaultHeading = $section->title || $section->content;
            $hasTranslatedHeading = $hasSectionTranslations
                ? DB::table('section_translations')->where('section_id', $section->id)->exists()
                : false;

            if (! $hasDefaultHeading && ! $hasTranslatedHeading) {
                continue;
            }

            $headingId = DB::table('section_contents')
                ->where('section_id', $section->id)
                ->where('kind', 'section_heading')
                ->where('key', 'section-heading')
                ->value('id');

            if (! $headingId) {
                $headingId = DB::table('section_contents')->insertGetId([
                    'section_id' => $section->id,
                    'key' => 'section-heading',
                    'kind' => 'section_heading',
                    'title' => $section->title,
                    'content' => $section->content,
                    'image' => null,
                    'extra' => null,
                    'order' => -1,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }

            if ($hasSectionTranslations) {
                foreach (DB::table('section_translations')->where('section_id', $section->id)->get() as $translation) {
                    DB::table('section_content_translations')->updateOrInsert(
                        [
                            'section_content_id' => $headingId,
                            'locale' => $translation->locale,
                        ],
                        [
                            'title' => $translation->title,
                            'content' => $translation->content,
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ]
                    );
                }
            }
        }

        if (Schema::hasTable('section_translations')) {
            Schema::drop('section_translations');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('section_content_translations')) {
            Schema::drop('section_content_translations');
        }

        if (Schema::hasTable('section_contents') && ! Schema::hasTable('section_items')) {
            Schema::rename('section_contents', 'section_items');
        }

        if (Schema::hasTable('section_items')) {
            if (Schema::hasColumn('section_items', 'kind')) {
                Schema::table('section_items', function (Blueprint $table) {
                    $table->dropColumn('kind');
                });
            }

            if (Schema::hasColumn('section_items', 'key')) {
                Schema::table('section_items', function (Blueprint $table) {
                    $table->dropColumn('key');
                });
            }
        }

        if (Schema::hasColumn('sections', 'name')) {
            Schema::table('sections', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }

        if (! Schema::hasTable('section_translations')) {
            Schema::create('section_translations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('section_id')->constrained()->cascadeOnDelete();
                $table->string('locale');
                $table->string('title')->nullable();
                $table->text('content')->nullable();
                $table->timestamps();
            });
        }
    }
};
