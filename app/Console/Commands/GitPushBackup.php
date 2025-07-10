<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class GitPushBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:git-push {--reset : Reset the push counter}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Track git pushes and create backup with every commit';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $counterFile = 'git-push-counter.txt';
        
        // Reset counter if requested
        if ($this->option('reset')) {
            Storage::disk('local')->put($counterFile, '0');
            $this->info('Git push counter reset to 0');
            return 0;
        }

        // Get current counter
        $currentCount = (int) Storage::disk('local')->get($counterFile, '0');
        $newCount = $currentCount + 1;
        
        // Update counter
        Storage::disk('local')->put($counterFile, (string) $newCount);
        
        $this->info("Git push #{$newCount} recorded");
        
        // Create backup with every commit
        $this->info(" Creating backup...");
        
        try {
            Artisan::call('backup:run');
            $this->info(" Backup completed successfully!");
            
            // Automatically clean old backups after successful backup
            $this->info(" Cleaning old backups...");
            Artisan::call('backup:clean');
            $this->info(" Cleanup completed!");
            
            $this->line(" Push #{$newCount} - backup created and cleaned");
        } catch (\Exception $e) {
            $this->error(" Backup failed: " . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}
