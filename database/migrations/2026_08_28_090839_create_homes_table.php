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
    Schema::create('homes', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->decimal('price', 12, 2);
        $table->integer('beds')->default(0);
        $table->integer('baths')->default(0);
        $table->integer('sqft')->nullable();
        $table->string('location')->nullable();
        $table->string('type')->nullable(); // Single Wide, Double Wide, Tiny Home, etc.
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->string('status')->default('available'); // available, sold, pending
        $table->boolean('is_featured')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
