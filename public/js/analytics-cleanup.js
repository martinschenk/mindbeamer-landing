/**
 * MindBeamer Analytics Cookie Cleanup
 *
 * Diese standalone JavaScript-Datei sorgt für die DSGVO-konforme Löschung
 * von Google Analytics-Cookies, wenn der Benutzer Analytics deaktiviert hat.
 * 
 * @license MIT
 * @author Cascade
 * @version 1.0.0
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
     * Löscht alle Google Analytics-Cookies gründlich
     * 
     * @return {void}
     */
    function deleteAllGACookies() {
        // Liste der möglichen Domains, auf denen Cookies gesetzt sein könnten
        const possibleDomains = [
            '', // Leere Domain = aktueller Host
            '.mindbeamer.io',
            'mindbeamer.io',
            'www.mindbeamer.io',
            window.location.hostname
        ];
        
        // Liste der bekannten GA-Cookie-Präfixe
        const cookiePrefixes = ['_ga', '_gid', '_gat', '_gac', '_gali', '_gat_gtag'];
        
        // Alle bekannten Cookies und ihre Varianten löschen
        for (const prefix of cookiePrefixes) {
            for (const domain of possibleDomains) {
                // Mit verschiedenen Pfaden löschen
                const domainStr = domain ? `; Domain=${domain}` : '';
                document.cookie = `${prefix}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}; SameSite=Lax`;
                document.cookie = `${prefix}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}; SameSite=None; Secure`;
            }
        }
        
        // Alle vorhandenen Cookies durchsuchen nach dynamischen GA-Cookies
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            const cookieName = cookie.split('=')[0];
            
            // Prüfen auf dynamische GA-Cookies (z.B. _ga_XXXXXXXX)
            if (cookieName.startsWith('_ga_') || 
                cookieName.startsWith('_gac_') || 
                cookieName.startsWith('_gat_')) {
                
                for (const domain of possibleDomains) {
                    const domainStr = domain ? `; Domain=${domain}` : '';
                    document.cookie = `${cookieName}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}; SameSite=Lax`;
                    document.cookie = `${cookieName}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}; SameSite=None; Secure`;
                }
                
                console.debug('[MB-ANALYTICS] GA-Cookie gelöscht:', cookieName);
            }
        }
        
        // GA-Speicher leeren
        try {
            localStorage.removeItem('_ga');
            sessionStorage.removeItem('_ga');
        } catch (e) {
            // Ignorieren, falls localStorage nicht verfügbar ist
        }
        
        console.debug('[MB-ANALYTICS] Alle Google Analytics-Cookies wurden gelöscht');
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
        
        // Alle GA-Cookies löschen
        deleteAllGACookies();
    }
    
    /**
     * Hauptfunktion, die bei jedem Seitenladen ausgeführt wird
     * 
     * @return {void}
     */
    function init() {
        // Den Namen des Analytics-Cookies bestimmen
        const cookiePrefix = 'MindBeamer'; // Fallback-Wert
        let analyticsName = `${cookiePrefix}_cookie_analytics`;
        
        // Den Cookie-Wert auslesen
        const analyticsCookie = getCookie(analyticsName);
        
        // Wenn Analytics deaktiviert ist, Google Analytics blockieren
        if (analyticsCookie === 'false') {
            blockGoogleAnalytics();
        }
        
        // Event-Listener für Änderungen am Cookie-Modal hinzufügen
        document.addEventListener('click', function(event) {
            // Auf Klicks auf den Speichern-Button im Cookie-Modal reagieren
            if (event.target && (
                event.target.classList.contains('cookie-preferences-save') || 
                event.target.hasAttribute('data-cc') && event.target.getAttribute('data-cc') === 'save' ||
                event.target.textContent.includes('Save Preferences') ||
                event.target.textContent.includes('Guardar Preferencias')
            )) {
                // Kurze Verzögerung, um sicherzustellen, dass Cookies gesetzt wurden
                setTimeout(function() {
                    const currentValue = getCookie(analyticsName);
                    if (currentValue === 'false') {
                        blockGoogleAnalytics();
                    }
                }, 100);
            }
        }, true);
        
        // Kontinuierlich auf Cookie-Änderungen prüfen
        setInterval(function() {
            const currentValue = getCookie(analyticsName);
            if (currentValue === 'false') {
                blockGoogleAnalytics();
            }
        }, 2000); // Alle 2 Sekunden prüfen
    }
    
    // Initialisierung beim Laden der Seite
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
