/**
 * Main JavaScript file for MindBeamer Landing Page
 */

// Import Alpine.js
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Import our CSS file which includes Tailwind CSS
import '../css/app.css';

// Import unsere eigene Notifications-Implementierung
import './notifications.js';

// Import the contact form handler
import './contact-form.js';

// Initialize Alpine
Alpine.start();

// Global translations object based on current locale
window.translations = {
    // Common notifications translations
    sending: document.documentElement.lang === 'de' ? 'Wird gesendet...' : 'Sending...',
    error: document.documentElement.lang === 'de' ? 'Fehler' : 'Error',
    connection_error: document.documentElement.lang === 'de' 
        ? 'Verbindungsfehler. Bitte versuchen Sie es erneut.' 
        : 'Connection error. Please try again.',
    
    // Success message
    form_success: document.documentElement.lang === 'de'
        ? 'Vielen Dank für Ihre Anfrage! Wir werden uns in Kürze bei Ihnen melden.'
        : 'Thank you for your request! We will get back to you shortly.',
        
    // Error messages
    form_error: document.documentElement.lang === 'de'
        ? 'Beim Senden Ihrer Anfrage ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.'
        : 'There was an error submitting your request. Please try again later.',
        
    validation_error: document.documentElement.lang === 'de'
        ? 'Bitte überprüfen Sie Ihre Eingaben.'
        : 'Please check your inputs.'
};
