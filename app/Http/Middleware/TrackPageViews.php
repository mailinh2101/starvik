<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class TrackPageViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Chỉ track GET requests và status 200
        if ($request->isMethod('GET') && $response->getStatusCode() === 200) {
            // Track page view để phân tích SEO
            $this->trackPageView($request);
        }

        return $response;
    }

    /**
     * Track page view for SEO analytics
     */
    private function trackPageView(Request $request): void
    {
        $data = [
            'url' => $request->fullUrl(),
            'user_agent' => $request->userAgent(),
            'referer' => $request->header('referer'),
            'ip' => $request->ip(),
            'timestamp' => now(),
        ];

        // Log page view (có thể thay bằng database hoặc external service)
        Log::channel('pageviews')->info('Page view', $data);

        // Có thể thêm logic để:
        // - Cập nhật popular pages
        // - Track keywords search
        // - Monitor SEO performance
    }
}
