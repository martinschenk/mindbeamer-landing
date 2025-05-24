<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\TestErrorController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\LegalController;
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
    ->where('locale', '[a-z]{2}');

// Root route with browser language detection
Route::get('/', function () {
    $supportedLocales = config('languages.available_locales', []);
    $defaultLocale = config('languages.default_locale', 'en');
    
    // Try to get locale from session first
    $sessionLocale = session('locale');
    if ($sessionLocale && in_array($sessionLocale, $supportedLocales)) {
        return redirect("/{$sessionLocale}");
    }
    
    // Detect browser language
    $browserLang = request()->server('HTTP_ACCEPT_LANGUAGE');
    $locale = $defaultLocale;
    
    if ($browserLang) {
        $browserLang = substr($browserLang, 0, 2);
        if (in_array($browserLang, $supportedLocales)) {
            $locale = $browserLang;
        }
    }
    
    // Set session and redirect
    session(['locale' => $locale]);
    return redirect("/{$locale}");
});

// Localized routes with locale prefix
Route::prefix('{locale}')->middleware(['setlocale'])->where(['locale' => '[a-z]{2}'])->group(function () {
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

// Fallback route
Route::fallback(function () {
    return redirect('/');
});
