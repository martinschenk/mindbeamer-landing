<template>
  <section id="problem" class="py-20 bg-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(99, 102, 241, 0.1) 35px, rgba(99, 102, 241, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
          {{ t('problem_headline') }}
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          {{ t('problem_subheadline') }}
        </p>
      </div>
      
      <!-- Pain Points Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <!-- Pain Point 1 -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.1s;">
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="pi pi-clock text-2xl text-red-600"></i>
              </div>
            </div>
            <div>
              <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ t('problem_time_title') }}</h3>
              <p class="text-gray-600">{{ t('problem_time_desc') }}</p>
              <p class="text-red-600 font-bold mt-2">{{ t('problem_time_cost') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 2 -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.2s;">
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="pi pi-chart-line text-2xl text-orange-600"></i>
              </div>
            </div>
            <div>
              <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ t('problem_consistency_title') }}</h3>
              <p class="text-gray-600">{{ t('problem_consistency_desc') }}</p>
              <p class="text-orange-600 font-bold mt-2">{{ t('problem_consistency_cost') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 3 -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.3s;">
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="pi pi-exclamation-triangle text-2xl text-yellow-600"></i>
              </div>
            </div>
            <div>
              <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ t('problem_ideas_title') }}</h3>
              <p class="text-gray-600">{{ t('problem_ideas_desc') }}</p>
              <p class="text-yellow-600 font-bold mt-2">{{ t('problem_ideas_cost') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 4 -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.4s;">
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="pi pi-dollar text-2xl text-purple-600"></i>
              </div>
            </div>
            <div>
              <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ t('problem_roi_title') }}</h3>
              <p class="text-gray-600">{{ t('problem_roi_desc') }}</p>
              <p class="text-purple-600 font-bold mt-2">{{ t('problem_roi_cost') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 5 -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.5s;">
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="pi pi-eye text-2xl text-green-600"></i>
              </div>
            </div>
            <div>
              <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ t('problem_competition_title') }}</h3>
              <p class="text-gray-600">{{ t('problem_competition_desc') }}</p>
              <p class="text-green-600 font-bold mt-2">{{ t('problem_competition_cost') }}</p>
            </div>
          </div>
        </div>
        
        <!-- Pain Point 6 -->
        <div class="diamond-card group hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.6s;">
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="pi pi-users text-2xl text-blue-600"></i>
              </div>
            </div>
            <div>
              <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ t('problem_expertise_title') }}</h3>
              <p class="text-gray-600">{{ t('problem_expertise_desc') }}</p>
              <p class="text-blue-600 font-bold mt-2">{{ t('problem_expertise_cost') }}</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- CTA -->
      <div class="text-center mt-16 fade-in" style="animation-delay: 0.7s;">
        <p class="text-xl text-gray-700 mb-6">{{ t('problem_cta_text') }}</p>
        <Button 
          :label="t('problem_cta_button')"
          severity="primary"
          size="large"
          @click="scrollToSolution"
          icon="pi pi-arrow-down"
          iconPos="right"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { useLocaleStore } from '@/stores/locale';
import Button from 'primevue/button';

const { t } = useLocaleStore();

function scrollToSolution() {
  const element = document.querySelector('#how-it-works');
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