<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimpleProduct;

class SimpleProductController extends Controller
{
    public function index(Request $request)
    {
        $query = SimpleProduct::active()->orderBy('sort_order', 'asc');

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->byBrand($request->brand);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(12);

        // Get categories and brands for filter
        $categories = SimpleProduct::active()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        $brands = SimpleProduct::active()
            ->select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->pluck('brand');

        return view('simple-products.index', compact('products', 'categories', 'brands'));
    }

    public function show(SimpleProduct $simpleProduct)
    {
        if (!$simpleProduct->is_active) {
            abort(404);
        }

        // Get related products
        $relatedProducts = SimpleProduct::active()
            ->where('category', $simpleProduct->category)
            ->where('id', '!=', $simpleProduct->id)
            ->orderBy('sort_order', 'asc')
            ->limit(4)
            ->get();

        return view('simple-products.show', compact('simpleProduct', 'relatedProducts'));
    }

    public function featured()
    {
        $featuredProducts = SimpleProduct::active()
            ->featured()
            ->orderBy('sort_order', 'asc')
            ->paginate(12);

        return view('simple-products.featured', compact('featuredProducts'));
    }

    public function category($category)
    {
        $products = SimpleProduct::active()
            ->byCategory($category)
            ->orderBy('sort_order', 'asc')
            ->paginate(12);

        return view('simple-products.category', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $products = SimpleProduct::active()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->orderBy('sort_order', 'asc')
            ->paginate(12);

        return view('simple-products.search', compact('products', 'query'));
    }
}
