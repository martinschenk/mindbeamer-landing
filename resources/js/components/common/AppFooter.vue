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
      
      <!-- Language Dropdown -->
      <div class="flex justify-center mt-4">
        <Dropdown v-model="selectedLocale" :options="localeOptions" optionLabel="label" optionValue="value"
          @change="changeLanguage" 
          class="language-dropdown"
          :pt="{
            root: { class: 'inline-flex' },
            input: { class: 'bg-gray-700 text-gray-200 border border-gray-600 rounded-lg px-4 py-2.5 text-sm hover:bg-gray-600 hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all cursor-pointer shadow-md' },
            trigger: { class: 'text-gray-300 hover:text-gray-100 ml-2' },
            panel: { class: 'bg-gray-800 border border-gray-700 rounded-lg shadow-2xl mt-2 overflow-hidden' },
            item: { class: 'text-gray-300 hover:bg-indigo-600 hover:text-white px-4 py-2.5 text-sm cursor-pointer transition-all duration-200' },
            itemGroup: { class: 'text-gray-400' },
            emptyMessage: { class: 'text-gray-500 px-4 py-2.5' }
          }"
        >
          <template #value="slotProps">
            <div v-if="slotProps.value" class="flex items-center gap-2">
              <span class="text-lg">{{ getLocaleFlag(slotProps.value) }}</span>
              <span>{{ getLocaleName(slotProps.value) }}</span>
            </div>
          </template>
          <template #option="slotProps">
            <div class="flex items-center gap-2">
              <span class="text-lg">{{ slotProps.option.flag }}</span>
              <span>{{ slotProps.option.label }}</span>
            </div>
          </template>
        </Dropdown>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useLocaleStore } from '@/stores/locale';
import { useCookieConsentStore } from '@/stores/cookieConsent';
import Dropdown from 'primevue/dropdown';

const localeStore = useLocaleStore();
const cookieConsentStore = useCookieConsentStore();

const { t, currentLocale, availableLocales, localeNames, localeFlags } = localeStore;

// Selected locale for dropdown
const selectedLocale = ref(currentLocale);

// Prepare options for dropdown
const localeOptions = computed(() => {
  return availableLocales.map(locale => ({
    value: locale,
    label: localeNames[locale] || locale,
    flag: localeFlags.value?.[locale] || localeFlags[locale] || '🏳️'
  }));
});

// Helper functions for template
function getLocaleName(locale) {
  return localeNames[locale] || locale;
}

function getLocaleFlag(locale) {
  return localeFlags.value?.[locale] || localeFlags[locale] || '🏳️';
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

function changeLanguage(event) {
  const newLocale = event.value;
  window.location.href = getLanguageUrl(newLocale);
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
/* Custom styling for dropdown in dark footer */
.language-dropdown :deep(.p-dropdown-trigger) {
  border-left: 1px solid rgb(107 114 128);
  padding-left: 0.5rem;
}

.language-dropdown :deep(.p-dropdown-panel) {
  max-height: 320px;
  overflow-y: auto;
  background-color: rgb(31 41 55);
  border-color: rgb(55 65 81);
}

.language-dropdown :deep(.p-dropdown-item.p-highlight) {
  background-color: rgb(79 70 229);
  color: white;
}

.language-dropdown :deep(.p-dropdown-item.p-focus) {
  background-color: rgb(55 65 81);
  color: white;
}

.language-dropdown :deep(.p-dropdown-items-wrapper) {
  background-color: rgb(31 41 55);
}

.language-dropdown :deep(.p-dropdown-trigger svg) {
  color: rgb(209 213 219);
}
</style>