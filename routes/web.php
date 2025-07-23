<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\TranslationController;
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


// Prüfe auf www und leite zu non-www weiter
Route::domain('www.mindbeamer.io')->group(function () {
    Route::get('{any}', function ($any = null) {
        $path = $any ? $any : '';
        return redirect('https://mindbeamer.io/' . $path, 301);
    })->where('any', '.*');
});

// Root-Route with SEO-optimized handling (no redirect)
// Serves default language content at the root domain for better SEO
Route::get('/', [RootController::class, 'index'])->name('root');


// Language switching route
Route::get('/language/{locale}', [TranslationController::class, 'switchLocale'])
    ->name('language.switch')
    ->where('locale', '[a-z]{2}([_-][A-Z]{2})?');

// Localized routes with locale prefix
Route::prefix('{locale}')->middleware(['setlocale'])->where(['locale' => '[a-z]{2}([_-][A-Z]{2})?'])->group(function () {
    // Main landing page route
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Privacy Policy routes (with all language-specific slugs)
    // WICHTIG: Alle URL-Varianten zeigen auf denselben Controller, aber nur die englische
    // Route hat einen Namen für die Rückwärtskompatibilität. Dies ermöglicht lokalisierte
    // URLs wie /de/datenschutz-richtlinie statt /de/privacy-policy
    Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy.policy');
    Route::get('/datenschutz-richtlinie', [PrivacyController::class, 'index']); // Deutsch
    Route::get('/politica-privacidad', [PrivacyController::class, 'index']); // Spanisch
    Route::get('/politica-privacidade', [PrivacyController::class, 'index']); // Portugiesisch
    Route::get('/politique-confidentialite', [PrivacyController::class, 'index']); // Französisch
    
    // Legal notice/Impressum routes (with all language-specific slugs)
    // Die deutsche Route 'impressum' erhält den Route-Namen, da dies die Hauptbezeichnung ist
    Route::get('/legal-notice', [LegalController::class, 'impressum']); // Englisch
    Route::get('/impressum', [LegalController::class, 'impressum'])->name('legal.impressum'); // Deutsch
    Route::get('/aviso-legal', [LegalController::class, 'impressum']); // Spanisch & Portugiesisch
    Route::get('/mentions-legales', [LegalController::class, 'impressum']); // Französisch
    
    // Terms routes (with all language-specific slugs)
    // Englische Route behält den Namen für Kompatibilität mit bestehenden Links
    Route::get('/terms', [LegalController::class, 'terms'])->name('legal.terms'); // Englisch
    Route::get('/agb', [LegalController::class, 'terms']); // Deutsch
    Route::get('/terminos', [LegalController::class, 'terms']); // Spanisch
    Route::get('/termos', [LegalController::class, 'terms']); // Portugiesisch
    Route::get('/conditions', [LegalController::class, 'terms']); // Französisch
    
    // Test error pages route - ONLY AVAILABLE IN LOCAL/DEVELOPMENT
    if (app()->environment(['local', 'development'])) {
        Route::get('/test-error/{code}', [\App\Http\Controllers\TestErrorController::class, 'show'])
            ->name('test.error')
            ->where('code', '403|404|500|503');
    }
});

// Debug-Routen - ONLY AVAILABLE IN LOCAL/DEVELOPMENT
if (app()->environment(['local', 'development'])) {
    Route::get('/debug/locale', [\App\Http\Controllers\DebugController::class, 'localeDebug'])->name('debug.locale');
    Route::get('/debug/locale/{test_locale}', [\App\Http\Controllers\DebugController::class, 'localeDebug'])->name('debug.locale.specific');
    Route::get('/debug/chinese', [\App\Http\Controllers\DebugController::class, 'testChinese'])->name('debug.chinese');
}

// Kontakt-API-Routen
Route::post('/api/demo-request', [\App\Http\Controllers\Api\DemoRequestController::class, 'requestDemo'])
    ->middleware('throttle:6,1') // Maximal 6 Anfragen pro Minute
    ->name('api.demo-request');

// Google Analytics Route - wird nur aufgerufen, wenn Consent vorhanden ist
Route::get('/load-analytics', [AnalyticsController::class, 'loadAnalytics'])->name('load.analytics');

// Robots.txt route - Fallback falls die statische Datei nicht existiert
Route::get('/robots.txt', function () {
    // Check if static file exists first
    $staticPath = public_path('robots.txt');
    if (file_exists($staticPath)) {
        return response(file_get_contents($staticPath))
            ->header('Content-Type', 'text/plain');
    }
    
    // Fallback content
    $content = "User-agent: *\nAllow: /\n\n# Sitemap location\nSitemap: https://mindbeamer.io/sitemap.xml\n\n# Crawl-delay\nCrawl-delay: 1";
    return response($content)->header('Content-Type', 'text/plain');
})->name('robots');

// Fallback route
Route::fallback(function () {
    return redirect('/');
});
