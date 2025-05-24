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

            // Get current locale for user confirmation email
            $currentLocale = App::getLocale();

            // Send notification email to admin
            Mail::to(config('mail.admin_email'))->send(new DemoRequest($data));

            // Send confirmation email to user in their language
            Mail::to($request->email)->send(new DemoRequestConfirmation($data, $currentLocale));

            Log::info('Demo request processed successfully', [
                'email' => $request->email,
                'locale' => $currentLocale,
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
}
