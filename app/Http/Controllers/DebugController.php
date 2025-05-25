<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\LocaleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DebugController extends Controller
{
    /**
     * @var LocaleService
     */
    protected LocaleService $localeService;

    /**
     * Constructor with service injection
     *
     * @param LocaleService $localeService
     */
    public function __construct(LocaleService $localeService)
    {
        $this->localeService = $localeService;
    }

    /**
     * Show detailed locale debugging information
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function localeDebug(Request $request)
    {
        // Intensive Debug-Logging
        Log::info("=== DEBUG PAGE ACCESSED ===");
        Log::info("Current App Locale: " . App::getLocale());
        Log::info("Session Locale: " . Session::get('locale', 'null'));
        Log::info("Cookies: " . json_encode($request->cookies->all()));
        
        // Versuche die Locale zu erzwingen, falls die URL einen Parameter enthält
        if ($request->has('force_locale')) {
            $forcedLocale = $request->input('force_locale');
            Log::info("Forcing locale to: {$forcedLocale}");
            
            $this->localeService->enforceLocale($forcedLocale);
            
            // Neu laden
            if ($request->has('reload')) {
                return redirect()->route('debug.locale');
            }
        }
        
        // Registriere, dass wir diese Sprache explizit testen
        if ($testLocale = $request->route('test_locale')) {
            Log::info("Testing specific locale: {$testLocale}");
            Session::put('debug_testing_locale', $testLocale);
            
            // Wenn wir explizit eine Locale testen, setzen wir diese auch
            $this->localeService->enforceLocale($testLocale);
        }
        
        // Stelle sicher, dass das Laden der Übersetzungen explizit passiert
        if (App::getLocale() === 'zh_CN') {
            App::setLocale('zh_CN');
            App::setFallbackLocale('en');
            trans('auth.failed'); // Lade die Übersetzungen explizit
            __('messages.hero_title'); // Nochmal über die Helferfunktion
        }
        
        return view('debug-locale');
    }
    
    /**
     * Test Chinese locale explicitly
     *
     * @return \Illuminate\View\View
     */
    public function testChinese()
    {
        // Erzwinge Chinesisch als Locale
        App::setLocale('zh_CN');
        Session::put('locale', 'zh_CN');
        Session::save();
        
        // Aktiviere Chinese-first Debug-Modus
        config(['app.locale' => 'zh_CN']);
        
        // Trigger explicit loading of translations
        trans('auth.failed');
        __('messages.hero_title');
        
        Log::info("Chinese test page loaded with locale: " . App::getLocale());
        
        return view('debug-locale');
    }
}
