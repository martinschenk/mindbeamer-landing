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
      <div class="flex justify-center mb-16 px-4">
        <div class="bg-primary-50 rounded-2xl p-6 md:p-8 w-full max-w-4xl">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            <div class="text-center fade-in flex flex-col items-center justify-center" style="animation-delay: 0.1s;">
              <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary-600 mb-2 text-center">{{ t('proof_stat1_number') }}</h3>
              <p class="text-sm sm:text-base text-surface-700 font-semibold leading-tight text-center">{{ t('proof_stat1_label') }}</p>
              <p class="text-xs sm:text-sm text-surface-600 mt-1 text-center">{{ t('proof_stat1_detail') }}</p>
            </div>
            <div class="text-center fade-in flex flex-col items-center justify-center" style="animation-delay: 0.2s;">
              <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary-600 mb-2 text-center">{{ t('proof_stat2_number') }}</h3>
              <p class="text-sm sm:text-base text-surface-700 font-semibold leading-tight text-center">{{ t('proof_stat2_label') }}</p>
              <p class="text-xs sm:text-sm text-surface-600 mt-1 text-center">{{ t('proof_stat2_detail') }}</p>
            </div>
            <div class="text-center fade-in flex flex-col items-center justify-center" style="animation-delay: 0.3s;">
              <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold text-green-600 mb-2 text-center">{{ t('proof_stat3_number') }}</h3>
              <p class="text-sm sm:text-base text-surface-700 font-semibold leading-tight text-center">{{ t('proof_stat3_label') }}</p>
              <p class="text-xs sm:text-sm text-surface-600 mt-1 text-center">{{ t('proof_stat3_detail') }}</p>
            </div>
            <div class="text-center fade-in flex flex-col items-center justify-center" style="animation-delay: 0.4s;">
              <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary-600 mb-2 text-center">{{ t('proof_stat4_number') }}</h3>
              <p class="text-sm sm:text-base text-surface-700 font-semibold leading-tight text-center">{{ t('proof_stat4_label') }}</p>
              <p class="text-xs sm:text-sm text-surface-600 mt-1 text-center">{{ t('proof_stat4_detail') }}</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Live Demo Grid -->
      <div class="max-w-6xl mx-auto">
        <!-- All Demos Equal Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- WordPress Blog Demo -->
          <div class="demo-card bg-white rounded-xl border border-surface-200 p-6 hover:shadow-xl transition-all duration-300 fade-in h-full flex flex-col relative" style="animation-delay: 0.5s;">
            <div class="absolute top-4 right-4 z-10">
              <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <div class="flex items-center mb-4 pr-20">
              <div class="w-8 h-8 mr-3 bg-[#21759B] rounded flex items-center justify-center">
                <span class="text-white font-bold text-xl">W</span>
              </div>
              <h4 class="text-xl font-bold text-surface-900">{{ t('proof_demo1_title') }}</h4>
            </div>
            <p class="text-sm text-surface-600 mb-4 flex-1">{{ t('proof_demo1_desc') }}</p>
            <div class="mt-auto">
              <a 
                href="https://startups-espanolas.es" 
                target="_blank"
                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
              >
                View WordPress Blog
                <i class="pi pi-external-link ml-2 text-sm"></i>
              </a>
              <p class="text-xs text-surface-500 mt-2">{{ t('proof_demo1_update') }}</p>
            </div>
          </div>

          <!-- LinkedIn Demo -->
          <div class="demo-card bg-white rounded-xl border border-surface-200 p-6 hover:shadow-xl transition-all duration-300 fade-in h-full flex flex-col relative" style="animation-delay: 0.6s;">
            <div class="absolute top-4 right-4 z-10">
              <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <div class="flex items-center mb-4 pr-20">
              <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="#0A66C2">
                <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/>
              </svg>
              <h4 class="text-xl font-bold text-surface-900">{{ t('proof_demo2_title') }}</h4>
            </div>
            <p class="text-sm text-surface-600 mb-4 flex-1">{{ t('proof_demo2_desc') }}</p>
            <div class="mt-auto">
              <a 
                href="https://linkedin.com/company/startups-espanolas" 
                target="_blank"
                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
              >
                {{ t('proof_demo2_link') }}
                <i class="pi pi-external-link ml-2 text-sm"></i>
              </a>
            </div>
          </div>

          <!-- Instagram Demo -->
          <div class="demo-card bg-white rounded-xl border border-surface-200 p-6 hover:shadow-xl transition-all duration-300 fade-in h-full flex flex-col relative" style="animation-delay: 0.7s;">
            <div class="absolute top-4 right-4 z-10">
              <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <div class="flex items-center mb-4 pr-20">
              <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="url(#instagram-gradient)">
                <defs>
                  <linearGradient id="instagram-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#833AB4;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#E1306C;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#F77737;stop-opacity:1" />
                  </linearGradient>
                </defs>
                <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/>
              </svg>
              <h4 class="text-xl font-bold text-surface-900">{{ t('proof_demo3_title') }}</h4>
            </div>
            <p class="text-sm text-surface-600 mb-4 flex-1">{{ t('proof_demo3_desc') }}</p>
            <div class="mt-auto">
              <a 
                href="https://instagram.com/start_up_esp" 
                target="_blank"
                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
              >
                {{ t('proof_demo3_link') }}
                <i class="pi pi-external-link ml-2 text-sm"></i>
              </a>
            </div>
          </div>

          <!-- Facebook Demo -->
          <div class="demo-card bg-white rounded-xl border border-surface-200 p-6 hover:shadow-xl transition-all duration-300 fade-in h-full flex flex-col relative" style="animation-delay: 0.8s;">
            <div class="absolute top-4 right-4 z-10">
              <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <div class="flex items-center mb-4 pr-20">
              <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="#1877F2">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
              <h4 class="text-xl font-bold text-surface-900">{{ t('proof_demo4_title') }}</h4>
            </div>
            <p class="text-sm text-surface-600 mb-4 flex-1">{{ t('proof_demo4_desc') }}</p>
            <div class="mt-auto">
              <a 
                href="https://www.facebook.com/startups.espanolas" 
                target="_blank"
                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
              >
                {{ t('proof_demo4_link') }}
                <i class="pi pi-external-link ml-2 text-sm"></i>
              </a>
            </div>
          </div>

          <!-- Twitter/X Demo -->
          <div class="demo-card bg-white rounded-xl border border-surface-200 p-6 hover:shadow-xl transition-all duration-300 fade-in h-full flex flex-col relative" style="animation-delay: 0.9s;">
            <div class="absolute top-4 right-4 z-10">
              <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <div class="flex items-center mb-4 pr-20">
              <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="#000000">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
              </svg>
              <h4 class="text-xl font-bold text-surface-900">{{ t('proof_demo5_title') }}</h4>
            </div>
            <p class="text-sm text-surface-600 mb-4 flex-1">{{ t('proof_demo5_desc') }}</p>
            <div class="mt-auto">
              <a 
                href="https://x.com/StartupsEsp" 
                target="_blank"
                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
              >
                {{ t('proof_demo5_link') }}
                <i class="pi pi-external-link ml-2 text-sm"></i>
              </a>
            </div>
          </div>
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

/* Line clamp utility for consistent text height */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Ensure all demo cards have equal height */
.demo-card {
  min-height: 220px;
}

/* Featured demo responsive adjustments */
@media (max-width: 640px) {
  .featured-demo {
    padding: 1.5rem;
  }
  
  .featured-demo h3 {
    font-size: 1.5rem;
  }
  
  .featured-demo .text-lg {
    font-size: 1rem;
  }
}

/* Stats grid responsive adjustments */
@media (max-width: 640px) {
  .grid.grid-cols-2 > div {
    padding: 0.75rem;
  }
  
  .grid.grid-cols-2 h3 {
    font-size: 2rem;
  }
}
</style>