<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller für Google Analytics Funktionalität
 */
class AnalyticsController extends Controller
{
    /**
     * Liefert das Google Analytics Partial zurück
     *
     * @return View
     */
    public function loadAnalytics(): View
    {
        return view('partials.google-analytics');
    }
}
