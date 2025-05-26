<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\DemoRequest;
use App\Mail\DemoRequestConfirmation;
use App\Models\MarketingConsent;
use App\Services\CookieConsentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class DemoRequestController extends Controller
{
    /**
     * Handle a demo request form submission
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function requestDemo(Request $request)
    {
        // DEBUG-MODUS: Wir loggen jeden einzelnen Schritt und alle verfügbaren Informationen
        Log::debug('===== DEBUGGING DEMO REQUEST START =====');
        Log::debug('REQUEST EINGEGANGEN', [
            'method' => $request->method(),
            'url' => $request->url(),
            'all_input' => $request->all(),
            'has_marketing_consent' => $request->has('marketing_consent'),
            'raw_marketing_consent' => $request->input('marketing_consent'),
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'ajax' => $request->ajax(),
            'content_type' => $request->header('Content-Type'),
            'accept' => $request->header('Accept'),
            'locale_header' => $request->header('X-Locale'),
            'all_headers' => $request->header()
        ]);
        
        // Alle Cookies loggen
        Log::debug('COOKIES', [
            'all_cookies' => $request->cookie(),
            'marketing_cookie' => $request->cookie('laravel_cookie_consent_marketing'),
        ]);
        
        try {
            // Extrahiere und setze die Locale VOR der Validierung
            $userLocale = $this->extractUserLocale($request);
            App::setLocale($userLocale); // Wichtig: Sprache explizit setzen
            // Validate the request - mit lokalisierten Attributnamen
            Log::debug('VALIDIERUNG STARTEN', [
                'input_data' => $request->all(),
                'validation_rules' => ['email' => 'required|email']
            ]);
            
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                // Marketing-Consent ist völlig optional, daher keine Validierung notwendig
            ], [], [
                // Lokalisierte Attributnamen für alle unterstützten Sprachen
                'email' => __('validation.attributes.email'),
            ]);
            
            Log::debug('VALIDIERUNGSERGEBNIS', [
                'is_valid' => !$validator->fails(),
                'errors' => $validator->errors()->toArray()
            ]);

            if ($validator->fails()) {
                // Die Fehlermeldungen zusammenstellen in der aktuellen Sprache
                $errorMessages = $validator->errors()->all();
                $localizedErrorMessage = __('messages.form_validation_error') . ': ' . implode('. ', $errorMessages);
                
                return response()->json([
                    'success' => false,
                    'message' => $localizedErrorMessage,
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Get validated data
            $data = [
                'email' => $request->email,
                'marketing_consent' => $request->boolean('marketing_consent'),
            ];

            // Extract user locale from request (priority: header > parameter > referer URL > default)
            $userLocale = $this->extractUserLocale($request);

            // Admin email is ALWAYS in German (as requested)
            $adminLocale = 'de';
            
            // Marketing-Einwilligung in einer separaten Transaktion direkt speichern
            // Verwendung einer direkten DB-Transaktion zur besseren Fehlerisolierung
            $marketingConsentSaved = false;
            
            try {
                // Den Wert aus dem Request extrahieren
                $consentValue = $request->input('marketing_consent');
                $consentBoolean = in_array($consentValue, ['1', 'true', true, 1], true);
                
                Log::debug('MARKETING CONSENT WERTE', [
                    'consent_raw_value' => $consentValue,
                    'consent_boolean' => $consentBoolean,
                    'consent_type' => gettype($consentValue),
                    'email' => $data['email']
                ]);
                
                // Laravel-konforme Transaktion starten mit Eloquent
                DB::beginTransaction();
                
                // KEINE Prüfung auf Tabellenexistenz mehr - wir wissen, dass die Tabelle existiert
                try {
                    
                    // DEBUG: Verbindungsstatus und Konfiguration prüfen
                    Log::critical('DB-KONFIGURATION', [
                        'connection' => config('database.default'),
                        'database' => config('database.connections.' . config('database.default') . '.database'),
                        'driver' => config('database.connections.' . config('database.default') . '.driver'),
                    ]);
                    
                    // Laravel-konforme Abfrage mit dem Query Builder
                    try {
                        $existingCount = MarketingConsent::where('email', $data['email'])->count();
                        Log::critical('MARKETING CONSENT ZÄHLUNG: ' . $existingCount . ' Einträge für E-Mail ' . $data['email']);
                    } catch (\Exception $countException) {
                        Log::critical('FEHLER BEI ZÄHLUNG: ' . $countException->getMessage());
                    }
                    
                    // Prüfen, ob bereits ein Eintrag existiert mit Eloquent
                    try {
                        $existingConsent = MarketingConsent::where('email', $data['email'])->first();
                        Log::critical('MARKETING CONSENT DB ABFRAGE: ' . ($existingConsent ? 'Eintrag gefunden' : 'Kein Eintrag gefunden'));
                        if ($existingConsent) {
                            Log::critical('VORHANDENER EINTRAG DETAILS', [
                                'id' => $existingConsent->id,
                                'email' => $existingConsent->email,
                                'consent' => $existingConsent->consent_given
                            ]);
                        }
                    } catch (\Exception $findException) {
                        Log::critical('FEHLER BEI ABFRAGE: ' . $findException->getMessage());
                        Log::critical('TRACE: ' . $findException->getTraceAsString());
                    }
                    
                    // Prüfen, ob die E-Mail bereits existiert - mit direkter SQL-Abfrage
                    $exists = DB::select('SELECT id FROM marketing_consents WHERE email = ?', [$data['email']]);
                    
                    // Den tatsächlichen übersetzten Consent-Text aus der Sprachdatei holen
                    // __() gibt den übersetzten Text zurück, nicht den Schlüssel selbst
                    $consentText = __('messages.marketing_consent');
                    Log::debug('Gespeicherter Consent-Text: ' . $consentText);
                    
                    // Daten für die Datenbank aufbereiten
                    $consentData = [
                        'email' => $data['email'],
                        'consent_given' => $consentBoolean ? 1 : 0,
                        'ip_address' => $request->ip(),
                        'user_agent' => substr($request->userAgent() ?: '', 0, 255),  // Auf 255 Zeichen begrenzen
                        'locale' => $userLocale,
                        'form_type' => 'contact',
                        'consent_text' => $consentText, // Den tatsächlichen Text der Einwilligung speichern (DSGVO-konform)
                        'updated_at' => now()
                    ];
                    
                    if (!empty($exists)) {
                        try {
                            // Vorhandenen Eintrag mit direkter SQL-Abfrage löschen und neu anlegen
                            $id = $exists[0]->id;
                            Log::critical('DIREKTES DELETE & INSERT: Vorhandenen Eintrag mit ID ' . $id . ' löschen und neu anlegen');
                            
                            // Alten Eintrag löschen
                            $deleteResult = DB::delete('DELETE FROM marketing_consents WHERE id = ?', [$id]);
                            
                            if ($deleteResult) {
                                Log::critical('ERFOLG: Vorhandener Eintrag für ' . $data['email'] . ' gelöscht!');
                                
                                // Neuen Eintrag erstellen mit created_at auf aktuelles Datum
                                $consentData['created_at'] = now();
                                
                                // Neuen Eintrag einfügen
                                $insertResult = DB::insert(
                                    'INSERT INTO marketing_consents (email, consent_given, ip_address, user_agent, locale, form_type, consent_text, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                                    [
                                        $consentData['email'],
                                        $consentData['consent_given'],
                                        $consentData['ip_address'],
                                        $consentData['user_agent'],
                                        $consentData['locale'],
                                        $consentData['form_type'],
                                        $consentData['consent_text'],
                                        $consentData['created_at'],
                                        $consentData['updated_at']
                                    ]
                                );
                                
                                if ($insertResult) {
                                    Log::critical('ERFOLG: Neuer Eintrag für ' . $data['email'] . ' erstellt!');
                                } else {
                                    Log::critical('FEHLER: Konnte neuen Eintrag für ' . $data['email'] . ' nicht erstellen!');
                                }
                            } else {
                                Log::critical('FEHLER: Konnte vorhandenen Eintrag für ' . $data['email'] . ' nicht löschen!');
                            }
                            $marketingConsentSaved = $deleteResult && isset($insertResult) && $insertResult;
                            
                        } catch (\Exception $e) {
                            Log::critical('FEHLER beim Löschen/Einfügen: ' . $e->getMessage());
                            $marketingConsentSaved = false;
                        }
                    } else {
                        try {
                            // Neuen Eintrag mit direkter SQL-Abfrage erstellen
                            Log::critical('DIREKTES INSERT: Neuen Eintrag für ' . $data['email'] . ' erstellen');
                            
                            // Für Insert brauchen wir auch created_at
                            $consentData['created_at'] = now();
                            
                            $id = DB::table('marketing_consents')->insertGetId($consentData);
                            
                            Log::critical('INSERT ERFOLG: ID = ' . ($id ?: 'Fehler'));
                            $marketingConsentSaved = !empty($id);
                            
                        } catch (\Exception $e) {
                            Log::critical('DIREKTES INSERT FEHLER: ' . $e->getMessage());
                            $marketingConsentSaved = false;
                        }
                    }
                    
                    // Transaktion abschließen
                    DB::commit();
                    $marketingConsentSaved = true;
                    
                } catch (\Exception $dbException) {
                    // Transaktion zurückrollen
                    DB::rollBack();
                    
                    Log::error('MARKETING CONSENT DB FEHLER', [
                        'error' => $dbException->getMessage(),
                        'trace' => $dbException->getTraceAsString(),
                        'email' => $data['email']
                    ]);
                    
                    // Fehler nicht weiterwerfen, sondern nur loggen
                    $marketingConsentSaved = false;
                }
                
                Log::info('Marketing-Einwilligung gespeichert', [
                    'email' => $data['email'],
                    'consent_value_raw' => $consentValue,
                    'consent_given' => $consentBoolean,
                    'success' => $marketingConsentSaved
                ]);
            } catch (\Exception $e) {
                Log::error('Fehler beim Speichern der Marketing-Einwilligung', [
                    'error' => $e->getMessage(),
                    'email' => $data['email']
                ]);
                $marketingConsentSaved = false;
            }

            // Send admin notification email in German with user's locale info
            App::setLocale('de');
            Mail::to(config('mail.admin_email', 'admin@mindbeamer.io'))
                ->send(new DemoRequest($data, 'de', $userLocale));

            // Send confirmation email to user in their language
            Mail::to($request->email)->send(new DemoRequestConfirmation($data, $userLocale));

            Log::info('Demo request processed successfully', [
                'email' => $request->email,
                'user_locale' => $userLocale,
                'admin_locale' => $adminLocale,
                'marketing_consent' => $data['marketing_consent'] ?? false,
                'marketing_consent_saved' => $marketingConsentSaved,
                'admin_notified' => true,
                'user_confirmed' => true,
            ]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => __('messages.form_success'),
            ]);

        } catch (\Exception $e) {
            Log::error('Demo request failed', [
                'email' => $request->email ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => __('messages.form_error'),
            ], 500);
        }
    }

    /**
     * Extract user locale from request
     * Priority: X-Locale header > locale parameter > referer URL > default
     *
     * @param Request $request
     * @return string
     */
    private function extractUserLocale(Request $request): string
    {
        $supportedLocales = config('languages.available_locales', ['en', 'de', 'es']);
        $defaultLocale = config('languages.default_locale', 'en');

        // 1. Try X-Locale header (if frontend sends it)
        $headerLocale = $request->header('X-Locale');
        if ($headerLocale && in_array($headerLocale, $supportedLocales, true)) {
            return $headerLocale;
        }

        // 2. Try locale parameter (if sent in POST data)
        $paramLocale = $request->input('locale');
        if ($paramLocale && in_array($paramLocale, $supportedLocales, true)) {
            return $paramLocale;
        }

        // 3. Try to extract from referer URL (e.g., https://example.com/de/ -> 'de')
        $referer = $request->header('referer');
        if ($referer) {
            $urlParts = parse_url($referer);
            if (isset($urlParts['path'])) {
                $pathSegments = array_filter(explode('/', $urlParts['path']));
                $possibleLocale = reset($pathSegments);
                
                if ($possibleLocale && in_array($possibleLocale, $supportedLocales, true)) {
                    return $possibleLocale;
                }
            }
        }

        // 4. Fallback to session locale
        $sessionLocale = session('locale');
        if ($sessionLocale && in_array($sessionLocale, $supportedLocales, true)) {
            return $sessionLocale;
        }

        // 5. Ultimate fallback
        return $defaultLocale;
    }
}
