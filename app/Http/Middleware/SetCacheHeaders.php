<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCacheHeaders
{
    /**
     * Handle an incoming request and set appropriate cache headers.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Don't cache if not a successful response
        if (!$response->isSuccessful()) {
            return $response;
        }

        $path = $request->path();
        $extension = pathinfo($request->getPathInfo(), PATHINFO_EXTENSION);

        // Static assets (CSS, JS, Images, Fonts) - long cache
        if (in_array($extension, ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'woff', 'woff2', 'ico'])) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable'); // 1 year
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
            return $response;
        }

        // XML files (sitemap, etc.) - medium cache
        if ($extension === 'xml' || str_contains($path, 'sitemap')) {
            $response->headers->set('Cache-Control', 'public, max-age=300'); // 5 minutes
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 300) . ' GMT');
            return $response;
        }

        // Robots.txt - medium cache
        if (str_contains($path, 'robots.txt')) {
            $response->headers->set('Cache-Control', 'public, max-age=3600'); // 1 hour
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
            return $response;
        }

        // HTML pages - short cache for dynamic content
        if ($response->headers->get('content-type') && str_contains($response->headers->get('content-type'), 'text/html')) {
            $response->headers->set('Cache-Control', 'public, max-age=300'); // 5 minutes
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + 300) . ' GMT');
            return $response;
        }

        return $response;
    }
}