<template>
  <section class="relative overflow-hidden bg-gradient-to-br from-primary-50 via-white to-primary-50 pt-20 pb-32">
    <!-- Diamond Theme Animated Background -->
    <div class="hero-bg-animation">
      <div class="hero-bg-shape-1"></div>
      <div class="hero-bg-shape-2"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <!-- Left Column - Text Content -->
        <div class="text-center lg:text-left fade-in">
          <!-- Trust Badge -->
          <div class="inline-flex items-center bg-white/80 backdrop-blur-sm rounded-full px-4 py-2 shadow-md mb-6">
            <span class="text-2xl mr-2">🇩🇪</span>
            <span class="text-sm font-medium text-surface-700">{{ t('hero_badge') }}</span>
          </div>
          
          <!-- Main Headline -->
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-surface-900 mb-6 leading-tight">
            {{ t('hero_title_line1') }}<br>
            <span class="text-gradient">{{ t('hero_title_line2') }}</span>
          </h1>
          
          <!-- Subheadline -->
          <p class="text-xl text-surface-600 mb-8 leading-relaxed">
            {{ t('hero_subtitle') }}
          </p>
          
          <!-- Trust Indicators -->
          <div class="flex flex-wrap gap-4 items-center justify-center lg:justify-start mb-8">
            <div class="flex items-center">
              <i class="pi pi-check-circle text-green-500 mr-2"></i>
              <span class="text-surface-700">{{ t('hero_feature1') }}</span>
            </div>
            <div class="flex items-center">
              <i class="pi pi-check-circle text-green-500 mr-2"></i>
              <span class="text-surface-700">{{ t('hero_feature2') }}</span>
            </div>
            <div class="flex items-center">
              <i class="pi pi-check-circle text-green-500 mr-2"></i>
              <span class="text-surface-700">{{ t('hero_feature3') }}</span>
            </div>
          </div>
          
          <!-- CTA Buttons -->
          <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
            <Button 
              :label="t('hero_cta_primary')"
              severity="warning"
              size="large"
              icon="pi pi-rocket"
              iconPos="right"
              class="animate-wiggle font-semibold shadow-lg"
              @click="scrollToContact"
            />
            <Button 
              :label="t('hero_cta_secondary')"
              outlined
              size="large"
              icon="pi pi-play"
              iconPos="left"
              @click="playDemo"
            />
          </div>
          
          <!-- Credibility -->
          <div class="mt-8 flex items-center justify-center lg:justify-start space-x-4 text-sm text-surface-600">
            <img 
              src="/images/palimpalem-logo.svg" 
              alt="palimpalem.com" 
              class="h-8 opacity-70"
            >
            <span>{{ t('hero_credibility') }}</span>
          </div>
        </div>
        
        <!-- Right Column - Product Visual -->
        <div class="relative fade-in-delayed">
          <div class="relative">
            <!-- Product Screenshot -->
            <img 
              src="/images/mindbeamer-dashboard.png" 
              alt="MindBeamer Dashboard"
              class="w-full h-auto rounded-2xl shadow-2xl animate-float"
            >
            
            <!-- Floating Elements -->
            <div class="absolute -top-4 -right-4 bg-white rounded-lg shadow-lg p-3 animate-float" style="animation-delay: 0.5s;">
              <div class="flex items-center space-x-2">
                <i class="pi pi-chart-line text-green-500 text-xl"></i>
                <div>
                  <p class="text-xs text-surface-600">{{ t('hero_stat_label') }}</p>
                  <p class="text-lg font-bold text-surface-900">+287%</p>
                </div>
              </div>
            </div>
            
            <div class="absolute -bottom-4 -left-4 bg-white rounded-lg shadow-lg p-3 animate-float" style="animation-delay: 1s;">
              <div class="flex items-center space-x-2">
                <i class="pi pi-clock text-indigo-500 text-xl"></i>
                <div>
                  <p class="text-xs text-gray-600">{{ t('hero_time_saved') }}</p>
                  <p class="text-lg font-bold text-gray-900">20h/{{ t('week') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useLocaleStore } from '@/stores/locale';
import Button from 'primevue/button';

const { t } = useLocaleStore();

function scrollToContact() {
  const element = document.querySelector('#contact');
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
}

function playDemo() {
  // TODO: Implement demo video modal
  console.log('Play demo video');
}
</script>

<style scoped lang="scss">
// Fade in animations
.fade-in {
  animation: fadeInUp 0.8s ease-out;
}

.fade-in-delayed {
  animation: fadeInUp 0.8s ease-out 0.3s both;
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