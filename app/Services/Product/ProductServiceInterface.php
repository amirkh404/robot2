<?php

namespace App\Services\Product;

interface ProductServiceInterface
{
    public function searchProducts(string $query);
    public function searchAjax(string $query);
}
