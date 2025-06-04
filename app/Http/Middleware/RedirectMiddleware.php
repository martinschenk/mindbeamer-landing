<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class RedirectMiddleware
{
    /**
     * Handle an incoming request and prevent redirect loops.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        // Direktes Logging in eine Datei
        $logPath = storage_path('logs/redirect.log');
        $logDir = dirname($logPath);
        
        // Stelle sicher, dass das Log-Verzeichnis existiert und beschreibbar ist
        if (!File::exists($logDir)) {
            try {
                File::makeDirectory($logDir, 0755, true);
            } catch (\Exception $e) {
                // Ignoriere Fehler beim Erstellen des Verzeichnisses
            }
        }
        
        try {
            $logMessage = date('Y-m-d H:i:s') . ' - ' . $request->getHost() . ' - ' . $request->path() . ' - ' . $request->fullUrl();
            File::append($logPath, $logMessage . PHP_EOL);
        } catch (\Exception $e) {
            // Ignoriere Fehler beim Schreiben des Logs
        }
        
        // HARTE LÖSUNG: Wenn wir auf der Root-Route sind, leiten wir direkt zur englischen Version weiter
        if ($request->path() === '/' || $request->path() === '') {
            try {
                $logMessage = date('Y-m-d H:i:s') . ' - DIREKTE WEITERLEITUNG ZU /en - ' . $request->fullUrl();
                File::append($logPath, $logMessage . PHP_EOL);
            } catch (\Exception $e) {
                // Ignoriere Fehler beim Schreiben des Logs
            }
            
            // Direkt zur englischen Version weiterleiten, ohne weitere Prüfungen
            return redirect('/en');
        }
        
        // Wenn wir auf www.mindbeamer.io sind, leiten wir zu mindbeamer.io weiter
        if (strpos($request->getHost(), 'www.mindbeamer.io') === 0) {
            $path = $request->path();
            $targetUrl = 'https://mindbeamer.io/' . ($path !== '/' ? $path : '');
            
            try {
                $logMessage = date('Y-m-d H:i:s') . ' - WWW ZU NON-WWW WEITERLEITUNG - ' . $request->fullUrl() . ' -> ' . $targetUrl;
                File::append($logPath, $logMessage . PHP_EOL);
            } catch (\Exception $e) {
                // Ignoriere Fehler beim Schreiben des Logs
            }
            
            return redirect()->to($targetUrl, 301);
        }
        
        // Für alle anderen Anfragen
        return $next($request);
    }
}
