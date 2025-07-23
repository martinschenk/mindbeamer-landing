import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useLocaleStore = defineStore('locale', () => {
  // State
  const currentLocale = ref('en');
  const availableLocales = ref(['en', 'de', 'es', 'zh_CN', 'pt_BR', 'fr']);
  const translations = ref({});
  
  // Locale display names
  const localeNames = {
    en: 'English',
    de: 'Deutsch',
    es: 'Español',
    zh_CN: '中文',
    pt_BR: 'Português',
    fr: 'Français'
  };
  
  // Locale flags
  const localeFlags = {
    en: '🇺🇸',
    de: '🇩🇪',
    es: '🇪🇸',
    zh_CN: '🇨🇳',
    pt_BR: '🇧🇷',
    fr: '🇫🇷'
  };
  
  // Getters
  const displayName = computed(() => localeNames[currentLocale.value] || currentLocale.value);
  const flag = computed(() => localeFlags[currentLocale.value] || '🏳️');
  const htmlLang = computed(() => currentLocale.value === 'zh_CN' ? 'zh-CN' : currentLocale.value);
  
  // Actions
  function setLocale(locale) {
    if (availableLocales.value.includes(locale)) {
      currentLocale.value = locale;
      document.documentElement.lang = htmlLang.value;
      
      // Save to cookie for Laravel
      document.cookie = `locale=${locale}; path=/; max-age=31536000; SameSite=Lax`;
    }
  }
  
  function loadTranslations(translationData) {
    translations.value = translationData || {};
  }
  
  function t(key, defaultValue = '') {
    // Handle nested keys (e.g., 'cookie-consent.banner_title')
    if (key.includes('.')) {
      const parts = key.split('.');
      let value = translations.value;
      
      for (const part of parts) {
        if (value && typeof value === 'object' && part in value) {
          value = value[part];
        } else {
          return defaultValue || key;
        }
      }
      
      return value || defaultValue || key;
    }
    
    return translations.value[key] || defaultValue || key;
  }
  
  // Initialize from window data
  if (window.__APP_DATA__) {
    if (window.__APP_DATA__.locale) {
      setLocale(window.__APP_DATA__.locale);
    }
    if (window.__APP_DATA__.translations) {
      loadTranslations(window.__APP_DATA__.translations);
    }
    // Also load cookie and legal translations
    if (window.__APP_DATA__.cookieTranslations) {
      translations.value['cookie-consent'] = window.__APP_DATA__.cookieTranslations;
    }
    if (window.__APP_DATA__.legalTranslations) {
      Object.assign(translations.value, window.__APP_DATA__.legalTranslations);
    }
  }
  
  return {
    // State
    currentLocale,
    availableLocales,
    translations,
    
    // Getters
    displayName,
    flag,
    htmlLang,
    localeNames,
    localeFlags,
    
    // Actions
    setLocale,
    loadTranslations,
    t
  };
});