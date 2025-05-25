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
        // Debug-Modus prüfen
        $debug = config('app.debug', false);
        
        // Debug-Informationen nur im Debug-Modus loggen
        if ($debug) {
            Log::debug("Language switch requested", [
                'locale' => $locale,
                'session_locale' => Session::get('locale', 'none'),
                'session_id' => Session::getId()
            ]);
        }
        
        // Stelle sicher, dass die Locale unterstützt wird
        $supportedLocales = config('languages.available_locales', ['en', 'de', 'es', 'zh_CN']);
        
        if (!in_array($locale, $supportedLocales, true)) {
            $locale = config('languages.default_locale', 'en');
            
            if ($debug) {
                Log::debug("Locale not supported, using default", ['locale' => $locale]);
            }
        }
        
        // Setze die Sprache in Session und App
        Session::put('locale', $locale);
        Session::save(); // Explizites Speichern, um sicherzustellen, dass die Session persistiert wird
        
        // Cookie setzen für zusätzliche Persistenz (30 Tage gültig)
        $cookie = cookie('app_locale', $locale, 60 * 24 * 30);
        
        if ($debug) {
            Log::debug("Session and cookie updated", [
                'session_locale' => Session::get('locale'),
                'cookie_duration' => '30 days'
            ]);
        }
        
        // Bestimme die URL für die Rückleitung
        $referer = $request->headers->get('referer');
        
        // Explizites Setzen des Translators für alle Sprachen
        app('translator')->setLocale($locale);
        config(['app.locale' => $locale]);
        
        // Fallback, falls kein Referer vorhanden ist
        if (!$referer) {
            if ($debug) {
                Log::debug("No referer, redirecting to home route", ['locale' => $locale]);
            }
            return redirect()->route('home', ['locale' => $locale])->withCookie($cookie);
        }
        
        if ($debug) {
            Log::debug("Redirecting back to referer", ['referer' => $referer]);
        }
        return redirect($referer)->withCookie($cookie);
    }
}
