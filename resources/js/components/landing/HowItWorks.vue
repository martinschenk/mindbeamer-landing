<template>
  <section id="how-it-works" class="py-20 bg-gradient-to-br from-blue-50 to-purple-50 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(59, 130, 246, 0.1) 35px, rgba(59, 130, 246, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900 mb-4">
          {{ t('how_it_works_title') }}
        </h2>
        <p class="text-xl text-surface-600">
          {{ t('how_it_works_subtitle') }}
        </p>
      </div>
      
      <!-- 3 Steps -->
      <div class="max-w-5xl mx-auto space-y-12">
        <!-- Step 1 -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 fade-in" style="animation-delay: 0.1s;">
          <div class="flex items-start">
            <span class="text-4xl md:text-5xl mr-6 flex-shrink-0">{{ t('step1_emoji') }}</span>
            <div class="flex-1">
              <h3 class="text-2xl md:text-3xl font-bold text-surface-900 mb-6">{{ t('step1_title') }}</h3>
              <ul class="space-y-3">
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step1_point1') }}</p>
                </li>
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step1_point2') }}</p>
                </li>
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step1_point3') }}</p>
                </li>
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step1_point4') }}</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Step 2 -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 fade-in" style="animation-delay: 0.2s;">
          <div class="flex items-start">
            <span class="text-4xl md:text-5xl mr-6 flex-shrink-0">{{ t('step2_emoji') }}</span>
            <div class="flex-1">
              <h3 class="text-2xl md:text-3xl font-bold text-surface-900 mb-6">{{ t('step2_title') }}</h3>
              <ul class="space-y-3">
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step2_point1') }}</p>
                </li>
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step2_point2') }}</p>
                </li>
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step2_point3') }}</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Step 3 -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-xl p-8 md:p-12 fade-in" style="animation-delay: 0.3s;">
          <div class="flex items-start">
            <span class="text-4xl md:text-5xl mr-6 flex-shrink-0">{{ t('step3_emoji') }}</span>
            <div class="flex-1">
              <h3 class="text-2xl md:text-3xl font-bold text-surface-900 mb-6">{{ t('step3_title') }}</h3>
              <ul class="space-y-3">
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step3_point1') }}</p>
                </li>
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step3_point2') }}</p>
                </li>
                <li class="flex items-start">
                  <span class="text-green-500 mr-3 mt-1">•</span>
                  <p class="text-lg text-surface-700">{{ t('step3_point3') }}</p>
                </li>
              </ul>
              <p class="text-base text-surface-600 italic mt-6">{{ t('step3_note') }}</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- CTA -->
      <div class="text-center mt-16 fade-in" style="animation-delay: 0.4s;">
        <Button 
          :label="t('how_it_works_cta')"
          severity="warning"
          size="large"
          @click="scrollToDemo"
          class="text-xl px-10 py-5 font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all"
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

// Mobile adjustments
@media (max-width: 768px) {
  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }
  
  ul li {
    font-size: 1rem;
  }
}
</style>