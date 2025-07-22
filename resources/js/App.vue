<template>
  <RouterView />
  <Toast />
</template>

<script setup>
import { onMounted } from 'vue';
import { useLocaleStore } from '@/stores/locale';
import { useCookieConsentStore } from '@/stores/cookieConsent';
import Toast from 'primevue/toast';

// Initialize stores
const localeStore = useLocaleStore();
const cookieConsentStore = useCookieConsentStore();

onMounted(() => {
  // Initialize locale from Laravel
  if (window.__APP_DATA__?.locale) {
    localeStore.setLocale(window.__APP_DATA__.locale);
  }
  
  // Initialize cookie consent
  cookieConsentStore.init();
});
</script>