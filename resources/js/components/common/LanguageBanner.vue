<template>
  <div 
    v-if="languageBannerVisible && preferredLocale && isRootDomain"
    class="fixed top-0 left-0 right-0 bg-blue-600 text-white p-3 shadow-lg z-50"
  >
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
        </svg>
        <p class="text-sm md:text-base">
          {{ getBannerText() }}
        </p>
      </div>
      <div class="flex items-center space-x-2">
        <a 
          :href="`/${preferredLocale}`" 
          @click="handleLanguageSwitch"
          class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors text-sm"
        >
          {{ getSwitchText() }}
        </a>
        <button 
          @click="dismissBanner" 
          class="text-white/80 hover:text-white p-2"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useUIStore } from '@/stores/ui';
import { useLocaleStore } from '@/stores/locale';

const uiStore = useUIStore();
const localeStore = useLocaleStore();

const { languageBannerVisible, preferredLocale, isRootDomain } = storeToRefs(uiStore);
const { dismissLanguageBanner, setLanguagePreference } = uiStore;

function getBannerText() {
  const texts = {
    de: 'Diese Seite ist auch auf Deutsch verfügbar',
    es: 'Esta página también está disponible en español',
    zh_CN: '此页面也有中文版本',
    en: 'This page is available in your language'
  };
  return texts[preferredLocale.value] || texts.en;
}

function getSwitchText() {
  const texts = {
    de: 'Auf Deutsch wechseln',
    es: 'Cambiar a español',
    zh_CN: '切换到中文',
    en: 'Switch Language'
  };
  return texts[preferredLocale.value] || texts.en;
}

function handleLanguageSwitch(e) {
  setLanguagePreference(preferredLocale.value);
  // Let the browser handle the navigation
}

function dismissBanner() {
  dismissLanguageBanner();
}
</script>