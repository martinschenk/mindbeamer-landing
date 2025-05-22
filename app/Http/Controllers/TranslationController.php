<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\TranslationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
     * @param string $locale The locale to switch to (e.g., 'en', 'de')
     * @return RedirectResponse
     */
    public function switchLocale(Request $request, string $locale): RedirectResponse
    {
        $this->translationService->setAppLocale($locale);
        
        // Redirect back to previous page or fallback to home
        return redirect()->back()->withInput();
    }
}
