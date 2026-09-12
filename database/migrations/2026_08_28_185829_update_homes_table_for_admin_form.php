<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            if (!Schema::hasColumn('homes', 'house_name')) {
                $table->string('house_name')->nullable()->after('title');
            }
            if (!Schema::hasColumn('homes', 'price_min')) {
                $table->decimal('price_min', 12, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('homes', 'price_max')) {
                $table->decimal('price_max', 12, 2)->nullable()->after('price_min');
            }
            if (!Schema::hasColumn('homes', 'currency')) {
                $table->string('currency', 10)->default('USD')->after('price_max');
            }
            if (!Schema::hasColumn('homes', 'house_type')) {
                $table->string('house_type')->nullable()->after('type');
            }
            if (!Schema::hasColumn('homes', 'living_area_min')) {
                $table->integer('living_area_min')->nullable();
            }
            if (!Schema::hasColumn('homes', 'living_area_max')) {
                $table->integer('living_area_max')->nullable();
            }
            if (!Schema::hasColumn('homes', 'total_covered_area_min')) {
                $table->integer('total_covered_area_min')->nullable();
            }
            if (!Schema::hasColumn('homes', 'total_covered_area_max')) {
                $table->integer('total_covered_area_max')->nullable();
            }
            if (!Schema::hasColumn('homes', 'specs')) {
                $table->json('specs')->nullable();
            }
            if (!Schema::hasColumn('homes', 'amenities')) {
                $table->json('amenities')->nullable();
            }
            if (!Schema::hasColumn('homes', 'images')) {
                $table->json('images')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropColumn([
                'house_name',
                'price_min',
                'price_max',
                'currency',
                'house_type',
                'living_area_min',
                'living_area_max',
                'total_covered_area_min',
                'total_covered_area_max',
                'specs',
                'amenities',
                'images',
            ]);
        });
    }
};