<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Helpers\SEOHelper;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()
                   ->orderBy('published_at', 'desc')
                   ->paginate(10);

        // SEO cho trang danh sách tin tức
        $seoData = [
            'title' => 'Tin tức - ' . config('app.name'),
            'description' => 'Cập nhật tin tức mới nhất từ ' . config('seo.company.name') . '. Đọc các bài viết về sản phẩm, dịch vụ và hoạt động của công ty.',
            'keywords' => 'tin tức, bài viết, ' . config('seo.defaults.keywords'),
            'canonical' => url('/tin-tuc'),
            'og_image' => asset('images/banner-after.jpg'),
        ];

        return view('news.index', compact('news', 'seoData'));
    }

    public function show(News $news)
    {
        if (!$news->isPublished()) {
            abort(404);
        }

        // Get related news (same category, different article)
        $relatedNews = collect();
        if ($news->category) {
            $relatedNews = News::published()
                ->where('category', $news->category)
                ->where('id', '!=', $news->id)
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        }

        // If not enough related news from same category, get latest news
        if ($relatedNews->count() < 3) {
            $additionalNews = News::published()
                ->where('id', '!=', $news->id)
                ->orderBy('published_at', 'desc')
                ->limit(3 - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->merge($additionalNews)->unique('id');
        }

        // SEO tự động cho bài viết tin tức
        $seoData = [
            'title' => $news->getSeoTitle() . ' - ' . config('app.name'),
            'description' => $news->getSeoDescription(),
            'keywords' => $news->getSeoKeywords(),
            'canonical' => $news->getCanonicalUrl(),
            'og_image' => $news->getOgImage(),
            'type' => 'article',
            'published_time' => $news->published_at?->toISOString(),
            'modified_time' => $news->updated_at?->toISOString(),
            'author' => $news->author ?? config('seo.company.name'),
        ];

        return view('news.show', compact('news', 'seoData', 'relatedNews'));
    }

    public function latest($limit = 5)
    {
        $latestNews = News::published()
                         ->orderBy('published_at', 'desc')
                         ->limit($limit)
                         ->get();

        return $latestNews;
    }
}
