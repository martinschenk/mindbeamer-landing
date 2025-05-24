    @php
        // Bereite lokalisierte Konfiguration für Cookie-Consent vor
        $customConfig = app(\App\Services\CookieConsentService::class)->getLocalizedConfig();
        
        // Stelle sicher, dass Analytics und Marketing Cookies sichtbar sind
        // Wichtig: Nicht deaktivieren, nur konfigurierbar machen
        $customConfig['cookie_categories']['analytics']['enabled'] = true;
        $customConfig['cookie_categories']['analytics']['visible'] = true;
        $customConfig['cookie_categories']['analytics']['locked'] = false;
        
        $customConfig['cookie_categories']['marketing']['enabled'] = true;
        $customConfig['cookie_categories']['marketing']['visible'] = true;
        $customConfig['cookie_categories']['marketing']['locked'] = false;
    @endphp
    
    @if(class_exists(\Devrabiul\CookieConsent\Facades\CookieConsent::class))
        {!! CookieConsent::scripts($customConfig) !!}
    @endif
    
    <script>
        /**
         * MindBeamer Cookie-Consent-Manager
         * 
         * Verwaltet die Cookie-Einstellungen ohne Page-Reload durch Mutation Observer.
         * 
         * Löst das Problem, dass das Cookie-Modal nach dem Speichern nicht mehr reagiert.
         */
        window.MBCookieModal = {
            // Status-Tracking
            isOpen: false,
            lastInteraction: 0,
            
            // Umfassende Selektoren für alle möglichen Cookie-Consent-Plugins
            modalSelectors: [
                '.cc-modal',
                '.cookie-consent-modal',
                '.preferences-modal',
                '[class*="cookie-modal"]',
                '[class*="cookie_modal"]',
                '[class*="preferences-modal"]'
            ],
            
            buttonSelectors: [
                '[data-cc="show-preferencesModal"]',
                '[data-role="show-preferences"]', 
                '.cc-btn-preferences',
                '.cc-btn-settings',
                '.cc-customize',
                '.cc-preferences-btn',
                'button[class*="preferences"]',
                'button[class*="settings"]',
                'a[href*="preferences"]'
            ],
            
            saveButtonSelectors: [
                '[data-cc="save"]',
                '.cc-save-btn', 
                '.cc-save',
                'button[class*="save"]',
                'button[type="submit"]'
            ],
            
            /**
             * Findet das Modal-Element
             * @return {HTMLElement|null}
             */
            getModalElement: function() {
                for (const selector of this.modalSelectors) {
                    const elements = document.querySelectorAll(selector);
                    if (elements.length > 0) {
                        return elements[0];
                    }
                }
                return null;
            },
            
            /**
             * Findet den Button für Cookie-Einstellungen
             * @return {HTMLElement|null}
             */
            getSettingsButton: function() {
                for (const selector of this.buttonSelectors) {
                    const buttons = document.querySelectorAll(selector);
                    if (buttons.length > 0) {
                        return buttons[0];
                    }
                }
                return null;
            },
            
            /**
             * Findet alle Speichern-Buttons im Modal
             * @return {Array<HTMLElement>}
             */
            getSaveButtons: function() {
                let saveButtons = [];
                for (const selector of this.saveButtonSelectors) {
                    const buttons = document.querySelectorAll(selector);
                    if (buttons.length > 0) {
                        saveButtons = saveButtons.concat(Array.from(buttons));
                    }
                }
                return saveButtons;
            },
            
            /**
             * Zeigt das Cookie-Einstellungen-Modal an
             * @return {boolean} Erfolg
             */
            showModal: function() {
                // Methode 1: Button finden und klicken
                const button = this.getSettingsButton();
                if (button) {
                    button.click();
                    this.isOpen = true;
                    this.lastInteraction = Date.now();
                    return true;
                }
                
                // Methode 2: Globale Methoden versuchen
                const globalMethods = [
                    () => window.CookieConsent && window.CookieConsent.showPreferences(),
                    () => window.cookieConsent && window.cookieConsent.showPreferences(),
                    () => window.CC && window.CC.showPreferences(),
                    () => window.showPreferences && window.showPreferences(),
                    () => document.dispatchEvent(new CustomEvent('cc:show-preferences')),
                    () => document.dispatchEvent(new CustomEvent('cookie-consent:show-modal'))
                ];
                
                for (const method of globalMethods) {
                    try {
                        method();
                        this.isOpen = true;
                        this.lastInteraction = Date.now();
                        return true;
                    } catch (e) {
                        // Zum nächsten Versuch fortfahren
                    }
                }
                
                return false;
            },
            
            /**
             * Konfiguriert Event-Listener für Speichern-Buttons
             */
            setupSaveListeners: function() {
                const saveButtons = this.getSaveButtons();
                if (saveButtons.length === 0) return;
                
                saveButtons.forEach(btn => {
                    // Bestehende Event-Listener entfernen durch Klonen
                    const newBtn = btn.cloneNode(true);
                    if (btn.parentNode) {
                        btn.parentNode.replaceChild(newBtn, btn);
                    }
                    
                    // Neuen Event-Listener hinzufügen
                    newBtn.addEventListener('click', (e) => {
                        // Plugin speichern lassen
                        this.lastInteraction = Date.now();
                        
                        // Zeit zum Speichern geben, dann Modal verstecken
                        setTimeout(() => {
                            this.isOpen = false;
                            
                            const modal = this.getModalElement();
                            if (modal) {
                                modal.style.display = 'none';
                                modal.style.visibility = 'hidden';
                                modal.style.opacity = '0';
                                
                                // Modal-Struktur ohne Page-Reload zurücksetzen
                                this.resetModalStructure();
                            }
                        }, 500);
                    }, { passive: true });
                });
            },
            
            /**
             * Setzt die Modal-Struktur ohne Page-Reload zurück
             */
            resetModalStructure: function() {
                // Soft-Reset des Cookie-Consent-Systems
                if (window.cookieConsent) {
                    try {
                        if (typeof window.cookieConsent.resetInstance === 'function') {
                            window.cookieConsent.resetInstance();
                        } else if (typeof window.cookieConsent.reset === 'function') {
                            window.cookieConsent.reset();
                        }
                    } catch (e) {
                        // Fehler beim Reset ignorieren
                    }
                }
                
                // Footer-Links neu binden
                this.rebindCookieLinks();
            },
            
            /**
             * Konfiguriert Mutation Observer für DOM-Änderungen
             */
            setupMutationObserver: function() {
                const observer = new MutationObserver((mutations) => {
                    // Nach neu hinzugefügtem Cookie-Modal suchen
                    let shouldBindSaveButtons = false;
                    
                    for (const mutation of mutations) {
                        if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                            for (const node of mutation.addedNodes) {
                                if (node.nodeType === Node.ELEMENT_NODE) {
                                    // Element oder Kinder prüfen
                                    for (const selector of this.modalSelectors) {
                                        if ((node.matches && node.matches(selector)) || 
                                            node.querySelector(selector)) {
                                            shouldBindSaveButtons = true;
                                            break;
                                        }
                                    }
                                    if (shouldBindSaveButtons) break;
                                }
                            }
                        }
                        if (shouldBindSaveButtons) break;
                    }
                    
                    // Bei Bedarf Save-Buttons neu konfigurieren
                    if (shouldBindSaveButtons) {
                        setTimeout(() => this.setupSaveListeners(), 300);
                    }
                });
                
                // Beobachtung starten
                observer.observe(document.body, {
                    childList: true,
                    subtree: true,
                    attributes: false,
                    characterData: false
                });
            },
            
            /**
             * Bindet alle Cookie-Links im Footer neu
             */
            rebindCookieLinks: function() {
                const footerLinks = document.querySelectorAll('button[onclick*="showCookieSettings"], a[onclick*="showCookieSettings"]');
                footerLinks.forEach(link => {
                    // Alten Event entfernen durch Klonen
                    const newLink = link.cloneNode(true);
                    if (link.parentNode) {
                        link.parentNode.replaceChild(newLink, link);
                    }
                    
                    // Neuen Event-Handler hinzufügen
                    newLink.addEventListener('click', (e) => {
                        e.preventDefault();
                        window.showCookieSettings();
                    });
                });
            },
            
            /**
             * Initialisiert den Cookie-Modal-Manager
             */
            init: function() {
                this.setupMutationObserver();
                setTimeout(() => this.rebindCookieLinks(), 1000);
            }
        };
        
        // Bei Seitenladung initialisieren
        document.addEventListener('DOMContentLoaded', function() {
            window.MBCookieModal.init();
        });
        
        // Globale Funktion zum Anzeigen der Cookie-Einstellungen
        window.showCookieSettings = function() {
            return window.MBCookieModal.showModal();
        };
    </script>
