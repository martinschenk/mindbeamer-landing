<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CookieCleanupMiddleware
{
    /**
     * Liste der bekannten Google Analytics Cookie-Präfixe
     * 
     * @var array
     */
    protected $gaCookiePrefixes = [
        '_ga',
        '_gid',
        '_gat',
        '_gac',
        '_gali'
    ];
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Standard-Request weiterleiten
        $response = $next($request);
        
        // Cookie-Prefix aus der Konfiguration
        $cookiePrefix = config('laravel-cookie-consent.cookie_prefix', 'MindBeamer');
        
        // Prüfen, ob Analytics deaktiviert wurde
        $analyticsAllowed = $request->cookie("{$cookiePrefix}_cookie_analytics") === 'true';
        
        // Wenn Analytics nicht erlaubt ist, alle GA-Cookies löschen
        if (!$analyticsAllowed) {
            $response = $this->removeAnalyticsCookies($request, $response);
        }
        
        // Prüfen, ob Preferences deaktiviert wurden
        $preferencesAllowed = $request->cookie("{$cookiePrefix}_cookie_preferences") === 'true';
        
        // Wenn Preferences nicht erlaubt sind, Locale-Cookie löschen
        if (!$preferencesAllowed) {
            $response = $this->removeLocaleCookie($response);
        }
        
        return $response;
    }
    
    /**
     * Entfernt alle Google Analytics Cookies
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return \Illuminate\Http\Response
     */
    protected function removeAnalyticsCookies(Request $request, $response)
    {
        // Alle bekannten GA-Cookie-Präfixe durchgehen
        foreach ($this->gaCookiePrefixes as $prefix) {
            // Alle Cookies durchsuchen
            foreach ($request->cookies as $name => $value) {
                // Wenn der Cookie-Name mit einem GA-Präfix beginnt
                if (strpos($name, $prefix) === 0) {
                    // Cookie löschen
                    $response->withCookie(Cookie::forget($name));
                    Log::debug("Google Analytics Cookie gelöscht: {$name}");
                }
            }
        }
        
        return $response;
    }
    
    /**
     * Entfernt das Locale-Cookie
     * 
     * @param  \Illuminate\Http\Response  $response
     * @return \Illuminate\Http\Response
     */
    protected function removeLocaleCookie($response)
    {
        $response->withCookie(Cookie::forget('app_locale'));
        Log::debug("Locale-Cookie gelöscht: app_locale");
        
        return $response;
    }
}
