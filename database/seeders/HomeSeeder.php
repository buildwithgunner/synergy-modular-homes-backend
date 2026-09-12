<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    public function run(): void
    {
        $homes = [
            [
                'title' => 'Cozy Single Wide - 2 Bed',
                'price' => 45000,
                'beds' => 2,
                'baths' => 1,
                'sqft' => 780,
                'location' => 'Austin, TX',
                'type' => 'Single Wide',
                'description' => 'Well-maintained single-wide with open floor plan. Perfect for first-time buyers.',
                'image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800',
                'status' => 'available',
                'is_featured' => true,
            ],
            [
                'title' => 'Modern Double Wide - 3 Bed',
                'price' => 89500,
                'beds' => 3,
                'baths' => 2,
                'sqft' => 1450,
                'location' => 'Dallas, TX',
                'type' => 'Double Wide',
                'description' => 'Spacious modern double-wide with open living area and large windows.',
                'image' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800',
                'status' => 'available',
                'is_featured' => true,
            ],
            [
                'title' => 'Luxury Double Wide - 4 Bed',
                'price' => 125000,
                'beds' => 4,
                'baths' => 2,
                'sqft' => 1680,
                'location' => 'Houston, TX',
                'type' => 'Double Wide',
                'description' => 'Premium double-wide with luxury finishes and spacious layout.',
                'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=800',
                'status' => 'available',
                'is_featured' => false,
            ],
            [
                'title' => 'Bright Single Wide',
                'price' => 52000,
                'beds' => 2,
                'baths' => 2,
                'sqft' => 860,
                'location' => 'San Antonio, TX',
                'type' => 'Single Wide',
                'description' => 'Bright and comfortable single-wide, move-in ready.',
                'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
                'status' => 'available',
                'is_featured' => false,
            ],
            [
                'title' => 'Family Double Wide',
                'price' => 98000,
                'beds' => 3,
                'baths' => 2,
                'sqft' => 1520,
                'location' => 'Fort Worth, TX',
                'type' => 'Double Wide',
                'description' => 'Perfect family home with good flow and comfortable bedrooms.',
                'image' => 'https://images.unsplash.com/photo-1600047509358-9dc75590d7e9?w=800',
                'status' => 'available',
                'is_featured' => true,
            ],
            [
                'title' => 'Modern Tiny Home',
                'price' => 32500,
                'beds' => 1,
                'baths' => 1,
                'sqft' => 400,
                'location' => 'Park Model Ready',
                'type' => 'Tiny Home',
                'description' => 'Stylish modern tiny home perfect for minimalist living.',
                'image' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?w=800',
                'status' => 'available',
                'is_featured' => false,
            ],
        ];

        foreach ($homes as $home) {
            Home::create($home);
        }
    }
}