<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimpleProduct;
use App\Helpers\SEOHelper;

class ProductController extends Controller
{
    public function index()
    {
        $products = SimpleProduct::active()->paginate(12);

        // SEO cho trang danh sách sản phẩm
        $seoData = [
            'title' => 'Sản phẩm - ' . config('app.name'),
            'description' => 'Khám phá bộ sưu tập sản phẩm chất lượng cao từ ' . config('seo.company.name') . '. Đồ gia dụng, thực phẩm chức năng, máy xay sinh tố và nhiều hơn nữa.',
            'keywords' => 'sản phẩm, đồ gia dụng, thực phẩm chức năng, máy xay sinh tố, ' . config('seo.defaults.keywords'),
            'canonical' => url('/san-pham'),
            'og_image' => asset('images/banner-after.jpg'),
        ];

        return view('products.index', compact('products', 'seoData'));
    }

    public function show($slug)
    {
        $product = SimpleProduct::where('slug', $slug)->active()->firstOrFail();

        // Get related products (same category, different product)
        $relatedProducts = collect();
        if ($product->category) {
            $relatedProducts = SimpleProduct::where('category', $product->category)
                ->where('id', '!=', $product->id)
                ->active()
                ->limit(4)
                ->get();
        }

        // SEO tự động cho trang chi tiết sản phẩm
        $seoData = [
            'title' => $product->getSeoTitle() . ' - ' . config('app.name'),
            'description' => $product->getSeoDescription(),
            'keywords' => $product->getSeoKeywords(),
            'canonical' => $product->getCanonicalUrl(),
            'og_image' => $product->getOgImage(),
            'type' => 'product',
            'price' => $product->price ?? null,
            'availability' => $product->is_active ? 'InStock' : 'OutOfStock',
            'brand' => $product->brand ?? config('seo.company.name'),
        ];

        return view('products.show', compact('product', 'relatedProducts', 'seoData'));
    }

    public function featured()
    {
        $products = SimpleProduct::where('is_featured', true)->paginate(12);

        // SEO cho trang sản phẩm nổi bật
        $seoData = [
            'title' => 'Sản phẩm nổi bật - ' . config('app.name'),
            'description' => 'Khám phá các sản phẩm nổi bật được lựa chọn đặc biệt từ ' . config('seo.company.name') . '. Chất lượng cao, giá cả hợp lý.',
            'keywords' => 'sản phẩm nổi bật, khuyến mãi, ' . config('seo.defaults.keywords'),
            'canonical' => url('/san-pham/noi-bat'),
            'og_image' => asset('images/banner-after.jpg'),
        ];

        return view('products.featured', compact('products', 'seoData'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = SimpleProduct::where('name', 'like', "%{$query}%")
                                ->orWhere('description', 'like', "%{$query}%")
                                ->active()
                                ->paginate(12);

        // SEO cho trang tìm kiếm sản phẩm
        $seoData = [
            'title' => "Tìm kiếm: {$query} - " . config('app.name'),
            'description' => "Kết quả tìm kiếm cho '{$query}' tại " . config('seo.company.name') . ". Tìm thấy " . $products->total() . " sản phẩm.",
            'keywords' => $query . ', tìm kiếm sản phẩm, ' . config('seo.defaults.keywords'),
            'canonical' => url('/san-pham/tim-kiem?q=' . urlencode($query)),
            'og_image' => asset('images/banner-after.jpg'),
            'robots' => 'noindex, follow', // Không index trang tìm kiếm
        ];

        return view('products.search', compact('products', 'query', 'seoData'));
    }

    public function category($category)
    {
        $products = SimpleProduct::where('category', $category)->active()->paginate(12);

        // SEO cho trang danh mục sản phẩm
        $seoData = [
            'title' => "Danh mục " . ucfirst($category) . " - " . config('app.name'),
            'description' => "Khám phá sản phẩm trong danh mục {$category} tại " . config('seo.company.name') . ". Chất lượng cao, giá cả hợp lý.",
            'keywords' => $category . ', sản phẩm ' . $category . ', ' . config('seo.defaults.keywords'),
            'canonical' => url('/san-pham/danh-muc/' . urlencode($category)),
            'og_image' => asset('images/banner-after.jpg'),
        ];

        return view('products.category', compact('products', 'category', 'seoData'));
    }

    public function getCategories()
    {
        $categories = SimpleProduct::distinct()->pluck('category')->filter();
        return response()->json($categories);
    }

    public function getBrands()
    {
        $brands = SimpleProduct::distinct()->pluck('brand')->filter();
        return response()->json($brands);
    }
}
