<template>
  <footer class="bg-gray-900 text-white pt-8 pb-20 w-full relative">
    <div class="container mx-auto px-6 text-center w-full relative overflow-visible">
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
      
      <!-- Language Dropdown - Custom Implementation -->
      <div class="flex justify-center mt-4 relative z-50">
        <div class="relative">
          <!-- Custom Dropdown Button -->
          <button 
            @click="dropdownOpen = !dropdownOpen"
            class="flex items-center gap-2 bg-gray-700 hover:bg-gray-600 text-white border border-gray-600 hover:border-gray-500 rounded-lg px-4 py-2.5 text-sm transition-all cursor-pointer shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
          >
            <span class="text-lg">{{ getLocaleFlag(currentLocale) }}</span>
            <span>{{ getLocaleName(currentLocale) }}</span>
            <svg class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': !dropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          
          <!-- Custom Dropdown Menu -->
          <div 
            v-if="dropdownOpen" 
            class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 min-w-[200px] bg-gray-800 border border-gray-700 rounded-lg shadow-2xl"
            style="z-index: 9999;"
          >
            <div class="py-1">
              <button
                v-for="locale in availableLocales"
                :key="locale"
                @click="changeLanguageCustom(locale)"
                class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-all"
                :class="{ 'bg-indigo-600 text-white': locale === currentLocale }"
              >
                <span class="text-lg">{{ getLocaleFlag(locale) }}</span>
                <span>{{ getLocaleName(locale) }}</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from 'vue';
import { useLocaleStore } from '@/stores/locale';
import { useCookieConsentStore } from '@/stores/cookieConsent';

const localeStore = useLocaleStore();
const cookieConsentStore = useCookieConsentStore();

const { t, currentLocale, availableLocales, localeNames, localeFlags } = localeStore;

// Dropdown state
const dropdownOpen = ref(false);

// Handle click outside
function handleClickOutside(event) {
  const dropdown = event.target.closest('.relative');
  if (!dropdown && dropdownOpen.value) {
    dropdownOpen.value = false;
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});

// Helper functions for template
function getLocaleName(locale) {
  return localeNames[locale] || locale;
}

function getLocaleFlag(locale) {
  // localeFlags is already a ref, access its value properly
  const flags = localeFlags.value || localeFlags;
  return flags[locale] || '🏳️';
}

// Fix legal translations access
function getLegalTranslation(key) {
  const legalTranslations = window.__APP_DATA__?.legalTranslations || {};
  return legalTranslations[key] || key;
}
const { openSettings } = cookieConsentStore;

function openCookieSettings() {
  openSettings();
}

function getLocalizedUrl(page, locale = null) {
  const targetLocale = locale || currentLocale;
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
  
  return urlMap[page]?.[targetLocale] || urlMap[page]?.en || '#';
}

function changeLanguageCustom(locale) {
  dropdownOpen.value = false;
  window.location.href = getLanguageUrl(locale);
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
  if (currentPath.includes('privacy') || currentPath.includes('datenschutz') || currentPath.includes('politica-privacidade') || currentPath.includes('politique-confidentialite')) {
    return getLocalizedUrl('privacy', locale);
  } else if (currentPath.includes('legal') || currentPath.includes('impressum') || currentPath.includes('aviso') || currentPath.includes('mentions-legales')) {
    return getLocalizedUrl('impressum', locale);
  } else if (currentPath.includes('terms') || currentPath.includes('agb') || currentPath.includes('terminos') || currentPath.includes('termos') || currentPath.includes('conditions')) {
    return getLocalizedUrl('terms', locale);
  }
  
  // Default to home page for the locale
  return locale === 'en' ? '/' : `/${locale}`;
}
</script>

<style scoped>
/* Force dark theme for dropdown in footer */
.language-dropdown :deep(.p-dropdown) {
  background-color: rgb(31 41 55) !important;
  border-color: rgb(55 65 81) !important;
  color: white !important;
}

.language-dropdown :deep(.p-dropdown:hover) {
  background-color: rgb(55 65 81) !important;
  border-color: rgb(75 85 99) !important;
}

.language-dropdown :deep(.p-dropdown-label) {
  color: white !important;
}

.language-dropdown :deep(.p-dropdown-trigger) {
  color: rgb(209 213 219) !important;
  border-left: 1px solid rgb(75 85 99) !important;
  padding-left: 0.5rem;
}

.language-dropdown :deep(.p-dropdown-trigger svg) {
  color: rgb(209 213 219) !important;
}

/* Dropdown panel */
.language-dropdown :deep(.p-dropdown-panel) {
  background-color: rgb(31 41 55) !important;
  border: 1px solid rgb(55 65 81) !important;
  margin-top: 0.25rem;
}

.language-dropdown :deep(.p-dropdown-items-wrapper) {
  background-color: rgb(31 41 55) !important;
}

.language-dropdown :deep(.p-dropdown-item) {
  background-color: rgb(31 41 55) !important;
  color: white !important;
  padding: 0.75rem 1rem !important;
}

.language-dropdown :deep(.p-dropdown-item:not(.p-highlight):not(.p-disabled).p-focus) {
  background-color: rgb(55 65 81) !important;
  color: white !important;
}

.language-dropdown :deep(.p-dropdown-item:not(.p-highlight):not(.p-disabled):hover) {
  background-color: rgb(55 65 81) !important;
  color: white !important;
}

.language-dropdown :deep(.p-dropdown-item.p-highlight) {
  background-color: rgb(79 70 229) !important;
  color: white !important;
}

/* Force dark background on all dropdown elements */
.language-dropdown :deep(*) {
  background-color: inherit;
  color: inherit;
}
</style>