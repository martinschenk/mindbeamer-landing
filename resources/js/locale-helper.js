/**
 * MindBeamer Locale Helper
 * 
 * Stellt sicher, dass die Spracheinstellungen konsistent bleiben
 * Beinhaltet eine robuste Methode zur Ermittlung der aktuellen Locale
 */
const LocaleHelper = {
    /**
     * Ermittelt die aktuelle Locale mit einer Prioritätsreihenfolge:
     * 1. Cookie 'app_locale'
     * 2. URL-Pfad
     * 3. HTML lang-Attribut
     * 4. Default (en)
     * 
     * @returns {string} Die ermittelte Locale
     */
    getCurrentLocale: function() {
        // 1. Versuche zuerst, die Locale aus dem Cookie zu lesen
        const cookieLocale = this.getLocaleCookie();
        if (cookieLocale) {
            console.log('Locale from cookie:', cookieLocale);
            return cookieLocale;
        }
        
        // 2. Versuche, die Locale aus dem URL-Pfad zu extrahieren
        const pathParts = window.location.pathname.split('/');
        if (pathParts.length > 1 && pathParts[1] && pathParts[1].length >= 2) {
            const urlLocale = pathParts[1];
            // Prüfe, ob die URL-Locale ein gültiges Format hat (z.B. 'de', 'en', 'zh_CN')
            if (/^[a-z]{2}(_[A-Z]{2})?$/.test(urlLocale)) {
                console.log('Locale from URL path:', urlLocale);
                return urlLocale;
            }
        }
        
        // 3. Versuche, die Locale aus dem HTML lang-Attribut zu lesen
        const htmlLang = document.documentElement.lang;
        if (htmlLang) {
            // Konvertiere Bindestrich-Format (für HTML) zurück zu Unterstrich-Format (für APIs)
            const normalizedLang = htmlLang.replace('-', '_');
            console.log('Locale from HTML lang attribute:', normalizedLang);
            return normalizedLang;
        }
        
        // 4. Fallback auf Default-Locale
        console.log('No locale found, using default: en');
        return 'en';
    },
    
    /**
     * Liest die Locale aus dem Cookie 'app_locale'
     * 
     * @returns {string|null} Die Locale aus dem Cookie oder null
     */
    getLocaleCookie: function() {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.startsWith('app_locale=')) {
                return cookie.substring('app_locale='.length);
            }
        }
        return null;
    },
    
    /**
     * Setzt die app_locale in einem Cookie
     * 
     * @param {string} locale Die zu speichernde Locale
     * @param {number} days Gültigkeitsdauer in Tagen
     */
    setLocaleCookie: function(locale, days = 30) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = "app_locale=" + locale + ";" + expires + ";path=/";
        console.log('Set locale cookie:', locale);
    },
    
    /**
     * Stellt sicher, dass HTTP-Anfragen die korrekte Locale-Information enthalten
     * 
     * @param {Headers|Object} headers HTTP-Header-Objekt oder einfaches Objekt
     * @returns {Headers|Object} Die aktualisierten Header
     */
    addLocaleToHeaders: function(headers) {
        const locale = this.getCurrentLocale();
        
        // Wenn Headers ein Headers-Objekt ist
        if (headers instanceof Headers) {
            headers.set('X-Locale', locale);
        } 
        // Wenn Headers ein einfaches Objekt ist
        else if (typeof headers === 'object') {
            headers['X-Locale'] = locale;
        }
        
        return headers;
    }
};

// Für ES-Module
export default LocaleHelper;
