<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller for legal pages (Impressum, Terms of Service)
 */
class LegalController extends Controller
{
    /**
     * Show the legal notice (Impressum) page
     */
    public function impressum(): View
    {
        return view('app', [
            'pageKey' => 'impressum',
            'isRootDomain' => false
        ]);
    }

    /**
     * Show the terms of service page
     */
    public function terms(): View
    {
        return view('app', [
            'pageKey' => 'terms',
            'isRootDomain' => false
        ]);
    }
}
