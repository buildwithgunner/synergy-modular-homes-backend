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
    Schema::table('pre_approvals', function (Blueprint $table) {
        // Add sex field (nullable or default)
        $table->string('sex')->nullable()->after('dob');
    });
}

public function down(): void
{
    Schema::table('pre_approvals', function (Blueprint $table) {
        $table->dropColumn('sex');
    });
}
};
