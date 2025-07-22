<template>
  <section id="social-proof" class="py-20 bg-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(59, 130, 246, 0.1) 35px, rgba(59, 130, 246, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900 mb-4">
          {{ t('proof_headline') }}
        </h2>
        <p class="text-xl text-surface-600 max-w-3xl mx-auto">
          {{ t('proof_subheadline') }}
        </p>
      </div>
      
      <!-- Live Stats -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto mb-16">
        <div class="text-center fade-in" style="animation-delay: 0.1s;">
          <h3 class="text-4xl md:text-5xl font-bold text-primary-600 mb-2">{{ t('proof_stat1_number') }}</h3>
          <p class="text-surface-700 font-semibold">{{ t('proof_stat1_label') }}</p>
          <p class="text-sm text-surface-600">{{ t('proof_stat1_detail') }}</p>
        </div>
        <div class="text-center fade-in" style="animation-delay: 0.2s;">
          <h3 class="text-4xl md:text-5xl font-bold text-primary-600 mb-2">{{ t('proof_stat2_number') }}</h3>
          <p class="text-surface-700 font-semibold">{{ t('proof_stat2_label') }}</p>
          <p class="text-sm text-surface-600">{{ t('proof_stat2_detail') }}</p>
        </div>
        <div class="text-center fade-in" style="animation-delay: 0.3s;">
          <h3 class="text-4xl md:text-5xl font-bold text-green-600 mb-2">{{ t('proof_stat3_number') }}</h3>
          <p class="text-surface-700 font-semibold">{{ t('proof_stat3_label') }}</p>
          <p class="text-sm text-surface-600">{{ t('proof_stat3_detail') }}</p>
        </div>
        <div class="text-center fade-in" style="animation-delay: 0.4s;">
          <h3 class="text-4xl md:text-5xl font-bold text-primary-600 mb-2">{{ t('proof_stat4_number') }}</h3>
          <p class="text-surface-700 font-semibold">{{ t('proof_stat4_label') }}</p>
          <p class="text-sm text-surface-600">{{ t('proof_stat4_detail') }}</p>
        </div>
      </div>
      
      <!-- Live Demo Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <!-- Featured Demo Card -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in relative overflow-hidden bg-gradient-to-br from-primary-50 to-white lg:col-span-3" style="animation-delay: 0.5s;">
          <div class="absolute top-4 right-4">
            <span class="text-red-600 font-bold animate-pulse">{{ t('proof_live_indicator') }}</span>
          </div>
          <h3 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_demo1_title') }}</h3>
          <p class="text-surface-600 mb-4">{{ t('proof_demo1_desc') }}</p>
          <a 
            href="https://startups-espanolas.es" 
            target="_blank"
            class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold group-hover:underline"
          >
            {{ t('proof_demo1_link') }}
            <i class="pi pi-external-link ml-1 text-sm"></i>
          </a>
          <p class="text-sm text-surface-500 mt-4">{{ t('proof_demo1_update') }}</p>
        </div>
        
        <!-- LinkedIn Demo Card -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in relative overflow-hidden" style="animation-delay: 0.6s;">
          <div class="absolute top-4 right-4">
            <span class="text-red-600 font-bold animate-pulse">{{ t('proof_live_indicator') }}</span>
          </div>
          <h3 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_demo2_title') }}</h3>
          <p class="text-surface-600 mb-4">{{ t('proof_demo2_desc') }}</p>
          <a 
            href="https://linkedin.com/company/startups-espanolas" 
            target="_blank"
            class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold group-hover:underline"
          >
            {{ t('proof_demo2_link') }}
            <i class="pi pi-external-link ml-1 text-sm"></i>
          </a>
        </div>
        
        <!-- Instagram Demo Card -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in relative overflow-hidden" style="animation-delay: 0.7s;">
          <div class="absolute top-4 right-4">
            <span class="text-red-600 font-bold animate-pulse">{{ t('proof_live_indicator') }}</span>
          </div>
          <h3 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_demo3_title') }}</h3>
          <p class="text-surface-600 mb-4">{{ t('proof_demo3_desc') }}</p>
          <a 
            href="https://instagram.com/start_up_esp" 
            target="_blank"
            class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold group-hover:underline"
          >
            {{ t('proof_demo3_link') }}
            <i class="pi pi-external-link ml-1 text-sm"></i>
          </a>
        </div>
        
        <!-- Facebook Demo Card -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in relative overflow-hidden" style="animation-delay: 0.8s;">
          <div class="absolute top-4 right-4">
            <span class="text-red-600 font-bold animate-pulse">{{ t('proof_live_indicator') }}</span>
          </div>
          <h3 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_demo4_title') }}</h3>
          <p class="text-surface-600 mb-4">{{ t('proof_demo4_desc') }}</p>
          <a 
            href="https://www.facebook.com/startups.espanolas" 
            target="_blank"
            class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold group-hover:underline"
          >
            {{ t('proof_demo4_link') }}
            <i class="pi pi-external-link ml-1 text-sm"></i>
          </a>
        </div>
        
        <!-- Twitter Demo Card -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in relative overflow-hidden lg:col-span-2" style="animation-delay: 0.9s;">
          <div class="absolute top-4 right-4">
            <span class="text-red-600 font-bold animate-pulse">{{ t('proof_live_indicator') }}</span>
          </div>
          <h3 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_demo5_title') }}</h3>
          <p class="text-surface-600 mb-4">{{ t('proof_demo5_desc') }}</p>
          <a 
            href="https://x.com/StartupsEsp" 
            target="_blank"
            class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold group-hover:underline"
          >
            {{ t('proof_demo5_link') }}
            <i class="pi pi-external-link ml-1 text-sm"></i>
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useLocaleStore } from '@/stores/locale';

const { t } = useLocaleStore();
</script>

<style scoped lang="scss">
.fade-in {
  animation: fadeInUp 0.8s ease-out both;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>