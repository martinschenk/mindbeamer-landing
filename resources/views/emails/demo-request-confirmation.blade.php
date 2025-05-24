<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('emails.demo_confirmation_title', [], $locale) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background: linear-gradient(to right, #ec4899, #8b5cf6, #14b8a6);
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
        .highlight {
            background-color: #fdf2f8;
            border-left: 4px solid #ec4899;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
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
            {{ __('emails.what_next_description', [], $locale) }}
        </div>

        <div class="contact-info">
            <strong>Martin Schenk</strong><br>
            {{ __('emails.founder_ceo', [], $locale) }}
            <br><br>
            📧 <a href="mailto:m.schenk@mindbeamer.io">m.schenk@mindbeamer.io</a><br>
            📱 <a href="tel:+34669686832">(+34) 669 686 832</a><br>
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
