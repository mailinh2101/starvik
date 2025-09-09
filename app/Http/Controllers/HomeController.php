<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimpleProduct;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured products
        $featuredProducts = SimpleProduct::active()
            ->featured()
            ->orderBy('sort_order', 'asc')
            ->limit(8)
            ->get();

        // Get latest products
        $latestProducts = SimpleProduct::active()
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Get products by category
        $categories = SimpleProduct::active()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->limit(6)
            ->pluck('category');

        $productsByCategory = [];
        foreach ($categories as $category) {
            $productsByCategory[$category] = SimpleProduct::active()
                ->byCategory($category)
                ->orderBy('sort_order', 'asc')
                ->limit(4)
                ->get();
        }

        // Get latest news
        $latestNews = News::published()
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('template.home', compact(
            'featuredProducts',
            'latestProducts',
            'productsByCategory',
            'latestNews'
        ));
    }
}
