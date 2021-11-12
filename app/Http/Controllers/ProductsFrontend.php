<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsFrontend extends Controller
{
    public function get_products_list(Request $request)
    {
        $products = Product::query()->get();
        return view('products', compact('products'));
    }

    public function get_product_details($slug)
    {
        $product = Product::query()->where('slug','=',$slug)->firstOrFail();
        return view('product-details', compact('product'));
    }
}
