<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\TestErrorController;
use App\Http\Controllers\PrivacyController;

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

// Apply locale middleware to all routes
Route::middleware('setlocale')->group(function () {
    // Main landing page route
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Privacy Policy route
    Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy.policy');
});

// Test error pages route
Route::get('/test-error/{code}', [TestErrorController::class, 'show'])
    ->name('test.error')
    ->where('code', '403|404|500|503');

// Fallback route
Route::fallback(function () {
    return redirect('/');
});
