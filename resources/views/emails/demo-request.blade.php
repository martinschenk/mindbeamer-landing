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
        <p>Es wurde eine neue Demo-Anfrage über das Kontaktformular auf mindbeamer.io eingereicht:</p>
        
        <div class="info-row">
            <span class="info-label">E-Mail:</span> 
            <span>{{ $data['email'] ?? 'Nicht angegeben' }}</span>
        </div>
        
        <p>Bitte kontaktieren Sie den Interessenten zeitnah, um einen Termin für eine persönliche Demo zu vereinbaren.</p>
    </div>
    
    <div class="footer">
        <p>Diese E-Mail wurde automatisch von mindbeamer.io gesendet.</p>
    </div>
</body>
</html>
