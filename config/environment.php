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
    // Note: Cannot use closure for config:cache - will be handled in helper function
    'is_local_domain' => false,
];
