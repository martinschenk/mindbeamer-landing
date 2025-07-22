<template>
  <header class="bg-white shadow-md fixed top-0 w-full z-20 border-b border-gray-100" :style="headerStyle">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center w-full">
      <!-- Logo -->
      <router-link :to="homeRoute" class="flex items-center space-x-2">
        <!-- MindBeamer Logo Icon -->
        <svg width="32" height="32" viewBox="0 0 40 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="logo-icon">
          <g>
            <circle cx="5" cy="40" r="6" fill="#6366f1" class="text-primary"></circle>
            <path d="M5 25 A15 15 0 0 1 20 40 A15 15 0 0 1 5 55" stroke="#6366f1" stroke-width="3" fill="none" class="text-primary"></path>
            <path d="M5 15 A25 25 0 0 1 30 40 A25 25 0 0 1 5 65" stroke="#6366f1" stroke-width="2" fill="none" class="text-primary" opacity="0.7"></path>
            <path d="M5 5 A35 35 0 0 1 40 40 A35 35 0 0 1 5 75" stroke="#6366f1" stroke-width="2" fill="none" class="text-primary" opacity="0.4"></path>
          </g>
        </svg>
        <div class="text-2xl font-bold">
          <span class="text-indigo-500" style="font-family: 'Inter', sans-serif;">Mind</span>
          <span class="text-gray-900" style="font-family: 'Inter', sans-serif;">Beamer</span>
        </div>
      </router-link>
      
      <!-- Desktop Navigation -->
      <nav class="hidden lg:flex items-center space-x-8">
        <a :href="`${homeRoute}#how-it-works`" class="text-gray-700 hover:text-indigo-500 font-medium transition-colors">
          {{ t('nav_how_it_works') }}
        </a>
        <a :href="`${homeRoute}#features`" class="text-gray-700 hover:text-indigo-500 font-medium transition-colors">
          {{ t('nav_features') }}
        </a>
        <a :href="`${homeRoute}#why-us`" class="text-gray-700 hover:text-indigo-500 font-medium transition-colors">
          {{ t('nav_why_us') }}
        </a>
        <a :href="`${homeRoute}#pricing`" class="text-gray-700 hover:text-indigo-500 font-medium transition-colors">
          {{ t('nav_pricing') }}
        </a>
        <Button 
          :label="t('nav_demo')"
          severity="primary"
          @click="scrollToContact"
          icon="pi pi-arrow-right"
          iconPos="right"
        />
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
    <Sidebar 
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
          class="text-gray-700 hover:text-indigo-500 font-medium text-lg py-2 transition-colors"
        >
          {{ t('nav_how_it_works') }}
        </a>
        <a 
          :href="`${homeRoute}#features`" 
          @click="closeMobileMenu"
          class="text-gray-700 hover:text-indigo-500 font-medium text-lg py-2 transition-colors"
        >
          {{ t('nav_features') }}
        </a>
        <a 
          :href="`${homeRoute}#why-us`" 
          @click="closeMobileMenu"
          class="text-gray-700 hover:text-indigo-500 font-medium text-lg py-2 transition-colors"
        >
          {{ t('nav_why_us') }}
        </a>
        <a 
          :href="`${homeRoute}#pricing`" 
          @click="closeMobileMenu"
          class="text-gray-700 hover:text-indigo-500 font-medium text-lg py-2 transition-colors"
        >
          {{ t('nav_pricing') }}
        </a>
        <Button 
          :label="t('nav_demo')"
          severity="primary"
          @click="() => { scrollToContact(); closeMobileMenu(); }"
          icon="pi pi-arrow-right"
          iconPos="right"
          class="w-full"
        />
      </nav>
    </Sidebar>
  </header>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useUIStore } from '@/stores/ui';
import { useLocaleStore } from '@/stores/locale';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';

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

function scrollToContact() {
  const element = document.querySelector('#contact');
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
}

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