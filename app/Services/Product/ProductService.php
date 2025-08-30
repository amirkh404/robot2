<?php

namespace App\Services\Product;
use App\Models\Product;

use App\Models\User;

class ProductService implements ProductServiceInterface
{
    public function searchProducts(string $query)
    {
        return Product::where('title', 'like', "%{$query}%")
        ->orWhere('category', 'like', "%{$query}%")
        ->latest()
        ->get();
    }
    
    public function searchAjax(string $query)
    {
        return Product::where('title', 'like', "%{$query}%")
        ->orWhere('category', 'like', "%{$query}%")
        ->limit(10)
        ->get();
    }
}
