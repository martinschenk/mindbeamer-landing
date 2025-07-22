<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\LocaleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * RootController - SEO-optimized handling of root domain requests
 * 
 * This controller serves the root domain (mindbeamer.io) without redirects,
 * allowing search engines to index the main URL while providing smart
 * language preference handling for returning visitors.
 * 
 * Key features:
 * - Serves English content on root domain for SEO (no redirect)
 * - Shows language preference banner for non-English browsers
 * - Redirects returning visitors to their saved language preference
 * - Works with the "Smart Cookie" approach documented in docs/SEO-MULTILINGUAL-STRATEGY.md
 * 
 * @since v2.2.0
 */
class RootController extends Controller
{
    private LocaleService $localeService;

    public function __construct(LocaleService $localeService)
    {
        $this->localeService = $localeService;
    }

    /**
     * Display the home page at the root domain
     * 
     * This method implements the "Smart Cookie" SEO strategy:
     * - First-time visitors: Show English content + optional language banner (no redirect)
     * - Returning visitors: Redirect to their previously chosen language
     * 
     * This approach allows Google to index mindbeamer.io while maintaining
     * excellent user experience for international visitors.
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        // Check if user has a saved language preference
        // This cookie is only set when user explicitly chooses a language via the banner
        $savedLanguagePreference = $request->cookie('user_language_preference');
        
        if ($savedLanguagePreference && in_array($savedLanguagePreference, config('languages.available_locales', []))) {
            // User has explicitly chosen a language before, redirect them
            return redirect("/{$savedLanguagePreference}");
        }
        
        // Detect user's preferred language from browser/session/cookie
        // This is used to show the language banner if different from English
        $preferredLocale = $this->detectUserLanguage($request);
        
        // Set the default locale for this request
        $defaultLocale = config('languages.default_locale', 'en');
        App::setLocale($defaultLocale);
        
        // Store the preferred locale for future navigation
        session(['preferred_locale' => $preferredLocale]);
        
        // Debug logging
        \Log::info('RootController Debug', [
            'browser_language' => $request->server('HTTP_ACCEPT_LANGUAGE'),
            'preferred_locale' => $preferredLocale,
            'current_locale' => $defaultLocale,
            'should_show_banner' => $preferredLocale !== $defaultLocale
        ]);
        
        // Pass both default and preferred locale to the view
        return view('app', [
            'currentLocale' => $defaultLocale,
            'preferredLocale' => $preferredLocale,
            'isRootDomain' => true
        ]);
    }

    /**
     * Detect user's preferred language from multiple sources
     * 
     * Priority order:
     * 1. Session (highest - user actively browsing)
     * 2. Cookie (app_locale - general preference)
     * 3. Browser language (Accept-Language header)
     * 4. Default locale (fallback)
     * 
     * Note: This does NOT check user_language_preference cookie,
     * as that's handled separately for the redirect logic.
     * 
     * @param Request $request
     * @return string The detected locale
     */
    private function detectUserLanguage(Request $request): string
    {
        // Check session first
        $locale = session('locale');
        
        // Check cookie
        if (!$locale) {
            $locale = $request->cookie('app_locale');
        }
        
        // Check browser language
        if (!$locale) {
            $browserLang = $request->server('HTTP_ACCEPT_LANGUAGE');
            $locale = config('languages.default_locale', 'en');
            
            if ($browserLang) {
                // Extract language code (supports formats like zh-CN)
                $browserLangParts = explode(',', $browserLang);
                $primaryLang = trim(explode(';', $browserLangParts[0])[0]);
                
                // Normalize language code (e.g., es-ES to es, zh-CN stays zh_CN)
                $normalizedLang = str_replace('-', '_', $primaryLang);
                
                // Check full language codes (e.g. zh_CN)
                if (in_array($normalizedLang, config('languages.available_locales', []))) {
                    $locale = $normalizedLang;
                } else {
                    // Fallback: check base language code (e.g. just 'es' from 'es-ES')
                    $baseLang = substr($primaryLang, 0, 2);
                    if (in_array($baseLang, config('languages.available_locales', []))) {
                        $locale = $baseLang;
                    }
                }
            }
        }
        
        return $locale;
    }
}