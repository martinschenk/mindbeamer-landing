<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('emails.demo_confirmation_title', [], $locale) }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9fafb;
        }
        .header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 30px;
            background: white;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .highlight {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 6px;
        }
        .contact-info {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 4px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    @if(config('app.env') !== 'production')
        <style>
            .dev-notice {
                background-color: #f0f9ff;
                border: 1px solid #bae6fd;
                color: #0369a1;
                padding: 10px;
                margin-bottom: 20px;
                border-radius: 4px;
                font-weight: bold;
            }
        </style>
    @endif

    <div class="header">
        <h1>MindBeamer.io</h1>
        <h2>{{ __('emails.demo_received_title', [], $locale) }}</h2>
    </div>
    
    <div class="content">
        @if(config('app.env') !== 'production')
            <div class="dev-notice">
                {!! __('emails.dev_environment_notice', ['url' => config('app.url'), 'env' => config('app.env')], $locale) !!}
            </div>
        @endif

        <p>{{ __('emails.greeting', [], $locale) }}</p>
        
        <p>{{ __('emails.thank_you_message', [], $locale) }}</p>

        <div class="highlight">
            <strong>{{ __('emails.what_next_title', [], $locale) }}</strong><br>
            {{ __('emails.what_next_description', [], $locale) }}<br><br>
            <strong>{{ __('emails.schedule_demo_title', [], $locale) }}</strong><br>
            {{ __('emails.schedule_demo_description', [], $locale) }}
        </div>

        <div class="contact-info">
            <strong>Martin Schenk</strong><br>
            {{ __('emails.founder_ceo', [], $locale) }}
            <br><br>
            📧 <a href="mailto:m.schenk@mindbeamer.io">m.schenk@mindbeamer.io</a><br>
            💬 {{ __('emails.video_call_available', [], $locale) }}<br>
            🌐 <a href="https://mindbeamer.io">mindbeamer.io</a>
        </div>
    </div>

    <div class="footer">
        <p>{!! __('emails.email_sent_reason', ['email' => $email], $locale) !!}</p>
        <p>Martin Schenk S.L. | Calle Claudio Coello 14, 5G | 28001 Madrid, España</p>
        @if(config('app.env') !== 'production')
            <p style="color: #0369a1; font-weight: bold;">{{ __('emails.environment_label', ['env' => strtoupper(config('app.env'))], $locale) }}</p>
        @endif
    </div>
</body>
</html>
