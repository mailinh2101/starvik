<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SitemapController;

// Trang chủ
Route::get('/', [HomeController::class, 'index']);

// Sản phẩm
Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
Route::get('/san-pham/noi-bat', [ProductController::class, 'featured'])->name('products.featured');
Route::get('/san-pham/tim-kiem', [ProductController::class, 'search'])->name('products.search');
Route::get('/san-pham/danh-muc/{category}', [ProductController::class, 'category'])->name('products.category');
Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('products.show');

// API endpoints
Route::get('/api/categories', [ProductController::class, 'getCategories']);
Route::get('/api/brands', [ProductController::class, 'getBrands']);

// Tin tức
Route::get('/tin-tuc', [NewsController::class, 'index'])->name('news.index');
Route::get('/tin-tuc/{news}', [NewsController::class, 'show'])->name('news.show');

// Trang liên hệ
Route::get('/lien-he', function () {
    return view('template.contact');
});

// Trang giới thiệu
Route::get('/gioi-thieu', function () {
    return view('template.about');
});

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
