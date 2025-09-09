<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\News;
use App\Models\SimpleProduct;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap for the website';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        $sitemap = Sitemap::create();

        // Add static pages
        $staticPages = config('seo.sitemap.static_pages', []);
        foreach ($staticPages as $url => $settings) {
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(now())
                    ->setChangeFrequency($settings['change_frequency'] ?? Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority($settings['priority'] ?? 0.5)
            );
            $this->line("Added static page: {$url}");
        }

        // Add dynamic content from models
        $dynamicModels = config('seo.sitemap.dynamic_models', []);
        foreach ($dynamicModels as $modelClass => $settings) {
            if (class_exists($modelClass)) {
                try {
                    $model = new $modelClass;
                    $count = 0;

                    $model->chunk(100, function($items) use ($sitemap, $settings, &$count) {
                        foreach ($items as $item) {
                            $url = str_replace('{id}', $item->id, $settings['route_pattern']);
                            if (isset($item->slug)) {
                                $url = str_replace('{id}', $item->slug, $settings['route_pattern']);
                            }

                            $sitemap->add(
                                Url::create($url)
                                    ->setLastModificationDate($item->updated_at ?? now())
                                    ->setChangeFrequency($settings['change_frequency'] ?? Url::CHANGE_FREQUENCY_WEEKLY)
                                    ->setPriority($settings['priority'] ?? 0.7)
                            );
                            $count++;
                        }
                    });

                    $this->line("Added {$count} items from {$modelClass}");
                } catch (\Exception $e) {
                    $this->error("Error processing {$modelClass}: " . $e->getMessage());
                }
            }
        }

        // Save sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully at public/sitemap.xml');
    }
}
