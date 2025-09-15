import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useUIStore = defineStore('ui', () => {
  // State
  const mobileMenuOpen = ref(false);
  const languageBannerVisible = ref(false);
  const languageBannerDismissed = ref(false);
  const preferredLocale = ref(null);
  const isRootDomain = ref(false);
  
  // Actions
  function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value;
  }
  
  function closeMobileMenu() {
    mobileMenuOpen.value = false;
  }
  
  function dismissLanguageBanner() {
    languageBannerVisible.value = false;
    languageBannerDismissed.value = true;
    // Set cookie to remember dismissal for 24 hours
    document.cookie = 'language_banner_dismissed=1; path=/; max-age=86400';
  }
  
  function setLanguagePreference(locale) {
    // Set permanent cookie for language preference
    document.cookie = `user_language_preference=${locale}; path=/; max-age=${365 * 24 * 60 * 60}`;
  }
  
  function checkLanguageBanner(currentLocale, detectedLocale, rootDomain = false) {
    isRootDomain.value = rootDomain;
    
    // Check if banner was already dismissed
    if (document.cookie.includes('language_banner_dismissed=1')) {
      return;
    }
    
    // Only show on root domain
    if (rootDomain && detectedLocale && detectedLocale !== currentLocale) {
      preferredLocale.value = detectedLocale;
      languageBannerVisible.value = true;
    }
  }
  
  return {
    // State
    mobileMenuOpen,
    languageBannerVisible,
    languageBannerDismissed,
    preferredLocale,
    isRootDomain,
    
    // Actions
    toggleMobileMenu,
    closeMobileMenu,
    dismissLanguageBanner,
    setLanguagePreference,
    checkLanguageBanner
  };
});