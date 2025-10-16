<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\TranslationService;
use Illuminate\View\View;

class HomeController extends Controller
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
     * Display the landing page
     *
     * @return View
     */
    public function index(): View
    {
        // pageKey = '' indicates this is the home page (for SEO canonical/hreflang tags)
        return view('app', [
            'pageKey' => '',
            'isRootDomain' => false
        ]);
    }
}
