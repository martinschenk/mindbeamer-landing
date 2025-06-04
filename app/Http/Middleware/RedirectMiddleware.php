<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        // Direktes Logging in eine Datei, falls Log-Facade nicht funktioniert
        $logPath = storage_path('logs/redirect.log');
        $logDir = dirname($logPath);
        
        // Stelle sicher, dass das Log-Verzeichnis existiert und beschreibbar ist
        if (!File::exists($logDir)) {
            File::makeDirectory($logDir, 0755, true);
        }
        
        $logMessage = date('Y-m-d H:i:s') . ' - ' . $request->getHost() . ' - ' . $request->path() . ' - ' . $request->fullUrl();
        File::append($logPath, $logMessage . PHP_EOL);
        
        // Wenn wir auf der Root-Route sind und www.mindbeamer.io aufrufen
        if ($request->getHost() === 'www.mindbeamer.io' && $request->path() === '/') {
            $logMessage = date('Y-m-d H:i:s') . ' - RedirectMiddleware: www zu non-www Weiterleitung - ' . $request->fullUrl();
            File::append($logPath, $logMessage . PHP_EOL);
            
            // Direkt zu https://mindbeamer.io weiterleiten
            return redirect()->to('https://mindbeamer.io', 301);
        }
        
        // Wenn wir auf der Root-Route sind und bereits auf mindbeamer.io sind
        if ($request->getHost() === 'mindbeamer.io' && $request->path() === '/') {
            // Prüfen, ob wir einen Redirect-Cookie haben oder der Referer unsere Domain enthält
            $referer = $request->header('referer');
            $redirectAttempt = $request->cookie('redirect_attempt');
            
            $logMessage = date('Y-m-d H:i:s') . ' - Root-Route auf mindbeamer.io - Referer: ' . ($referer ?? 'none') . ' - Cookie: ' . ($redirectAttempt ? 'yes' : 'no');
            File::append($logPath, $logMessage . PHP_EOL);
            
            if ($redirectAttempt || ($referer && strpos($referer, 'mindbeamer.io') !== false)) {
                $logMessage = date('Y-m-d H:i:s') . ' - RedirectMiddleware: Weiterleitungsschleife erkannt, direkt zu /en';
                File::append($logPath, $logMessage . PHP_EOL);
                
                // Direkt zur englischen Version weiterleiten
                return redirect()->to('https://mindbeamer.io/en', 302);
            }
            
            // Cookie setzen, um Weiterleitungsschleifen zu erkennen
            $response = $next($request);
            
            if ($response instanceof Response && $response->isRedirection()) {
                $logMessage = date('Y-m-d H:i:s') . ' - RedirectMiddleware: Cookie für Weiterleitungserkennung gesetzt - Target: ' . $response->headers->get('Location');
                File::append($logPath, $logMessage . PHP_EOL);
                
                return $response->withCookie(cookie('redirect_attempt', '1', 1));
            }
            
            return $response;
        }
        
        return $next($request);
    }
}
