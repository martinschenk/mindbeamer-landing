<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\LocaleService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * @var LocaleService
     */
    protected LocaleService $localeService;
    
    /**
     * Constructor with service injection
     * 
     * @param LocaleService $localeService
     */
    public function __construct(LocaleService $localeService)
    {
        $this->localeService = $localeService;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Debug-Logging für jede Anfrage
        Log::info("=== MIDDLEWARE DEBUG ===");
        Log::info("URL: " . $request->url());
        Log::info("Session locale: " . Session::get('locale', 'none'));
        Log::info("Session ID: " . Session::getId());
        Log::info("App locale before: " . App::getLocale());
        Log::info("HTTP_ACCEPT_LANGUAGE: " . ($request->server('HTTP_ACCEPT_LANGUAGE') ?? 'none'));
        
        $supportedLocales = $this->localeService->getAvailableLocales();
        $defaultLocale = $this->localeService->getDefaultLocale();
        $debug = Config::get('app.debug', false);
        
        // Prioritätsreihenfolge für die Locale-Bestimmung:
        // 1. URL-Parameter (wichtigste) 
        // 2. Session (zweitwichtigste)
        // 3. Cookie (drittwichtigste)
        // 4. Browser-Sprache (am unwichtigsten)
        // 5. Default-Locale (Fallback)
        
        $locale = null;
        $source = 'default';
        
        // 1. URL-Parameter hat höchste Priorität
        $urlLocale = $request->route('locale');
        if ($urlLocale && in_array($urlLocale, $supportedLocales, true)) {
            // Normalisieren (z.B. 'zh-CN' zu 'zh_CN')
            $locale = $this->localeService->normalizeLocale($urlLocale);
            $source = 'url';
            
            // URL-Parameter in Session speichern für spätere Requests
            Session::put('locale', $locale);
        }
        // 2. Session hat nächsthöhere Priorität
        else if (Session::has('locale')) {
            $sessionLocale = Session::get('locale');
            if (in_array($sessionLocale, $supportedLocales, true)) {
                $locale = $sessionLocale;
                $source = 'session';
            }
        }
        // 3. Cookie hat dritthöchste Priorität
        else if ($cookieLocale = $request->cookie('app_locale')) {
            // Normalisieren (z.B. 'zh-CN' zu 'zh_CN')
            $normalizedLocale = $this->localeService->normalizeLocale($cookieLocale);
            if (in_array($normalizedLocale, $supportedLocales, true)) {
                $locale = $normalizedLocale;
                $source = 'cookie';
            }
        }
        // 4. Browser-Spracherkennung hat niedrigste Priorität
        else {
            $browserLangHeader = $request->server('HTTP_ACCEPT_LANGUAGE') ?? '';
            if (!empty($browserLangHeader)) {
                // Extrahiere den ersten Sprachcode
                $browserLangParts = explode(',', $browserLangHeader);
                $primaryLang = explode(';', $browserLangParts[0])[0]; // z.B. 'zh-CN'
                
                // Normalisieren (z.B. 'zh-CN' zu 'zh_CN')
                $normalizedLang = $this->localeService->normalizeLocale($primaryLang);
                
                // Direkter Match?
                if (in_array($normalizedLang, $supportedLocales, true)) {
                    $locale = $normalizedLang;
                    $source = 'browser-exact';
                }
                // Basis-Sprachcode (z.B. 'zh' statt 'zh-CN')?
                else {
                    $baseLang = substr($primaryLang, 0, 2);
                    if (in_array($baseLang, $supportedLocales, true)) {
                        $locale = $baseLang;
                        $source = 'browser-base';
                    }
                }
            }
        }
        
        // Fallback auf Default-Locale, falls keine passende gefunden wurde
        if (!$locale) {
            $locale = $defaultLocale;
            $source = 'default';
        }
        
        // Debugging, wenn aktiviert
        if ($debug) {
            Log::debug('Locale determination', [
                'final' => $locale,
                'source' => $source,
                'url' => $urlLocale,
                'session' => Session::get('locale'),
                'cookie' => $request->cookie('app_locale'),
                'browser' => $request->server('HTTP_ACCEPT_LANGUAGE'),
            ]);
        }
        
        // ============= KRITISCHER TEIL FÜR CHINESISCH =============
        // Nutze den LocaleService, um die Locale zu erzwingen und zu sichern
        $enforcedLocale = $this->localeService->enforceLocale($locale);
        
        // Logging für die erzwungene Locale
        Log::info("App locale after enforcing: " . App::getLocale());
        Log::info("Final locale determined: $enforcedLocale (source: $source)");
        
        // Verarbeite den Request - VERMEIDE RACE CONDITIONS
        $response = $next($request);
        
        // ================ NACHVERARBEITUNG =================
        // NACH dem Rendering nochmals prüfen, ob die Locale noch korrekt ist
        // Dies schützt vor unbeabsichtigten Änderungen während des Renderings
        if (App::getLocale() !== $enforcedLocale) {
            Log::warning("Locale changed during rendering from {$enforcedLocale} to " . App::getLocale() . ". Fixing...");
            // Fixe die Locale erneut, um sicherzustellen, dass sie konsistent ist
            $this->localeService->enforceLocale($enforcedLocale);
        }
        
        // Cookie setzen, wenn die Locale nicht aus einem Cookie kam
        if ($source !== 'cookie') {
            $cookie = cookie('app_locale', $enforcedLocale, 60 * 24 * 30); // 30 Tage
            $response = $response->withCookie($cookie);
            Log::info("Cookie app_locale=$enforcedLocale set (30 days)");
        }
        
        Log::info("=== END MIDDLEWARE DEBUG ===");
        return $response;
    }
}
