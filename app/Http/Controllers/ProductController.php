<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with(['thumbnail'])->paginate(15);
    }

    public function show(Product $product)
    {
        $product->load('images');
        return response()->json($product);
    }

}
