<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Neue Demo-Anfrage</title>
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
        <h1>Neue Demo-Anfrage</h1>
    </div>
    
    <div class="content">
        @if(config('app.env') !== 'production')
            <div style="background-color: #f0f9ff; border: 1px solid #bae6fd; color: #0369a1; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                <strong>ENTWICKLUNGSUMGEBUNG:</strong> Diese E-Mail wurde von {{ config('app.url') }} ({{ config('app.env') }}) gesendet. NICHT PRODUKTIV!
            </div>
        @endif
        
        <p>Es wurde eine neue Demo-Anfrage über das Kontaktformular auf {{ parse_url(config('app.url'), PHP_URL_HOST) }} eingereicht:</p>
        
        <div class="info-row">
            <span class="info-label">E-Mail:</span> 
            <span>{{ $email ?? 'Nicht angegeben' }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Sprache der Website:</span> 
            <span>
                @php
                    $localeService = app(\App\Services\LocaleService::class);
                    $displayLanguage = $localeService->getFormattedDisplayName($locale ?? 'en');
                @endphp
                {{ $displayLanguage }}
                <em style="color: #666; font-size: 0.9em;">({{ strtoupper($locale ?? 'en') }})</em>
            </span>
        </div>
        
        <p>Bitte kontaktieren Sie den Interessenten zeitnah, um einen Termin für eine persönliche Demo zu vereinbaren.</p>
    </div>
    
    <div class="footer">
        <p>Diese E-Mail wurde automatisch von {{ parse_url(config('app.url'), PHP_URL_HOST) }} gesendet.</p>
        @if(config('app.env') !== 'production')
            <p style="color: #0369a1; font-weight: bold;">{{ strtoupper(config('app.env')) }}-UMGEBUNG</p>
        @endif
    </div>
</body>
</html>
