<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Environment Detection
    |--------------------------------------------------------------------------
    |
    | This configuration file allows detection of specific environments
    | based on the hostname or other criteria.
    |
    */
    
    'is_development' => env('APP_ENV') === 'local',
    'is_staging' => env('APP_ENV') === 'staging',
    'is_production' => env('APP_ENV') === 'production',
    
    // Local development domains - will automatically use mailpit
    'local_domains' => [
        'mindbeamer.test',
        'localhost',
        '127.0.0.1',
    ],
    
    // Check if we're on a local development domain
    'is_local_domain' => function() {
        $appUrl = env('APP_URL', '');
        $parsedUrl = parse_url($appUrl);
        $host = $parsedUrl['host'] ?? '';
        
        return in_array($host, config('environment.local_domains'));
    },
];
