<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'house_name',
        'price',
        'price_min',
        'price_max',
        'currency',
        'beds',
        'baths',
        'sqft',
        'living_area',
        'living_area_min',
        'living_area_max',
        'total_covered_area',
        'total_covered_area_min',
        'total_covered_area_max',
        'location',
        'type',
        'house_type',
        'description',
        'image',
        'images',
        'specs',
        'amenities',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'price_min' => 'decimal:2',
        'price_max' => 'decimal:2',
        'is_featured' => 'boolean',
        'specs' => 'array',
        'amenities' => 'array',
        'images' => 'array',
    ];
}