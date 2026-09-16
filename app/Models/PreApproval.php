<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'dob',
        'ssn',
        'email',
        'cell_phone',
        'credit_score',
        'purchasing_method',
        'co_applicant',
        'how_soon',
        'address',
        'city',
        'state',
        'zip',
        'years_at_address',
        'housing_situation',
        'rent_or_mortgage',
        'proof_of_income',
        'form_of_payment_1',
        'form_of_payment_2',
        'income_before_tax',
        'pay_frequency',
        'overtime_amount',
        'preferred_bedrooms',
        'preferred_home_size',
        'down_payment',
        'monthly_budget',
        'signature',
        'status',
    ];

    protected $casts = [
        'proof_of_income' => 'array',
    ];
}