<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Auto-detect local development environment and set mailpit as mailer
        if ($this->isLocalDevelopment()) {
            $this->configureLocalMailer();
        }
    }

    /**
     * Determine if we're running in a local development environment
     */
    private function isLocalDevelopment(): bool
    {
        // If explicitly set to use mail driver other than log in local, respect that
        if (app()->environment('local') && config('mail.mailers.log.transport') !== config('mail.default')) {
            return false;
        }
        
        // Check if current domain is in local_domains list
        $appUrl = config('app.url', '');
        $parsedUrl = parse_url($appUrl);
        $host = $parsedUrl['host'] ?? '';
        
        return in_array($host, config('environment.local_domains', []));
    }

    /**
     * Configure mailer for local development using Mailpit
     */
    private function configureLocalMailer(): void
    {
        Config::set('mail.default', 'mailpit');
        Config::set('mail.mailers.mailpit', [
            'transport' => 'smtp',
            'host' => 'localhost',
            'port' => 1025,
            'encryption' => null,
            'username' => null,
            'password' => null,
            'timeout' => null,
            'local_domain' => null,
        ]);
    }
}
