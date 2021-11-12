<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsFrontend extends Controller
{

    /**
     * Get Products List
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function get_products_list(Request $request)
    {
        $products = Product::query()->get();
        return view('products', compact('products'));
    }

    /**
     * Get Product Details
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function get_product_details($slug)
    {
        $product = Product::query()->where('slug','=',$slug)->firstOrFail();
        return view('product-details', compact('product'));
    }
}
