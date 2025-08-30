<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'کیت ورزشی رونالدو',
            'category' => 'کیت ورزشی',
            'original_price' => 950000,
            'image' => 'image4.png',
        ]);

        Product::create([
            'title' => 'کت مشکی',
            'category' => 'کت',
            'original_price' => 1200000,
            'image' => 'image5.png',
        ]);

        Product::create([
            'title' => 'پیراهن بیرونی',
            'category' => 'پیراهن',
            'original_price' => 1400000,
            'image' => 'image3.png',
        ]);

        Product::create([
            'title' => 'پیراهن خونگی',
            'category' => 'پیراهن',
            'original_price' => 1000000,
            'image' => 'image2.png',
        ]);

        Product::create([
            'title' => 'لباس عروس',
            'category' => 'مجلسی',
            'original_price' => 11800000,
            'discount_price' => 10000000,
            'discount_percent' => 20,
            'image' => 'image6.png',
        ]);

        Product::create([
            'title' => 'لباس خونگی بچه',
            'category' => 'بچه گانه',
            'original_price' => 1200000,
            'image' => 'image1.png',
        ]);
    }
}
