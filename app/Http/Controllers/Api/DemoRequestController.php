<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\DemoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

            // Send email using the Mailable
            Mail::to(config('mail.admin_email'))->send(new DemoRequest($data));

            // Return success response
            return response()->json([
                'success' => true,
                'message' => __('messages.form_success'),
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Demo request failed: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => __('messages.form_error'),
            ], 500);
        }
    }
}
