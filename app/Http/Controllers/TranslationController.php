<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\TranslationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TranslationController extends Controller
{
    /**
     * @var TranslationService
     */
    protected TranslationService $translationService;

    /**
     * Constructor with dependency injection
     * 
     * @param TranslationService $translationService
     */
    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    /**
     * Switch the application locale
     * 
     * @param Request $request
     * @param string $locale The locale to switch to (e.g., 'en', 'de', 'zh-CN')
     * @return RedirectResponse
     */
    public function switchLocale(Request $request, string $locale): RedirectResponse
    {
        // Ausführliches Debug-Logging
        Log::info("=== LANGUAGE SWITCH DEBUG ===");
        Log::info("Requested locale: $locale");
        Log::info("Session before: " . Session::get('locale', 'none'));
        Log::info("Session ID before: " . Session::getId());
        
        // Stelle sicher, dass die Locale unterstützt wird
        $supportedLocales = config('languages.available_locales', ['en', 'de', 'es', 'zh_CN']);
        Log::info("Supported locales: " . implode(', ', $supportedLocales));
        
        if (!in_array($locale, $supportedLocales, true)) {
            $locale = config('languages.default_locale', 'en');
            Log::info("Locale not supported, using default: $locale");
        }
        
        // Setze die Sprache in Session und App
        Session::put('locale', $locale);
        Session::save(); // Explizites Speichern, um sicherzustellen, dass die Session persistiert wird
        
        // Cookie setzen für zusätzliche Persistenz (30 Tage gültig)
        $cookie = cookie('app_locale', $locale, 60 * 24 * 30);
        
        Log::info("Session after: " . Session::get('locale', 'none'));
        Log::info("Session ID after: " . Session::getId());
        Log::info("Cookie set: app_locale=$locale (30 days)");
        
        // Bestimme die URL für die Rückleitung
        $referer = $request->headers->get('referer');
        Log::info("Referer: " . ($referer ?: 'none'));
        
        // Spezielle Behandlung für Chinesisch
        if ($locale === 'zh_CN') {
            Log::info("CHINESE LANGUAGE ACTIVATION");
            Log::info("Full session dump: " . json_encode(Session::all()));
            
            // Versuche den Cache zu invalidieren
            app('translator')->setLocale($locale);
            
            // Force Config
            config(['app.locale' => $locale]);
            
            // Fallback, falls kein Referer vorhanden ist
            if (!$referer) {
                Log::info("No referer for Chinese locale, redirecting to home route");
                $referer = route('home', ['locale' => $locale]);
            }
            
            // Forciere einen 302 statt 303 Redirect für Chinesisch
            // Viele Browser behandeln 302 Redirects anders als 303
            $response = redirect($referer, 302)->withCookie($cookie);
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate');
            $response->header('Pragma', 'no-cache');
            return $response;
        }
        
        // Fallback, falls kein Referer vorhanden ist
        if (!$referer) {
            Log::info("No referer, redirecting to home route with locale: $locale");
            return redirect()->route('home', ['locale' => $locale])->withCookie($cookie);
        }
        
        Log::info("Redirecting back to: $referer");
        return redirect($referer)->withCookie($cookie);
    }
}
