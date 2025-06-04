<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RedirectMiddleware
{
    /**
     * Handle an incoming request and prevent redirect loops.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        // Wenn wir auf der Root-Route sind und www.mindbeamer.io aufrufen
        if ($request->getHost() === 'www.mindbeamer.io' && $request->path() === '/') {
            Log::info('RedirectMiddleware: www zu non-www Weiterleitung', [
                'host' => $request->getHost(),
                'path' => $request->path(),
                'url' => $request->url(),
                'referer' => $request->header('referer')
            ]);
            
            // Direkt zu https://mindbeamer.io weiterleiten
            return redirect()->to('https://mindbeamer.io', 301);
        }
        
        // Wenn wir auf der Root-Route sind und bereits auf mindbeamer.io sind
        if ($request->getHost() === 'mindbeamer.io' && $request->path() === '/') {
            // Prüfen, ob wir einen Redirect-Cookie haben oder der Referer unsere Domain enthält
            $referer = $request->header('referer');
            $redirectAttempt = $request->cookie('redirect_attempt');
            
            if ($redirectAttempt || ($referer && strpos($referer, 'mindbeamer.io') !== false)) {
                Log::info('RedirectMiddleware: Weiterleitungsschleife erkannt, direkt zu /en', [
                    'host' => $request->getHost(),
                    'path' => $request->path(),
                    'referer' => $referer,
                    'redirect_attempt' => $redirectAttempt
                ]);
                
                // Direkt zur englischen Version weiterleiten
                return redirect()->to('https://mindbeamer.io/en', 302);
            }
            
            // Cookie setzen, um Weiterleitungsschleifen zu erkennen
            $response = $next($request);
            
            if ($response instanceof Response && $response->isRedirection()) {
                Log::info('RedirectMiddleware: Cookie für Weiterleitungserkennung gesetzt', [
                    'target' => $response->headers->get('Location')
                ]);
                
                return $response->withCookie(cookie('redirect_attempt', '1', 1));
            }
            
            return $response;
        }
        
        return $next($request);
    }
}
