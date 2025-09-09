<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SEOMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Chỉ xử lý HTML responses
        if ($response->headers->get('Content-Type') !== 'text/html; charset=UTF-8') {
            return $response;
        }

        $content = $response->getContent();

        // Tự động thêm alt text cho images nếu thiếu
        $content = preg_replace_callback(
            '/<img([^>]*?)src=["\']([^"\']*)["\']([^>]*?)(?:alt=["\'][^"\']*["\'])?([^>]*?)>/i',
            function ($matches) {
                $beforeSrc = $matches[1];
                $src = $matches[2];
                $afterSrc = $matches[3];
                $afterAlt = $matches[4];

                // Kiểm tra xem đã có alt hay chưa
                if (strpos($matches[0], 'alt=') === false) {
                    $filename = pathinfo($src, PATHINFO_FILENAME);
                    $alt = ucwords(str_replace(['-', '_'], ' ', $filename));
                    return "<img{$beforeSrc}src=\"{$src}\"{$afterSrc} alt=\"{$alt}\"{$afterAlt}>";
                }

                return $matches[0];
            },
            $content
        );

        // Thêm loading="lazy" cho images nếu thiếu
        $content = preg_replace(
            '/<img([^>]*?)(?!.*loading=)([^>]*?)>/i',
            '<img$1 loading="lazy"$2>',
            $content
        );

        $response->setContent($content);

        return $response;
    }
}
