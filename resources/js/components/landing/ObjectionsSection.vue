<template>
  <section id="objections" class="py-20 bg-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(99, 102, 241, 0.1) 35px, rgba(99, 102, 241, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900 mb-4">
          {{ t('objections_headline') }}
        </h2>
        <p class="text-xl text-surface-600">
          {{ t('objections_subheadline') }}
        </p>
      </div>
      
      <!-- Objections Q&A -->
      <div class="max-w-4xl mx-auto space-y-8">
        <!-- Objection 1 -->
        <div class="bg-gray-50 rounded-2xl shadow-md p-6 md:p-8 fade-in" style="animation-delay: 0.1s;">
          <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-4">
            {{ t('objection1_q') }}
          </h3>
          <p class="text-lg text-surface-700 leading-relaxed">
            {{ t('objection1_a') }}
          </p>
        </div>
        
        <!-- Objection 2 -->
        <div class="bg-blue-50 rounded-2xl shadow-md p-6 md:p-8 fade-in" style="animation-delay: 0.2s;">
          <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-4">
            {{ t('objection2_q') }}
          </h3>
          <p class="text-lg text-surface-700 leading-relaxed">
            {{ t('objection2_a') }}
          </p>
        </div>
        
        <!-- Objection 3 -->
        <div class="bg-purple-50 rounded-2xl shadow-md p-6 md:p-8 fade-in" style="animation-delay: 0.3s;">
          <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-4">
            {{ t('objection3_q') }}
          </h3>
          <p class="text-lg text-surface-700 leading-relaxed">
            {{ t('objection3_a') }}
          </p>
        </div>
        
        <!-- Objection 4 -->
        <div class="bg-green-50 rounded-2xl shadow-md p-6 md:p-8 fade-in" style="animation-delay: 0.4s;">
          <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-4">
            {{ t('objection4_q') }}
          </h3>
          <p class="text-lg text-surface-700 leading-relaxed">
            {{ t('objection4_a') }}
          </p>
        </div>
        
        <!-- Objection 5 -->
        <div class="bg-orange-50 rounded-2xl shadow-md p-6 md:p-8 fade-in" style="animation-delay: 0.5s;">
          <h3 class="text-xl md:text-2xl font-bold text-surface-900 mb-4">
            {{ t('objection5_q') }}
          </h3>
          <p class="text-lg text-surface-700 leading-relaxed">
            {{ t('objection5_a') }}
          </p>
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

// Mobile adjustments
@media (max-width: 768px) {
  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }
  
  h3 {
    font-size: 1.25rem;
  }
}
</style>