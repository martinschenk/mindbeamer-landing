/**
 * MindBeamer Analytics Cookie Cleanup
 *
 * Diese standalone JavaScript-Datei sorgt für die DSGVO-konforme Behandlung von
 * Google Analytics, wenn der Benutzer Analytics deaktiviert hat.
 * 
 * @license MIT
 * @version 1.1.0
 */

(function() {
    'use strict';
    
    /**
     * Hilfsfunktion zum Auslesen von Cookies
     * 
     * @param {string} name Der Name des Cookies
     * @return {string|null} Der Cookie-Wert oder null, wenn nicht gefunden
     */
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) {
            return parts.pop().split(';').shift();
        }
        return null;
    }
    
    /**
     * Löscht die wichtigsten Google Analytics-Cookies
     * 
     * @return {void}
     */
    function deleteGACookies() {
        // Liste der wichtigsten Domains
        const domains = [
            '', // Aktueller Host
            '.mindbeamer.io',
            'mindbeamer.io',
            window.location.hostname,
            '.' + window.location.hostname
        ];
        
        // Liste der wichtigsten GA-Cookies
        const cookies = ['_ga', '_gid', '_gat'];
        
        // Alle Basis-Cookies löschen
        for (const name of cookies) {
            for (const domain of domains) {
                const domainStr = domain ? `; Domain=${domain}` : '';
                document.cookie = `${name}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}`;
            }
        }
        
        // Dynamische GA-Cookies löschen (z.B. _ga_XXXXXXXX)
        const allCookies = document.cookie.split(';');
        for (let i = 0; i < allCookies.length; i++) {
            const cookie = allCookies[i].trim();
            const cookieName = cookie.split('=')[0];
            
            if (cookieName.startsWith('_ga_')) {
                for (const domain of domains) {
                    const domainStr = domain ? `; Domain=${domain}` : '';
                    document.cookie = `${cookieName}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}`;
                }
            }
        }
        
        // LocalStorage leeren
        try {
            localStorage.removeItem('_ga');
            sessionStorage.removeItem('_ga');
        } catch (e) {}
        
        console.debug('[MB-ANALYTICS] Google Analytics-Cookies wurden gelöscht');
    }
    
    /**
     * Blockiert Google Analytics, indem es die Skripte entfernt und 
     * die Tracking-Funktion überschreibt
     * 
     * @return {void}
     */
    function blockGoogleAnalytics() {
        // Existierende GA-Skripte entfernen
        const gaScripts = document.querySelectorAll('script[src*="googletagmanager.com"]');
        gaScripts.forEach(script => {
            script.remove();
        });
        
        // dataLayer zurücksetzen
        if (window.dataLayer) {
            delete window.dataLayer;
        }
        
        // GA-Funktion deaktivieren
        window.gtag = function() {
            return null;
        };
        
        // GA-Cookies löschen
        deleteGACookies();
        
        // Auffällige Konsolenmeldung für die Deaktivierung
        console.log('%c[MB-ANALYTICS] Google Analytics wird DEAKTIVIERT', 'background: #F44336; color: white; padding: 5px; border-radius: 3px;');
    }
    
    /**
     * Überwacht Änderungen an den Cookie-Einstellungen
     * 
     * @return {void}
     */
    function setupAnalyticsWatcher() {
        // Cookie-Namen bestimmen
        const cookiePrefix = 'MindBeamer'; // Standard-Wert
        const analyticsName = `${cookiePrefix}_cookie_analytics`;
        
        // Beim Laden prüfen
        if (getCookie(analyticsName) === 'false') {
            blockGoogleAnalytics();
        }
        
        // Auf Klicks auf den Speichern-Button reagieren
        document.addEventListener('click', function(event) {
            if (event.target && (
                event.target.classList.contains('cookie-preferences-save') || 
                (event.target.hasAttribute('data-cc') && event.target.getAttribute('data-cc') === 'save') ||
                event.target.textContent.includes('Save Preferences') ||
                event.target.textContent.includes('Guardar Preferencias')
            )) {
                setTimeout(function() {
                    if (getCookie(analyticsName) === 'false') {
                        blockGoogleAnalytics();
                    }
                }, 100);
            }
        }, true);
    }
    
    // Initialisierung beim Laden der Seite
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupAnalyticsWatcher);
    } else {
        setupAnalyticsWatcher();
    }
})();
