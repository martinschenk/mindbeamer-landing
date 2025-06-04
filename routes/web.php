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

// Einfache Root-Route, die direkt zur englischen Version weiterleitet, wenn keine Sprache gesetzt ist
Route::get('/', function () {
    // Prüfe, ob bereits ein Weiterleitungsversuch stattgefunden hat
    if (request()->cookie('redirect_attempt')) {
        // Wenn ja, direkt zur englischen Version weiterleiten
        return redirect('/en');
    }
    
    // Prüfe, ob eine Sprache in der Session gesetzt ist
    $locale = session('locale');
    
    // Wenn keine Sprache in der Session gesetzt ist, prüfe den Cookie
    if (!$locale) {
        $locale = request()->cookie('app_locale');
    }
    
    // Wenn immer noch keine Sprache gesetzt ist, verwende die Browser-Sprache
    if (!$locale) {
        $browserLang = request()->server('HTTP_ACCEPT_LANGUAGE');
        $locale = $defaultLocale = config('languages.default_locale', 'en');
        
        if ($browserLang) {
            // Extrahiere Sprachcode (unterstützt auch Formate wie zh-CN)
            $browserLangParts = explode(',', $browserLang);
            $primaryLang = explode(';', $browserLangParts[0])[0];
            
            // Überprüfe vollständige Sprachcodes (z.B. zh-CN)
            if (in_array($primaryLang, config('languages.available_locales', []))) {
                $locale = $primaryLang;
            } else {
                // Fallback: Prüfe Basis-Sprachcode (z.B. nur 'zh')
                $baseLang = substr($primaryLang, 0, 2);
                if (in_array($baseLang, config('languages.available_locales', []))) {
                    $locale = $baseLang;
                }
            }
        }
    }
    
    // Setze einen Cookie, um Weiterleitungsschleifen zu erkennen
    return redirect("/{$locale}")->withCookie(cookie('redirect_attempt', '1', 1));
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
