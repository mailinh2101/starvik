<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // SEO Helper Functions
        Blade::directive('seoTitle', function ($expression) {
            return "<?php echo e($expression . ' | ' . config('app.name')); ?>";
        });

        Blade::directive('seoDescription', function ($expression) {
            return "<?php echo e(Str::limit($expression, 160)); ?>";
        });

        // Share SEO data globally
        View::composer('*', function ($view) {
            $view->with([
                'siteName' => config('app.name'),
                'companyName' => config('seo.company.name'),
                'companyDescription' => config('seo.company.description'),
                'companyPhone' => config('seo.company.phone'),
                'companyEmail' => config('seo.company.email'),
                'companyAddress' => config('seo.company.address'),
                'defaultOgImage' => config('seo.company.logo'),
            ]);
        });
    }
}
