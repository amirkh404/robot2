<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function searchByDescription(string $text)
    {
        return Product::where('title', 'LIKE', "%text%")
            ->orWhere('category', 'LIKE', "%text%")
            ->take(5)
            ->get();
    }
}
