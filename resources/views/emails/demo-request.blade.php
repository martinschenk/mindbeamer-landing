<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('emails.admin_demo_title') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #ec4899;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .info-row {
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ __('emails.admin_demo_title') }}</h1>
    </div>
    
    <div class="content">
        @if(config('app.env') !== 'production')
            <div style="background-color: #f0f9ff; border: 1px solid #bae6fd; color: #0369a1; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                {!! __('emails.dev_environment_notice', ['url' => config('app.url'), 'env' => config('app.env')]) !!}
            </div>
        @endif
        
        <p>{{ __('emails.admin_demo_received', ['domain' => parse_url(config('app.url'), PHP_URL_HOST)]) }}</p>
        
        <div class="info-row">
            <span class="info-label">{{ __('emails.admin_email_label') }}</span> 
            <span>{{ $email ?? __('emails.admin_email_not_provided') }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">{{ __('emails.admin_language_label') }}</span> 
            <span>
                @php
                    $localeService = app(\App\Services\LocaleService::class);
                    $displayLanguage = $localeService->getFormattedDisplayName($userLocale ?? 'en');
                @endphp
                {{ $displayLanguage }}
                <em style="color: #666; font-size: 0.9em;">({{ strtoupper($userLocale ?? 'en') }})</em>
            </span>
        </div>
        
        <p>{{ __('emails.admin_contact_prompt') }}</p>
    </div>
    
    <div class="footer">
        <p>{{ __('emails.admin_email_footer', ['domain' => parse_url(config('app.url'), PHP_URL_HOST)]) }}</p>
        @if(config('app.env') !== 'production')
            <p style="color: #0369a1; font-weight: bold;">{{ __('emails.environment_label', ['env' => strtoupper(config('app.env'))]) }}</p>
        @endif
    </div>
</body>
</html>
