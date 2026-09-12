<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('saved_homes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('home_id')->constrained('homes')->cascadeOnDelete();
        $table->timestamps();

        $table->unique(['user_id', 'home_id']);
    });
}

public function down(): void
{
    Schema::dropIfExists('saved_homes');
}
};
