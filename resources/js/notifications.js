/**
 * Einfache, zuverlässige Benachrichtigungen für die MindBeamer Landing Page
 * Kompatibel mit Deutsch und Englisch, unabhängig von externen Bibliotheken
 */

class SimpleNotifications {
    constructor() {
        this.container = null;
        this.initialize();
    }
    
    initialize() {
        // Erstelle Container, falls er noch nicht existiert
        if (!this.container) {
            this.container = document.createElement('div');
            this.container.id = 'simple-notifications';
            this.container.className = 'fixed top-4 right-4 z-50 flex flex-col items-end space-y-2';
            document.body.appendChild(this.container);
        }
        
        console.log('SimpleNotifications initialized');
    }
    
    /**
     * Zeige eine Benachrichtigung an
     * @param {string} message - Die Nachricht, die angezeigt werden soll
     * @param {string} type - success, error, warning, info
     * @param {number} duration - Anzeigedauer in Millisekunden
     */
    show(message, type = 'info', duration = 5000) {
        const notification = document.createElement('div');
        
        // Bestimme Farben und Icons basierend auf dem Typ
        let bgColor, textColor, icon;
        
        switch (type) {
            case 'success':
                bgColor = 'bg-pink-500'; // MindBeamer-Pink statt Standard-Grün
                textColor = 'text-white';
                icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                break;
            case 'error':
                bgColor = 'bg-red-500';
                textColor = 'text-white';
                icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                break;
            case 'warning':
                bgColor = 'bg-yellow-500';
                textColor = 'text-white';
                icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
                break;
            default: // info
                bgColor = 'bg-blue-500';
                textColor = 'text-white';
                icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
        }
        
        // Erstelle die Benachrichtigung
        notification.className = `${bgColor} ${textColor} rounded-lg p-4 shadow-lg max-w-sm transform transition-all duration-300 translate-x-0 flex items-center`;
        notification.innerHTML = `
            <div class="mr-3 flex-shrink-0">
                ${icon}
            </div>
            <div class="flex-1">
                ${message}
            </div>
            <button class="ml-4 flex-shrink-0 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;
        
        // Füge Benachrichtigung zum Container hinzu
        this.container.appendChild(notification);
        
        // Animation beim Erscheinen
        setTimeout(() => {
            notification.style.transform = 'translateX(-10px)';
        }, 10);
        
        // Event-Listener für das Schließen
        const closeButton = notification.querySelector('button');
        closeButton.addEventListener('click', () => this.close(notification));
        
        // Automatisches Schließen nach der angegebenen Zeit
        if (duration > 0) {
            setTimeout(() => this.close(notification), duration);
        }
        
        console.log(`Notification shown: ${message}`);
        
        return notification;
    }
    
    /**
     * Schließe eine Benachrichtigung
     * @param {HTMLElement} notification - Das zu schließende Benachrichtigungselement
     */
    close(notification) {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100px)';
        
        // Entferne das Element nach der Animation
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }
    
    /**
     * Zeige eine Erfolgsbenachrichtigung
     * @param {string} message - Die Nachricht
     * @param {number} duration - Anzeigedauer in Millisekunden
     */
    success(message, duration = 5000) {
        return this.show(message, 'success', duration);
    }
    
    /**
     * Zeige eine Fehlerbenachrichtigung
     * @param {string} message - Die Nachricht
     * @param {number} duration - Anzeigedauer in Millisekunden
     */
    error(message, duration = 8000) {
        return this.show(message, 'error', duration);
    }
    
    /**
     * Zeige eine Warnbenachrichtigung
     * @param {string} message - Die Nachricht
     * @param {number} duration - Anzeigedauer in Millisekunden
     */
    warning(message, duration = 6000) {
        return this.show(message, 'warning', duration);
    }
    
    /**
     * Zeige eine Infobenachrichtigung
     * @param {string} message - Die Nachricht
     * @param {number} duration - Anzeigedauer in Millisekunden
     */
    info(message, duration = 5000) {
        return this.show(message, 'info', duration);
    }
}

// Exportiere als globales Objekt
window.notifications = new SimpleNotifications();
