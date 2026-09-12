<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('homes', function (Blueprint $table) {
        $table->integer('living_area')->nullable()->after('sqft');
        $table->integer('total_covered_area')->nullable()->after('living_area');
    });
}

public function down(): void
{
    Schema::table('homes', function (Blueprint $table) {
        $table->dropColumn(['living_area', 'total_covered_area']);
    });
}
};
