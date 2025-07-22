import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useCookieConsentStore = defineStore('cookieConsent', () => {
  // State
  const showModal = ref(false);
  const showSettingsModal = ref(false);
  const consent = ref({
    analytics: false,
    preferences: false
  });
  
  // Actions
  function init() {
    // Exact copy of Alpine.js logic
    const saved = localStorage.getItem('cookieConsent');
    const hasCookie = document.cookie.split(';').some(c => 
      c.trim().startsWith('cookieConsent=')
    );
    
    if (!saved || !hasCookie) {
      showModal.value = true;
      if (saved && !hasCookie) {
        localStorage.removeItem('cookieConsent');
      }
    } else {
      consent.value = JSON.parse(saved);
      applyConsent();
    }
  }
  
  function acceptAll() {
    consent.value.analytics = true;
    consent.value.preferences = true;
    storeConsent();
    applyConsent();
    showModal.value = false;
  }
  
  function declineAll() {
    consent.value.analytics = false;
    consent.value.preferences = false;
    storeConsent();
    applyConsent();
    showModal.value = false;
  }
  
  function showSettings() {
    showModal.value = false;
    showSettingsModal.value = true;
  }
  
  function cancelSettings() {
    showSettingsModal.value = false;
    showModal.value = true;
  }
  
  function saveSettings() {
    storeConsent();
    applyConsent();
    showSettingsModal.value = false;
    showModal.value = false;
  }
  
  function storeConsent() {
    // Store in localStorage
    localStorage.setItem('cookieConsent', JSON.stringify(consent.value));
    
    // Also store as cookie (1 year validity)
    const cookieValue = encodeURIComponent(JSON.stringify(consent.value));
    const oneYear = 365 * 24 * 60 * 60;
    document.cookie = `cookieConsent=${cookieValue}; path=/; max-age=${oneYear}; SameSite=Lax`;
  }
  
  function applyConsent() {
    if (consent.value.analytics) {
      loadGoogleAnalytics();
    } else {
      removeGoogleAnalytics();
    }
    
    if (consent.value.preferences) {
      setLocaleCookie(getLocale());
    } else {
      deleteCookie('locale');
    }
  }
  
  function loadGoogleAnalytics() {
    if (document.getElementById('ga-script')) return;
    
    const s = document.createElement('script');
    s.src = "https://www.googletagmanager.com/gtag/js?id=G-8ESLMYS9SV";
    s.async = true;
    s.id = "ga-script";
    document.head.appendChild(s);
    
    window.dataLayer = window.dataLayer || [];
    window.gtag = function () { dataLayer.push(arguments); };
    gtag('js', new Date());
    gtag('config', 'G-8ESLMYS9SV');
  }
  
  function removeGoogleAnalytics() {
    const knownPrefixes = ['_ga', '_gid', '_gat', '__ga', '__gads'];
    
    document.cookie.split(';').forEach(cookie => {
      const name = cookie.trim().split('=')[0];
      if (knownPrefixes.some(prefix => name.startsWith(prefix))) {
        deleteCookie(name);
      }
    });
    
    const script = document.getElementById('ga-script');
    if (script) script.remove();
  }
  
  function deleteCookie(name) {
    document.cookie = `${name}=; Max-Age=0; path=/; SameSite=Lax`;
  }
  
  function setLocaleCookie(value) {
    document.cookie = `locale=${value}; path=/; max-age=31536000; SameSite=Lax`;
  }
  
  function getLocale() {
    return document.documentElement.lang || 'en';
  }
  
  function openSettings() {
    showModal.value = false;
    showSettingsModal.value = true;
  }
  
  // Global function for backwards compatibility
  if (typeof window !== 'undefined') {
    window.openCookieSettings = openSettings;
  }
  
  return {
    // State
    showModal,
    showSettingsModal,
    consent,
    
    // Actions
    init,
    acceptAll,
    declineAll,
    showSettings,
    cancelSettings,
    saveSettings,
    openSettings
  };
});