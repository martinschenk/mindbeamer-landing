<template>
  <section id="social-proof" class="py-20 bg-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(59, 130, 246, 0.1) 35px, rgba(59, 130, 246, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900 mb-8">
          {{ t('proof_headline') }}
        </h2>
        
        <!-- Startups Españolas Logo and Introduction -->
        <div class="max-w-4xl mx-auto mb-12">
          <img 
            src="https://startups-espanolas.es/wp-content/uploads/startups-espanolas-logo-2024-01-12-v1.png"
            alt="Startups Españolas"
            class="h-20 mx-auto mb-6"
          />
          <p class="text-xl text-surface-700 mb-4">
            {{ t('proof_intro') }}
          </p>
          
          <!-- What is Startups Españolas Box -->
          <div class="bg-blue-50 rounded-2xl p-6 mb-6">
            <h3 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_what_is_title') }}</h3>
            <p class="text-lg text-surface-700">
              {{ t('proof_what_is_desc') }}
            </p>
          </div>
          
          <p class="text-lg font-semibold text-primary-600">
            {{ t('proof_running_time') }}
          </p>
        </div>
      </div>
      
      <!-- How MindBeamer Works Section -->
      <div class="bg-gray-50 rounded-2xl p-8 max-w-4xl mx-auto mb-12 fade-in" style="animation-delay: 0.1s;">
        <h3 class="text-2xl font-bold text-surface-900 mb-6">{{ t('proof_how_title') }}</h3>
        <div class="space-y-3 text-left">
          <p class="text-surface-700">{{ t('proof_how_wordpress') }}</p>
          <p class="text-surface-700">{{ t('proof_how_linkedin') }}</p>
          <p class="text-surface-700">{{ t('proof_how_instagram') }}</p>
          <p class="text-surface-700">{{ t('proof_how_twitter') }}</p>
          <p class="text-surface-700">{{ t('proof_how_facebook') }}</p>
        </div>
      </div>
      
      <!-- Real Numbers Section -->
      <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 max-w-4xl mx-auto mb-12 fade-in" style="animation-delay: 0.15s;">
        <h3 class="text-2xl font-bold text-surface-900 mb-6">{{ t('proof_results_title') }}</h3>
        <div class="space-y-4">
          <div class="flex items-center">
            <span class="text-3xl mr-4">📊</span>
            <p class="text-lg md:text-xl text-surface-700 font-semibold">{{ t('proof_stat1') }}</p>
          </div>
          <div class="flex items-center">
            <span class="text-3xl mr-4">🐦</span>
            <p class="text-lg md:text-xl text-surface-700 font-semibold">{{ t('proof_stat2') }}</p>
          </div>
          <div class="flex items-center">
            <span class="text-3xl mr-4">💼</span>
            <p class="text-lg md:text-xl text-surface-700 font-semibold">{{ t('proof_stat3') }}</p>
          </div>
          <div class="flex items-center">
            <span class="text-3xl mr-4">🔍</span>
            <p class="text-lg md:text-xl text-surface-700 font-semibold">{{ t('proof_stat4') }}</p>
          </div>
        </div>
      </div>
      
      <!-- All 5 Platforms Section -->
      <div class="max-w-6xl mx-auto mb-16">
        <h3 class="text-2xl md:text-3xl font-bold text-surface-900 mb-4 text-center fade-in" style="animation-delay: 0.2s;">
          {{ t('proof_platforms_headline') }}
        </h3>
        <p class="text-lg text-surface-600 mb-4 text-center fade-in" style="animation-delay: 0.25s;">
          {{ t('proof_platforms_subheadline') }}
        </p>
        <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4 mb-8 max-w-4xl mx-auto fade-in" style="animation-delay: 0.27s;">
          <p class="text-surface-700 font-medium">
            {{ t('proof_important_note') }}
          </p>
        </div>
        
        <!-- 5 Platform Grid: 3 top, 2 bottom on desktop -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
          <!-- Blog Platform -->
          <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 fade-in relative" style="animation-delay: 0.3s;">
            <div class="absolute top-4 right-4">
              <span class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <h4 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_blog_title') }}</h4>
            <p class="text-surface-700 mb-4">{{ t('proof_blog_desc') }}</p>
            <p class="text-sm text-surface-500 mb-4">{{ t('proof_blog_update') }}</p>
            <a 
              :href="t('proof_blog_url')"
              target="_blank"
              class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
            >
              {{ t('proof_blog_link') }}
              <i class="pi pi-external-link ml-2 text-sm"></i>
            </a>
          </div>
          
          <!-- LinkedIn Platform -->
          <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 fade-in relative" style="animation-delay: 0.35s;">
            <div class="absolute top-4 right-4">
              <span class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <h4 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_linkedin_title') }}</h4>
            <p class="text-surface-700 mb-4">{{ t('proof_linkedin_desc') }}</p>
            <a 
              :href="t('proof_linkedin_url')"
              target="_blank"
              class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
            >
              {{ t('proof_linkedin_link') }}
              <i class="pi pi-external-link ml-2 text-sm"></i>
            </a>
          </div>
          
          <!-- Instagram Platform -->
          <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 fade-in relative" style="animation-delay: 0.4s;">
            <div class="absolute top-4 right-4">
              <span class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <h4 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_instagram_title') }}</h4>
            <p class="text-surface-700 mb-4">{{ t('proof_instagram_desc') }}</p>
            <a 
              :href="t('proof_instagram_url')"
              target="_blank"
              class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
            >
              {{ t('proof_instagram_link') }}
              <i class="pi pi-external-link ml-2 text-sm"></i>
            </a>
          </div>
          
          <!-- Facebook Platform -->
          <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 fade-in relative" style="animation-delay: 0.45s;">
            <div class="absolute top-4 right-4">
              <span class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <h4 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_facebook_title') }}</h4>
            <p class="text-surface-700 mb-4">{{ t('proof_facebook_desc') }}</p>
            <a 
              :href="t('proof_facebook_url')"
              target="_blank"
              class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
            >
              {{ t('proof_facebook_link') }}
              <i class="pi pi-external-link ml-2 text-sm"></i>
            </a>
          </div>
          
          <!-- Twitter Platform -->
          <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 fade-in relative" style="animation-delay: 0.5s;">
            <div class="absolute top-4 right-4">
              <span class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-600 font-bold text-xs rounded-full animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                {{ t('proof_live_indicator') }}
              </span>
            </div>
            <h4 class="text-xl font-bold text-surface-900 mb-3">{{ t('proof_twitter_title') }}</h4>
            <p class="text-surface-700 mb-4">{{ t('proof_twitter_desc') }}</p>
            <a 
              :href="t('proof_twitter_url')"
              target="_blank"
              class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold"
            >
              {{ t('proof_twitter_link') }}
              <i class="pi pi-external-link ml-2 text-sm"></i>
            </a>
          </div>
        </div>
      </div>
      
      <!-- The Kicker -->
      <div class="bg-yellow-50 border-2 border-yellow-300 rounded-2xl p-8 max-w-4xl mx-auto mb-12 fade-in" style="animation-delay: 0.6s;">
        <p class="text-xl font-bold text-surface-900 mb-3 text-center">{{ t('proof_kicker') }}</p>
        <p class="text-lg text-surface-700 mb-6 text-center">{{ t('proof_result') }}</p>
        <p class="text-xl font-bold text-primary-600 text-center">{{ t('proof_question') }}</p>
      </div>
      
      <!-- CTA -->
      <div class="text-center fade-in" style="animation-delay: 0.7s;">
        <Button 
          :label="t('proof_cta')"
          severity="success"
          size="large"
          class="text-xl px-10 py-5 font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all"
          @click="scrollToDemo"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { useLocaleStore } from '@/stores/locale';
import Button from 'primevue/button';

const { t } = useLocaleStore();

function scrollToDemo() {
  const element = document.querySelector('#demo');
  if (element) {
    window.location.hash = 'demo';
  }
}
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