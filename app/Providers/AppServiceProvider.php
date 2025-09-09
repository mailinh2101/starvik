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
                'companyName' => env('COMPANY_NAME'),
                'companyDescription' => env('COMPANY_DESCRIPTION'),
                'companyPhone' => env('COMPANY_PHONE'),
                'companyEmail' => env('COMPANY_EMAIL'),
                'companyAddress' => env('COMPANY_ADDRESS'),
                'defaultOgImage' => env('COMPANY_LOGO_URL', asset('images/logo/logo-starvik.png')),
            ]);
        });
    }
}
