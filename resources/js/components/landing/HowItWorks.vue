<template>
  <section id="how-it-works" class="py-20 bg-gradient-to-br from-indigo-50 to-white relative overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute -top-40 -right-40 w-80 h-80 bg-indigo-200 rounded-full opacity-20 animate-float"></div>
      <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-indigo-300 rounded-full opacity-20 animate-float" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
          {{ t('how_it_works_title') }}
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          {{ t('how_it_works_subtitle') }}
        </p>
      </div>
      
      <!-- Steps Timeline -->
      <div class="max-w-5xl mx-auto">
        <!-- Step 1 -->
        <div class="flex flex-col md:flex-row items-center mb-16 fade-in" style="animation-delay: 0.1s;">
          <div class="flex-1 md:pr-8 mb-8 md:mb-0">
            <div class="bg-white rounded-2xl shadow-lg p-8 diamond-card">
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                  <span class="text-2xl font-bold text-indigo-600">1</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ t('step1_title') }}</h3>
              </div>
              <p class="text-gray-600 mb-4">{{ t('step1_description') }}</p>
              <div class="bg-indigo-50 rounded-lg p-4">
                <p class="text-sm text-indigo-700 font-medium">
                  <i class="pi pi-clock mr-2"></i>{{ t('step1_time') }}
                </p>
              </div>
            </div>
          </div>
          <div class="flex-1 md:pl-8">
            <div class="bg-gradient-to-br from-indigo-50 to-white rounded-2xl p-8 flex items-center justify-center h-64">
              <i class="pi pi-upload text-8xl text-indigo-400"></i>
            </div>
          </div>
        </div>
        
        <!-- Step 2 -->
        <div class="flex flex-col md:flex-row-reverse items-center mb-16 fade-in" style="animation-delay: 0.2s;">
          <div class="flex-1 md:pl-8 mb-8 md:mb-0">
            <div class="bg-white rounded-2xl shadow-lg p-8 diamond-card">
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                  <span class="text-2xl font-bold text-green-600">2</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ t('step2_title') }}</h3>
              </div>
              <p class="text-gray-600 mb-4">{{ t('step2_description') }}</p>
              
              <!-- Platforms List -->
              <div class="mb-4">
                <h4 class="font-semibold text-gray-900 mb-2">Every Platform Gets Perfect Content:</h4>
                <ul class="space-y-1 text-sm text-gray-600">
                  <li><span class="mr-2">📊</span><strong>Blog:</strong> SEO-optimized articles</li>
                  <li><span class="mr-2">📱</span><strong>LinkedIn:</strong> Professional B2B insights</li>
                  <li><span class="mr-2">📸</span><strong>Instagram:</strong> Visual stories & carousels</li>
                  <li><span class="mr-2">📘</span><strong>Facebook:</strong> Community-building posts</li>
                  <li><span class="mr-2">🐦</span><strong>Twitter/X:</strong> Quick insights & updates</li>
                </ul>
              </div>
              
              <div class="bg-green-50 rounded-lg p-4">
                <p class="text-sm text-green-700 font-medium">
                  <i class="pi pi-sparkles mr-2"></i>{{ t('step2_feature') }}
                </p>
              </div>
            </div>
          </div>
          <div class="flex-1 md:pr-8">
            <div class="bg-gradient-to-br from-green-50 to-white rounded-2xl p-8 flex items-center justify-center h-64">
              <i class="pi pi-sparkles text-8xl text-green-400"></i>
            </div>
          </div>
        </div>
        
        <!-- Step 3 -->
        <div class="flex flex-col md:flex-row items-center mb-16 fade-in" style="animation-delay: 0.3s;">
          <div class="flex-1 md:pr-8 mb-8 md:mb-0">
            <div class="bg-white rounded-2xl shadow-lg p-8 diamond-card">
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                  <span class="text-2xl font-bold text-purple-600">3</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ t('step3_title') }}</h3>
              </div>
              <p class="text-gray-600 mb-4">{{ t('step3_description') }}</p>
              <div class="bg-purple-50 rounded-lg p-4">
                <p class="text-sm text-purple-700 font-medium">
                  <i class="pi pi-shield mr-2"></i>{{ t('step3_control') }}
                </p>
              </div>
            </div>
          </div>
          <div class="flex-1 md:pl-8">
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl p-8 flex items-center justify-center h-64">
              <i class="pi pi-sliders-h text-8xl text-purple-400"></i>
            </div>
          </div>
        </div>
        
        <!-- Step 4 -->
        <div class="flex flex-col md:flex-row-reverse items-center fade-in" style="animation-delay: 0.4s;">
          <div class="flex-1 md:pl-8 mb-8 md:mb-0">
            <div class="bg-white rounded-2xl shadow-lg p-8 diamond-card">
              <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mr-4">
                  <span class="text-2xl font-bold text-orange-600">4</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ t('step4_title') }}</h3>
              </div>
              <p class="text-gray-600 mb-4">{{ t('step4_description') }}</p>
              <div class="bg-orange-50 rounded-lg p-4">
                <p class="text-sm text-orange-700 font-medium">
                  <i class="pi pi-chart-line mr-2"></i>{{ t('step4_result') }}
                </p>
              </div>
            </div>
          </div>
          <div class="flex-1 md:pr-8">
            <div class="bg-gradient-to-br from-orange-50 to-white rounded-2xl p-8 flex items-center justify-center h-64">
              <i class="pi pi-chart-line text-8xl text-orange-400"></i>
            </div>
          </div>
        </div>
      </div>
      
      <!-- CTA -->
      <div class="text-center mt-16 fade-in" style="animation-delay: 0.5s;">
        <Button 
          :label="t('how_it_works_cta')"
          severity="warning"
          size="large"
          @click="scrollToDemo"
          icon="pi pi-arrow-right"
          iconPos="right"
          class="animate-wiggle"
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
    element.scrollIntoView({ behavior: 'smooth' });
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
</style>