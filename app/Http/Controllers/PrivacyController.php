<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller for Privacy Policy page
 */
class PrivacyController extends Controller
{
    /**
     * Display the privacy policy page
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('privacy-policy');
    }
}
