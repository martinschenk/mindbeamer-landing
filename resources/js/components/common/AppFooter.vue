<template>
  <footer class="bg-gray-900 text-white py-8 w-full overflow-hidden">
    <div class="container mx-auto px-6 text-center w-full">
      <p class="mb-2">&copy; 2025 <span translate="no">MindBeamer</span>. {{ t('all_rights_reserved') }}</p>
      
      <!-- Links -->
      <div class="flex flex-wrap justify-center mt-4 mb-4 gap-4 md:gap-6 px-2">
        <router-link 
          :to="getLocalizedUrl('privacy')" 
          class="text-gray-400 hover:text-indigo-400 transition-colors"
        >
          {{ t('footer_privacy') }}
        </router-link>
        <router-link 
          :to="getLocalizedUrl('impressum')" 
          class="text-gray-400 hover:text-indigo-400 transition-colors"
        >
          {{ getLegalTranslation('impressum_title') }}
        </router-link>
        <router-link 
          :to="getLocalizedUrl('terms')" 
          class="text-gray-400 hover:text-indigo-400 transition-colors"
        >
          {{ getLegalTranslation('terms_title') }}
        </router-link>
        <a 
          href="javascript:void(0);" 
          @click="openCookieSettings" 
          class="text-gray-400 hover:text-indigo-400 transition-colors cursor-pointer"
        >
          {{ t('cookie_settings') }}
        </a>
      </div>
      
      <!-- Language Switcher -->
      <div class="flex justify-center space-x-4">
        <div class="flex items-center space-x-2">
          <a 
            v-for="(locale, index) in availableLocales" 
            :key="locale"
            :href="getLanguageUrl(locale)"
            class="text-gray-400 hover:text-white transition-colors"
            :class="{ 'font-bold text-white': currentLocale === locale }"
          >
            {{ locale.toUpperCase() }}
            <span v-if="index < availableLocales.length - 1" class="text-gray-500 mx-2">|</span>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { computed } from 'vue';
import { useLocaleStore } from '@/stores/locale';
import { useCookieConsentStore } from '@/stores/cookieConsent';

const localeStore = useLocaleStore();
const cookieConsentStore = useCookieConsentStore();

const { t, currentLocale, availableLocales } = localeStore;

// Fix legal translations access
function getLegalTranslation(key) {
  const legalTranslations = window.__APP_DATA__?.legalTranslations || {};
  return legalTranslations[key] || key;
}
const { openSettings } = cookieConsentStore;

function openCookieSettings() {
  openSettings();
}

function getLocalizedUrl(page) {
  const locale = currentLocale;
  const urlMap = {
    privacy: {
      en: '/privacy-policy',
      de: '/de/datenschutz-richtlinie',
      es: '/es/politica-privacidad',
      zh_CN: '/zh_CN/privacy-policy',
      pt_BR: '/pt_BR/politica-privacidade',
      fr: '/fr/politique-confidentialite'
    },
    impressum: {
      en: '/legal-notice',
      de: '/de/impressum',
      es: '/es/aviso-legal',
      zh_CN: '/zh_CN/legal-notice',
      pt_BR: '/pt_BR/aviso-legal',
      fr: '/fr/mentions-legales'
    },
    terms: {
      en: '/terms',
      de: '/de/agb',
      es: '/es/terminos',
      zh_CN: '/zh_CN/terms',
      pt_BR: '/pt_BR/termos',
      fr: '/fr/conditions'
    }
  };
  
  return urlMap[page]?.[locale] || urlMap[page]?.en || '#';
}

function getLanguageUrl(locale) {
  // For language switching, preserve the current page
  const currentPath = window.location.pathname;
  
  // If on root, just return the locale path
  if (currentPath === '/') {
    return locale === 'en' ? '/' : `/${locale}`;
  }
  
  // Extract the page from current path and return localized version
  // This is simplified - in production you'd want more robust logic
  if (currentPath.includes('privacy') || currentPath.includes('datenschutz')) {
    return getLocalizedUrl('privacy').replace(currentLocale, locale);
  } else if (currentPath.includes('legal') || currentPath.includes('impressum') || currentPath.includes('aviso')) {
    return getLocalizedUrl('impressum').replace(currentLocale, locale);
  } else if (currentPath.includes('terms') || currentPath.includes('agb') || currentPath.includes('terminos')) {
    return getLocalizedUrl('terms').replace(currentLocale, locale);
  }
  
  // Default to home page for the locale
  return locale === 'en' ? '/' : `/${locale}`;
}
</script>