<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // Thêm các trang tĩnh từ config
        $staticPages = config('seo.sitemap.static_pages', []);
        foreach ($staticPages as $url => $settings) {
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(now())
                    ->setChangeFrequency($settings['change_frequency'] ?? Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority($settings['priority'] ?? 0.5)
            );
        }

        // Thêm các trang động từ models
        $dynamicModels = config('seo.sitemap.dynamic_models', []);
        foreach ($dynamicModels as $modelClass => $settings) {
            if (class_exists($modelClass)) {
                try {
                    $model = new $modelClass;
                    $model->all()->each(function ($item) use ($sitemap, $settings) {
                        $url = str_replace('{id}', $item->id, $settings['route_pattern']);
                        $sitemap->add(
                            Url::create($url)
                                ->setLastModificationDate($item->updated_at ?? now())
                                ->setChangeFrequency($settings['change_frequency'] ?? Url::CHANGE_FREQUENCY_WEEKLY)
                                ->setPriority($settings['priority'] ?? 0.7)
                        );
                    });
                } catch (\Exception $e) {
                    // Bỏ qua nếu model hoặc table không tồn tại
                    \Log::warning("Sitemap: Could not process model {$modelClass}: " . $e->getMessage());
                }
            }
        }

        return $sitemap->toResponse(request());
    }
}
