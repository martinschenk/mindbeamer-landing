<template>
  <header class="bg-white shadow-md fixed top-0 w-full z-20 border-b border-gray-100" :style="headerStyle">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center w-full">
      <!-- Logo -->
      <router-link :to="homeRoute">
        <MindBeamerLogo size="sm" />
      </router-link>
      
      <!-- Desktop Navigation -->
      <nav class="hidden lg:flex items-center space-x-8">
        <a :href="`${homeRoute}#how-it-works`" class="text-surface-900 hover:text-primary font-medium transition-colors">
          {{ t('nav_how_it_works') }}
        </a>
        <a :href="`${homeRoute}#features`" class="text-surface-900 hover:text-primary font-medium transition-colors">
          {{ t('nav_features') }}
        </a>
        <a :href="`${homeRoute}#problem`" class="text-surface-900 hover:text-primary font-medium transition-colors">
          {{ t('nav_why_us') }}
        </a>
        <a :href="`${homeRoute}#pricing`" class="text-surface-900 hover:text-primary font-medium transition-colors">
          {{ t('nav_pricing') }}
        </a>
        <a 
          :href="`${homeRoute}#demo`"
          class="p-button p-component p-button-primary text-white"
        >
          <span class="p-button-label text-white">{{ t('nav_demo') }}</span>
          <i class="pi pi-arrow-right p-button-icon-right text-white"></i>
        </a>
      </nav>
      
      <!-- Mobile Menu Button -->
      <Button 
        class="lg:hidden"
        icon="pi pi-bars"
        severity="secondary"
        text
        @click="toggleMobileMenu"
      />
    </div>
    
    <!-- Mobile Menu -->
    <Drawer 
      v-model:visible="mobileMenuOpen"
      position="right"
      :showCloseIcon="false"
      :modal="true"
      class="w-80"
    >
      <template #header>
        <div class="flex items-center justify-between w-full">
          <span class="text-xl font-semibold">Menu</span>
          <Button 
            icon="pi pi-times"
            severity="secondary"
            text
            rounded
            @click="closeMobileMenu"
          />
        </div>
      </template>
      
      <nav class="flex flex-col space-y-4">
        <a 
          :href="`${homeRoute}#how-it-works`" 
          @click="closeMobileMenu"
          class="text-surface-900 hover:text-primary font-medium text-lg py-2 transition-colors"
        >
          {{ t('nav_how_it_works') }}
        </a>
        <a 
          :href="`${homeRoute}#features`" 
          @click="closeMobileMenu"
          class="text-surface-900 hover:text-primary font-medium text-lg py-2 transition-colors"
        >
          {{ t('nav_features') }}
        </a>
        <a 
          :href="`${homeRoute}#problem`" 
          @click="closeMobileMenu"
          class="text-surface-900 hover:text-primary font-medium text-lg py-2 transition-colors"
        >
          {{ t('nav_why_us') }}
        </a>
        <a 
          :href="`${homeRoute}#pricing`" 
          @click="closeMobileMenu"
          class="text-surface-900 hover:text-primary font-medium text-lg py-2 transition-colors"
        >
          {{ t('nav_pricing') }}
        </a>
        <a 
          :href="`${homeRoute}#demo`"
          @click="closeMobileMenu"
          class="p-button p-component p-button-primary w-full text-center text-white"
        >
          <span class="p-button-label text-white">{{ t('nav_demo') }}</span>
          <i class="pi pi-arrow-right p-button-icon-right text-white"></i>
        </a>
      </nav>
    </Drawer>
  </header>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useUIStore } from '@/stores/ui';
import { useLocaleStore } from '@/stores/locale';
import Button from 'primevue/button';
import Drawer from 'primevue/drawer';
import MindBeamerLogo from '@/components/common/MindBeamerLogo.vue';

const uiStore = useUIStore();
const localeStore = useLocaleStore();

const { mobileMenuOpen, languageBannerVisible } = storeToRefs(uiStore);
const { toggleMobileMenu, closeMobileMenu } = uiStore;
const { t, currentLocale } = localeStore;

// Header offset for language banner
const headerOffset = ref(0);

const homeRoute = computed(() => {
  return currentLocale === 'en' ? '/' : `/${currentLocale}`;
});

const headerStyle = computed(() => ({
  top: `${headerOffset.value}px`,
  transition: 'top 0.3s ease'
}));


function updateHeaderOffset() {
  const banner = document.getElementById('language-preference-banner');
  if (banner && languageBannerVisible.value) {
    headerOffset.value = banner.offsetHeight;
  } else {
    headerOffset.value = 0;
  }
}

onMounted(() => {
  updateHeaderOffset();
  window.addEventListener('resize', updateHeaderOffset);
});

onUnmounted(() => {
  window.removeEventListener('resize', updateHeaderOffset);
});
</script>

<style scoped>
header {
  transition: top 0.3s ease;
}
</style>