<template>
  <section id="problem" class="py-20 bg-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(59, 130, 246, 0.1) 35px, rgba(59, 130, 246, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900">
          {{ t('problem_headline') }}
        </h2>
      </div>
      
      <!-- Pain Points -->
      <div class="max-w-4xl mx-auto space-y-8">
        <!-- Pain Point 1 -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.1s;">
          <div class="flex items-start">
            <span class="text-4xl md:text-5xl mr-6">{{ t('problem_pain1_emoji') }}</span>
            <div class="flex-1">
              <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-3">{{ t('problem_pain1_title') }}</h3>
              <p class="text-lg text-surface-700 leading-relaxed">{{ t('problem_pain1_desc') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 2 -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.2s;">
          <div class="flex items-start">
            <span class="text-4xl md:text-5xl mr-6">{{ t('problem_pain2_emoji') }}</span>
            <div class="flex-1">
              <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-3">{{ t('problem_pain2_title') }}</h3>
              <p class="text-lg text-surface-700 leading-relaxed">{{ t('problem_pain2_desc') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 3 -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.3s;">
          <div class="flex items-start">
            <span class="text-4xl md:text-5xl mr-6">{{ t('problem_pain3_emoji') }}</span>
            <div class="flex-1">
              <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-3">{{ t('problem_pain3_title') }}</h3>
              <p class="text-lg text-surface-700 leading-relaxed">{{ t('problem_pain3_desc') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 4 -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.4s;">
          <div class="flex items-start">
            <span class="text-4xl md:text-5xl mr-6">{{ t('problem_pain4_emoji') }}</span>
            <div class="flex-1">
              <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-3">{{ t('problem_pain4_title') }}</h3>
              <p class="text-lg text-surface-700 leading-relaxed">{{ t('problem_pain4_desc') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 5 -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.5s;">
          <div class="flex items-start">
            <span class="text-4xl md:text-5xl mr-6">{{ t('problem_pain5_emoji') }}</span>
            <div class="flex-1">
              <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-3">{{ t('problem_pain5_title') }}</h3>
              <p class="text-lg text-surface-700 leading-relaxed">{{ t('problem_pain5_desc') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 6 -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.6s;">
          <div class="flex items-start">
            <span class="text-4xl md:text-5xl mr-6">{{ t('problem_pain6_emoji') }}</span>
            <div class="flex-1">
              <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-3">{{ t('problem_pain6_title') }}</h3>
              <p class="text-lg text-surface-700 leading-relaxed">{{ t('problem_pain6_desc') }}</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Empathy Hook -->
      <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-8 md:p-12 mt-16 max-w-4xl mx-auto fade-in" style="animation-delay: 0.7s;">
        <p class="text-2xl md:text-3xl font-bold text-primary-600 text-center">
          {{ t('problem_empathy') }}
        </p>
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