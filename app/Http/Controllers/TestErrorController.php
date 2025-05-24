<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class TestErrorController extends Controller
{
    /**
     * Display a test error page
     *
     * @param Request $request
     * @param string $code Error code to display
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request, string $code)
    {
        // Set locale if specified in the query string
        $supportedLocales = config('languages.available_locales', []);
        if ($request->has('lang') && in_array($request->lang, $supportedLocales)) {
            app()->setLocale($request->lang);
        }

        // Return the appropriate error page based on the code
        return match ($code) {
            '403' => abort(403),
            '404' => abort(404),
            '500' => abort(500),
            '503' => abort(503),
            default => redirect('/')
        };
    }
}
