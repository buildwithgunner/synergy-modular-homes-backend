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
        if (!Schema::hasTable('pre_approvals')) {
            Schema::create('pre_approvals', function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('middle_name')->nullable();
                $table->string('last_name');
                $table->string('dob');
                $table->string('ssn');
                $table->string('email');
                $table->string('cell_phone');
                $table->string('credit_score')->nullable();
                $table->string('purchasing_method');
                $table->string('co_applicant')->nullable();
                $table->string('how_soon')->nullable();
                $table->string('address');
                $table->string('city');
                $table->string('state');
                $table->string('zip');
                $table->string('years_at_address')->nullable();
                $table->string('housing_situation')->nullable();
                $table->string('rent_or_mortgage')->nullable();
                $table->json('proof_of_income')->nullable();
                $table->string('form_of_payment_1')->nullable();
                $table->string('form_of_payment_2')->nullable();
                $table->string('income_before_tax')->nullable();
                $table->string('pay_frequency')->nullable();
                $table->string('overtime_amount')->nullable();
                $table->string('preferred_bedrooms')->nullable();
                $table->string('preferred_home_size')->nullable();
                $table->string('down_payment')->nullable();
                $table->string('monthly_budget')->nullable();
                $table->string('signature');
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_approvals');
    }
};