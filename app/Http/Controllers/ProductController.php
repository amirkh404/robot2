<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Product\ProductServiceInterface;

class ProductController extends Controller
{
    public function __construct(protected ProductServiceInterface $productService) {}

    public function search(Request $request)
    {
        $query = $request->input('q');

        if(!$query) {
            return redirect()->back()->with('error', 'یک عبارت برای جستوجو وارد کنید');
        }

        $products = $this->productService->searchProducts($query);

        return view('products.index',compact('products'));
    }

    public function searchAjax(Request $request)
    {
        $query = $request->input('q');
        $results = $this->productService->searchAjax($query);

        return response()->json($results);
    }
}
