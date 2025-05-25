<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Debugging Locale</title>
    <style>
        body { 
            font-family: 'Courier New', monospace; 
            margin: 20px; 
            background-color: #f5f5f5;
        }
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            background-color: white; 
            padding: 20px; 
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 { color: #ec4899; }
        h2 { 
            color: #8b5cf6; 
            margin-top: 20px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
        }
        pre { 
            background-color: #f8f9fa; 
            padding: 10px; 
            border-radius: 5px;
            overflow-x: auto;
        }
        .box {
            border: 1px solid #e5e7eb;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .row {
            display: flex;
            margin: 10px -10px;
        }
        .col {
            flex: 1;
            padding: 0 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #e5e7eb;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f9fafb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laravel Locale Debugging</h1>
        
        <div class="box">
            <h2>Basic Information</h2>
            <div class="row">
                <div class="col">
                    <table>
                        <tr>
                            <th>App Locale</th>
                            <td>{{ app()->getLocale() }}</td>
                        </tr>
                        <tr>
                            <th>Session Locale</th>
                            <td>{{ session('locale', 'Not set') }}</td>
                        </tr>
                        <tr>
                            <th>Request Path</th>
                            <td>{{ request()->path() }}</td>
                        </tr>
                        <tr>
                            <th>Session ID</th>
                            <td>{{ session()->getId() }}</td>
                        </tr>
                        <tr>
                            <th>HTML Lang Attribute</th>
                            <td>{{ app(\App\Services\LocaleService::class)->getHtmlLangAttribute() }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <table>
                        <tr>
                            <th>Cookie Locale</th>
                            <td>{{ request()->cookie('app_locale', 'Not set') }}</td>
                        </tr>
                        <tr>
                            <th>Browser Language</th>
                            <td>{{ request()->server('HTTP_ACCEPT_LANGUAGE', 'Not Available') }}</td>
                        </tr>
                        <tr>
                            <th>Available Locales</th>
                            <td>{{ implode(', ', config('languages.available_locales', [])) }}</td>
                        </tr>
                        <tr>
                            <th>Default Locale</th>
                            <td>{{ config('languages.default_locale', 'en') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="box">
            <h2>Translation Tests</h2>
            
            <h3>Auth Translations</h3>
            <pre>{{ __('auth.failed') }}</pre>
            
            <h3>Messages Translations</h3>
            <pre>{{ __('messages.hero_title') }}</pre>
            
            <h3>Raw Trans Access</h3>
            <pre>{{ trans('messages.hero_title') }}</pre>
            
            <h3>Date Formatting</h3>
            <pre>{{ now()->translatedFormat('l, j F Y') }}</pre>
        </div>
        
        <div class="box">
            <h2>Session Data</h2>
            <pre>{{ json_encode(session()->all(), JSON_PRETTY_PRINT) }}</pre>
        </div>
        
        <div class="box">
            <h2>Cookie Information</h2>
            <pre>{{ json_encode(request()->cookies->all(), JSON_PRETTY_PRINT) }}</pre>
        </div>
        
        <div class="box">
            <h2>Test Chinese Text</h2>
            <p>这是中文测试文本，用于验证中文是否正确显示。</p>
        </div>
    </div>
</body>
</html>
