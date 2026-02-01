<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        if ($q) {
            $products = Product::where('name', 'like', "%$q%")->get();
        } else {
            $products = Product::all();
        }

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.products_detail', compact('product'));
    }
}
