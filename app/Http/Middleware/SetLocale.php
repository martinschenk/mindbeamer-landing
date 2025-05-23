<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = Config::get('languages.available_locales', ['en', 'de', 'es']);
        $defaultLocale = Config::get('languages.default_locale', 'de');
        
        // Get locale from URL parameter first
        $locale = $request->route('locale');
        
        // Check if locale from URL is valid
        if ($locale && in_array($locale, $supportedLocales, true)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
            return $next($request);
        }
        
        // Check if locale is explicitly set in the request
        if ($request->has('locale') && in_array($request->locale, $supportedLocales, true)) {
            Session::put('locale', $request->locale);
        }
        
        // If no locale in session, try to detect from browser
        if (!Session::has('locale')) {
            $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE') ?? '', 0, 2);
            
            if (in_array($browserLang, $supportedLocales, true)) {
                Session::put('locale', $browserLang);
            } else {
                Session::put('locale', $defaultLocale);
            }
        }
        
        // Set the application locale
        App::setLocale(Session::get('locale', $defaultLocale));
        
        return $next($request);
    }
}
