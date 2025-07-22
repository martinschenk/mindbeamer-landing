<template>
  <div class="landing-layout">
    <!-- Language Preference Banner -->
    <LanguageBanner />
    
    <!-- Header -->
    <AppHeader />
    
    <!-- Main Content -->
    <main class="main-content">
      <RouterView />
    </main>
    
    <!-- Footer -->
    <AppFooter />
    
    <!-- Cookie Consent -->
    <CookieConsent />
    
    <!-- Notifications -->
    <Toast position="top-right" />
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useUIStore } from '@/stores/ui';
import { useLocaleStore } from '@/stores/locale';
import AppHeader from '@/components/common/AppHeader.vue';
import AppFooter from '@/components/common/AppFooter.vue';
import LanguageBanner from '@/components/common/LanguageBanner.vue';
import CookieConsent from '@/components/common/CookieConsent.vue';
import Toast from 'primevue/toast';

const uiStore = useUIStore();
const localeStore = useLocaleStore();

onMounted(() => {
  // Check if we should show language banner
  const currentLocale = localeStore.currentLocale;
  const preferredLocale = window.__APP_DATA__?.preferredLocale;
  const isRootDomain = window.__APP_DATA__?.isRootDomain;
  
  if (preferredLocale && isRootDomain) {
    uiStore.checkLanguageBanner(currentLocale, preferredLocale, isRootDomain);
  }
});
</script>

<style scoped lang="scss">
.landing-layout {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.main-content {
  flex: 1;
  padding-top: 0; // Remove padding - sections will handle their own spacing
}
</style>