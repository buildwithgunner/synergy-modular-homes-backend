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
    Schema::create('leads', function (Blueprint $table) {
        $table->id();
        $table->foreignId('home_id')->nullable()->constrained('homes')->nullOnDelete();
        $table->string('name');
        $table->string('phone');
        $table->string('email')->nullable();
        $table->text('notes')->nullable();
        $table->string('type')->default('inquiry'); // inquiry, appointment, pre-approval
        $table->string('status')->default('new'); // new, contacted, closed
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
