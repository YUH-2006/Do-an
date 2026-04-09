<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        $keyword = $request->input('keyword') ?: $request->input('q');
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $category = trim($request->input('category', ''));
        if ($category !== '') {
            $query->whereRaw('TRIM(category) = ?', [$category]);
        }

        $products = $query->get();
        $categories = Product::select('category')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.products_detail', compact('product'));
    }
}
