import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';

// PrimeVue
import PrimeVue from 'primevue/config';
import { definePreset } from '@primeuix/themes';
import Lara from '@primeuix/themes/lara';
import ConfirmationService from 'primevue/confirmationservice';
import ToastService from 'primevue/toastservice';

// Styles
import '../css/app.css';
import './assets/styles/main.scss';
// Primeicons CSS import moved to app.blade.php to avoid build issues

// Create app
const app = createApp(App);

// Create Pinia
const pinia = createPinia();

// Diamond Theme Configuration - MindBeamer Blue
const MindBeamerPreset = definePreset(Lara, {
    semantic: {
        primary: {
            50: '#eff6ff',
            100: '#dbeafe',
            200: '#bfdbfe',
            300: '#93c5fd',
            400: '#60a5fa',
            500: '#3b82f6',
            600: '#2563eb',
            700: '#1d4ed8',
            800: '#1e40af',
            900: '#1e3a8a',
            950: '#172554'
        },
        colorScheme: {
            light: {
                surface: {
                    0: '#ffffff',
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                    950: '#020617'
                }
            },
            dark: {
                surface: {
                    0: '#ffffff',
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                    950: '#020617'
                }
            }
        }
    }
});

// Use plugins
app.use(pinia);
app.use(router);
app.use(PrimeVue, {
    theme: {
        preset: MindBeamerPreset,
        options: {
            darkModeSelector: '.app-dark',
            cssLayer: {
                name: 'primevue',
                order: 'tailwind-base, primevue, tailwind-utilities'
            }
        }
    }
});
app.use(ToastService);
app.use(ConfirmationService);

// Mount app
app.mount('#app');

// Handle anchor link scrolling with fixed header offset
document.addEventListener('DOMContentLoaded', () => {
    // Handle all clicks on the document
    document.addEventListener('click', (e) => {
        // Check if clicked element is a hash link
        const link = e.target.closest('a[href*="#"]');
        if (!link) return;
        
        const href = link.getAttribute('href');
        if (!href || href === '#') return;
        
        // Extract hash from href
        const hashIndex = href.indexOf('#');
        if (hashIndex === -1) return;
        
        const hash = href.substring(hashIndex);
        const target = document.querySelector(hash);
        
        if (target) {
            e.preventDefault();
            
            // Calculate position with offset
            const headerOffset = 50; // Adjust this value
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
            
            window.scrollTo({
                top: offsetPosition,
                behavior: 'auto'
            });
            
            // Update URL without triggering router
            if (history.pushState) {
                history.pushState(null, null, href);
            }
        }
    });
});