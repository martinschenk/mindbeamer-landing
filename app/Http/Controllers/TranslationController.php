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
        
        // Explizites Setzen des Translators für alle Sprachen
        app('translator')->setLocale($locale);
        config(['app.locale' => $locale]);
        Log::info("Translator and config locale set to: {$locale}");
        
        // Fallback, falls kein Referer vorhanden ist
        if (!$referer) {
            Log::info("No referer, redirecting to home route with locale: $locale");
            return redirect()->route('home', ['locale' => $locale])->withCookie($cookie);
        }
        
        Log::info("Redirecting back to: $referer");
        return redirect($referer)->withCookie($cookie);
    }
}
