<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\DemoRequest;
use App\Mail\DemoRequestConfirmation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DemoRequestController extends Controller
{
    /**
     * Handle a demo request form submission
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function requestDemo(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.form_validation_error'),
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Get validated data
            $data = [
                'email' => $request->email,
            ];

            // Extract user locale from request (priority: header > parameter > referer URL > default)
            $userLocale = $this->extractUserLocale($request);

            // Admin email is ALWAYS in German (as requested)
            $adminLocale = 'de';

            // Send admin notification email in German with user's locale info
            App::setLocale('de');
            Mail::to(config('mail.admin_email', 'admin@mindbeamer.io'))
                ->send(new DemoRequest($data, 'de', $userLocale));

            // Send confirmation email to user in their language
            Mail::to($request->email)->send(new DemoRequestConfirmation($data, $userLocale));

            Log::info('Demo request processed successfully', [
                'email' => $request->email,
                'user_locale' => $userLocale,
                'admin_locale' => $adminLocale,
                'admin_notified' => true,
                'user_confirmed' => true,
            ]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => __('messages.form_success'),
            ]);

        } catch (\Exception $e) {
            Log::error('Demo request failed', [
                'email' => $request->email ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => __('messages.form_error'),
            ], 500);
        }
    }

    /**
     * Extract user locale from request
     * Priority: X-Locale header > locale parameter > referer URL > default
     *
     * @param Request $request
     * @return string
     */
    private function extractUserLocale(Request $request): string
    {
        $supportedLocales = config('languages.available_locales', ['en', 'de', 'es']);
        $defaultLocale = config('languages.default_locale', 'en');

        // 1. Try X-Locale header (if frontend sends it)
        $headerLocale = $request->header('X-Locale');
        if ($headerLocale && in_array($headerLocale, $supportedLocales, true)) {
            return $headerLocale;
        }

        // 2. Try locale parameter (if sent in POST data)
        $paramLocale = $request->input('locale');
        if ($paramLocale && in_array($paramLocale, $supportedLocales, true)) {
            return $paramLocale;
        }

        // 3. Try to extract from referer URL (e.g., https://example.com/de/ -> 'de')
        $referer = $request->header('referer');
        if ($referer) {
            $urlParts = parse_url($referer);
            if (isset($urlParts['path'])) {
                $pathSegments = array_filter(explode('/', $urlParts['path']));
                $possibleLocale = reset($pathSegments);
                
                if ($possibleLocale && in_array($possibleLocale, $supportedLocales, true)) {
                    return $possibleLocale;
                }
            }
        }

        // 4. Fallback to session locale
        $sessionLocale = session('locale');
        if ($sessionLocale && in_array($sessionLocale, $supportedLocales, true)) {
            return $sessionLocale;
        }

        // 5. Ultimate fallback
        return $defaultLocale;
    }
}
