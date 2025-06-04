<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\TestErrorController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\AnalyticsController;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Language switching route
Route::get('/language/{locale}', [TranslationController::class, 'switchLocale'])
    ->name('language.switch')
    ->where('locale', '[a-z]{2}([_-][A-Z]{2})?');

// Root route with browser language detection
Route::get('/', function () {
    // Prüfen, ob wir bereits von einer Weiterleitung kommen (Referer enthält unsere Domain)
    $referer = request()->header('referer');
    $host = request()->getHost();

    // Wenn der Referer unsere Domain enthält, könnten wir in einer Schleife sein
    if ($referer && strpos($referer, $host) !== false) {
        // Notfall-Fallback: Direkt zur englischen Version weiterleiten ohne weitere Prüfungen
        return redirect('/en');
    }
    
    // Detailliertes Debugging für Root-Route
    \Illuminate\Support\Facades\Log::info("=== ROOT ROUTE TRIGGERED ===", [
        'referer' => $referer,
        'user_agent' => request()->header('user-agent'), 
        'session_locale' => session('locale'),
        'cookie_locale' => request()->cookie('app_locale'),
        'session_id' => session()->getId(),
        'url' => request()->url(),
        'full_url' => request()->fullUrl(),
        'method' => request()->method(),
        'ajax' => request()->ajax(),
        'time' => now()->format('Y-m-d H:i:s.u')
    ]);
    
    $supportedLocales = config('languages.available_locales', []);
    $defaultLocale = config('languages.default_locale', 'en');
    
    // VERBESSERT: Prüfe immer zuerst die Session und das Cookie
    $sessionLocale = session('locale');
    $cookieLocale = request()->cookie('app_locale');
    
    // Benutze die Session-Locale, dann Cookie, dann Browser-Erkennung
    if ($sessionLocale && in_array($sessionLocale, $supportedLocales)) {
        \Illuminate\Support\Facades\Log::info("Root-Redirect aus Session: {$sessionLocale}");
        return redirect("/{$sessionLocale}");
    } elseif ($cookieLocale && in_array($cookieLocale, $supportedLocales)) {
        \Illuminate\Support\Facades\Log::info("Root-Redirect aus Cookie: {$cookieLocale}");
        return redirect("/{$cookieLocale}");
    }
    
    // Detect browser language
    $browserLang = request()->server('HTTP_ACCEPT_LANGUAGE');
    $locale = $defaultLocale;
    
    if ($browserLang) {
        // Extrahiere Sprachcode (unterstützt auch Formate wie zh-CN)
        $browserLangParts = explode(',', $browserLang);
        $primaryLang = explode(';', $browserLangParts[0])[0];
        
        // Überprüfe vollständige Sprachcodes (z.B. zh-CN)
        if (in_array($primaryLang, $supportedLocales)) {
            $locale = $primaryLang;
        } else {
            // Fallback: Prüfe Basis-Sprachcode (z.B. nur 'zh')
            $baseLang = substr($primaryLang, 0, 2);
            if (in_array($baseLang, $supportedLocales)) {
                $locale = $baseLang;
            }
        }
    }
    
    // Set session and redirect
    session(['locale' => $locale]);
    session()->save(); // Explizites Speichern der Session
    \Illuminate\Support\Facades\Log::info("Root-Redirect aus Browser-Detection: {$locale}");
    return redirect("/{$locale}");
});

// Localized routes with locale prefix
Route::prefix('{locale}')->middleware(['setlocale'])->where(['locale' => '[a-z]{2}([_-][A-Z]{2})?'])->group(function () {
    // Main landing page route
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Privacy Policy route
    Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy.policy');
    
    // Legal pages routes
    Route::get('/impressum', [LegalController::class, 'impressum'])->name('legal.impressum');
    Route::get('/terms', [LegalController::class, 'terms'])->name('legal.terms');
    
    // Test error pages route
    Route::get('/test-error/{code}', [TestErrorController::class, 'show'])
        ->name('test.error')
        ->where('code', '403|404|500|503');
});

// Debug-Routen - WICHTIG für Sprachprobleme mit zh_CN
Route::get('/debug/locale', [\App\Http\Controllers\DebugController::class, 'localeDebug'])->name('debug.locale');
Route::get('/debug/locale/{test_locale}', [\App\Http\Controllers\DebugController::class, 'localeDebug'])->name('debug.locale.specific');
Route::get('/debug/chinese', [\App\Http\Controllers\DebugController::class, 'testChinese'])->name('debug.chinese');

// Kontakt-API-Routen
Route::post('/api/demo-request', [\App\Http\Controllers\Api\DemoRequestController::class, 'requestDemo'])
    ->middleware('throttle:6,1') // Maximal 6 Anfragen pro Minute
    ->name('api.demo-request');

// Google Analytics Route - wird nur aufgerufen, wenn Consent vorhanden ist
Route::get('/load-analytics', [AnalyticsController::class, 'loadAnalytics'])->name('load.analytics');

// Fallback route
Route::fallback(function () {
    return redirect('/');
});
