<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Log;

class CleanupGACookies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Prüfen, ob Cookie-Consent vorhanden ist und Analytics deaktiviert ist
        $cookiePrefix = config('laravel-cookie-consent.cookie_prefix', 'MindBeamer');
        $analyticsCookieName = "{$cookiePrefix}_cookie_analytics";
        
        // Weiterleiten an die nächste Middleware
        $response = $next($request);
        
        // Wenn die Analytics-Cookie auf "false" gesetzt ist, lösche alle Google Analytics Cookies
        if ($request->cookie($analyticsCookieName) === 'false') {
            $this->removeAllGACookies($response);
        }
        
        return $response;
    }
    
    /**
     * Entfernt alle Google Analytics-Cookies
     *
     * @param  \Illuminate\Http\Response|\Illuminate\Http\JsonResponse  $response
     * @return void
     */
    private function removeAllGACookies($response)
    {
        // Liste aller möglichen Google Analytics Cookie-Präfixe
        $cookiePrefixes = ['_ga', '_gid', '_gat', '_gac', '_gali', '_gat_gtag'];
        
        // Alle Cookies aus dem Request holen
        $cookies = request()->cookies->all();
        
        foreach ($cookies as $name => $value) {
            // Prüfen, ob es sich um ein Google Analytics Cookie handelt
            $isGACookie = false;
            foreach ($cookiePrefixes as $prefix) {
                if (strpos($name, $prefix) === 0) {
                    $isGACookie = true;
                    break;
                }
            }
            
            if ($isGACookie) {
                // Cookie für verschiedene Domains löschen
                $domains = [
                    null, // Aktueller Host
                    '.mindbeamer.io',
                    'mindbeamer.io',
                    'www.mindbeamer.io',
                    request()->getHost(),
                    '.' . request()->getHost(),
                ];
                
                foreach ($domains as $domain) {
                    // Wenn wir eine Response haben, die Cookies setzen kann
                    if (method_exists($response, 'withCookie')) {
                        $cookie = new Cookie(
                            $name,              // name
                            '',                 // value
                            time() - 3600,      // expire (in past)
                            '/',                // path
                            $domain,            // domain
                            false,              // secure
                            false,              // httpOnly
                            false,              // raw
                            'Lax'               // sameSite
                        );
                        
                        $response->headers->setCookie($cookie);
                        
                        // Auch mit SameSite=None, Secure testen
                        $cookie = new Cookie(
                            $name,              // name
                            '',                 // value
                            time() - 3600,      // expire (in past)
                            '/',                // path
                            $domain,            // domain
                            true,               // secure
                            false,              // httpOnly
                            false,              // raw
                            'None'              // sameSite
                        );
                        
                        $response->headers->setCookie($cookie);
                    }
                }
                
                Log::info("Google Analytics Cookie gelöscht: {$name}");
            }
        }
    }
}
