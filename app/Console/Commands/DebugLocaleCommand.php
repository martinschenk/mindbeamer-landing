<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class DebugLocaleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locale:debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug Lokalisierungsprobleme und zeige Informationen zu Spracheinstellungen';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Lokalisierungs-Debug-Informationen ===');
        
        // Konfiguration anzeigen
        $this->info('\nKonfiguration:');
        $supportedLocales = Config::get('languages.available_locales', []);
        $defaultLocale = Config::get('languages.default_locale', 'en');
        $fallbackLocale = Config::get('languages.fallback_locale', 'en');
        
        $this->table(
            ['Einstellung', 'Wert'],
            [
                ['Unterstützte Sprachen', implode(', ', $supportedLocales)],
                ['Standard-Sprache', $defaultLocale],
                ['Fallback-Sprache', $fallbackLocale],
            ]
        );
        
        // Sprachverzeichnisse überprüfen
        $this->info('\nSprachverzeichnisse:');
        $langPath = lang_path();
        $this->line("Basis-Sprachpfad: {$langPath}");
        
        $directories = File::directories($langPath);
        $rows = [];
        
        foreach ($directories as $dir) {
            $dirName = basename($dir);
            $exists = in_array($dirName, $supportedLocales, true);
            $messageCount = count(File::files($dir));
            $rows[] = [$dirName, $exists ? 'Ja' : 'Nein', $messageCount];
        }
        
        $this->table(['Verzeichnis', 'In Konfiguration?', 'Anzahl Dateien'], $rows);
        
        // Vendor-Verzeichnisse überprüfen
        $vendorPath = $langPath . '/vendor';
        if (File::isDirectory($vendorPath)) {
            $this->info('\nVendor-Sprachverzeichnisse:');
            
            $vendorDirs = File::directories($vendorPath);
            $vendorRows = [];
            
            foreach ($vendorDirs as $vendorDir) {
                $vendorName = basename($vendorDir);
                $localeDirs = File::directories($vendorDir);
                
                foreach ($localeDirs as $localeDir) {
                    $localeName = basename($localeDir);
                    $exists = in_array($localeName, $supportedLocales, true);
                    $messageCount = count(File::files($localeDir));
                    $vendorRows[] = [$vendorName, $localeName, $exists ? 'Ja' : 'Nein', $messageCount];
                }
            }
            
            if (!empty($vendorRows)) {
                $this->table(['Vendor', 'Sprache', 'In Konfiguration?', 'Anzahl Dateien'], $vendorRows);
            } else {
                $this->line('Keine Vendor-Sprachverzeichnisse gefunden.');
            }
        }
        
        // Middleware überprüfen
        $this->info('\nMiddleware-Konfiguration:');
        $kernelPath = app_path('Http/Kernel.php');
        $kernelContent = File::get($kernelPath);
        
        if (strpos($kernelContent, 'setlocale') !== false) {
            $this->line('✅ SetLocale-Middleware ist registriert.');
        } else {
            $this->error('❌ SetLocale-Middleware scheint nicht registriert zu sein!');
        }
        
        // Probleme identifizieren
        $this->info('\nMögliche Probleme:');
        
        $problems = [];
        
        // Prüfe auf Verzeichnisse mit Bindestrich vs. Unterstrich
        foreach ($supportedLocales as $locale) {
            if (strpos($locale, '_') !== false) {
                $dashVersion = str_replace('_', '-', $locale);
                if (File::isDirectory($langPath . '/' . $dashVersion)) {
                    $problems[] = ["Bindestrich-Format", "Das Verzeichnis '{$dashVersion}' existiert, aber in der Konfiguration wird '{$locale}' verwendet."];
                }
            } elseif (strpos($locale, '-') !== false) {
                $underscoreVersion = str_replace('-', '_', $locale);
                if (File::isDirectory($langPath . '/' . $underscoreVersion)) {
                    $problems[] = ["Unterstrich-Format", "Das Verzeichnis '{$underscoreVersion}' existiert, aber in der Konfiguration wird '{$locale}' verwendet."];
                }
            }
        }
        
        // Prüfe auf konfigurierte Sprachen ohne Verzeichnis
        foreach ($supportedLocales as $locale) {
            if (!File::isDirectory($langPath . '/' . $locale)) {
                $problems[] = ["Fehlendes Verzeichnis", "Die konfigurierte Sprache '{$locale}' hat kein entsprechendes Verzeichnis."];
            }
        }
        
        if (!empty($problems)) {
            $this->table(['Problem-Typ', 'Beschreibung'], $problems);
        } else {
            $this->line('✅ Keine offensichtlichen Probleme gefunden.');
        }
        
        $this->info('\n=== Ende des Lokalisierungs-Debug ===');
    }
}
