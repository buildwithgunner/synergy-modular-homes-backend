<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            // Price range
            if (!Schema::hasColumn('homes', 'price_min')) {
                $table->decimal('price_min', 12, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('homes', 'price_max')) {
                $table->decimal('price_max', 12, 2)->nullable()->after('price_min');
            }
            if (!Schema::hasColumn('homes', 'currency')) {
                $table->string('currency', 10)->default('USD')->after('price_max');
            }

            // Living area range
            if (!Schema::hasColumn('homes', 'living_area_min')) {
                $table->unsignedInteger('living_area_min')->nullable();
            }
            if (!Schema::hasColumn('homes', 'living_area_max')) {
                $table->unsignedInteger('living_area_max')->nullable();
            }

            // Total covered area range
            if (!Schema::hasColumn('homes', 'total_covered_area_min')) {
                $table->unsignedInteger('total_covered_area_min')->nullable();
            }
            if (!Schema::hasColumn('homes', 'total_covered_area_max')) {
                $table->unsignedInteger('total_covered_area_max')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            $columns = [
                'price_min',
                'price_max',
                'currency',
                'living_area_min',
                'living_area_max',
                'total_covered_area_min',
                'total_covered_area_max',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('homes', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};