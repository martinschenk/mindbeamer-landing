<template>
  <section id="features" class="py-20 bg-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0 bg-repeat" :style="{ backgroundImage: patternBackground, backgroundSize: '60px 60px' }"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
          {{ t('features_title') }}
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          {{ t('features_subtitle') }}
        </p>
      </div>
      
      <!-- Features Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <!-- Feature 1 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 fade-in group" style="animation-delay: 0.1s;">
          <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <i class="pi pi-sparkles text-3xl text-indigo-600"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ t('feature1_title') }}</h3>
          <p class="text-gray-600 mb-4">{{ t('feature1_description') }}</p>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature1_benefit1') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature1_benefit2') }}</span>
            </li>
          </ul>
        </div>
        
        <!-- Feature 2 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 fade-in group" style="animation-delay: 0.2s;">
          <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <i class="pi pi-calendar text-3xl text-green-600"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ t('feature2_title') }}</h3>
          <p class="text-gray-600 mb-4">{{ t('feature2_description') }}</p>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature2_benefit1') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature2_benefit2') }}</span>
            </li>
          </ul>
        </div>
        
        <!-- Feature 3 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 fade-in group" style="animation-delay: 0.3s;">
          <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <i class="pi pi-share-alt text-3xl text-purple-600"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ t('feature3_title') }}</h3>
          <p class="text-gray-600 mb-4">{{ t('feature3_description') }}</p>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature3_benefit1') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature3_benefit2') }}</span>
            </li>
          </ul>
        </div>
        
        <!-- Feature 4 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 fade-in group" style="animation-delay: 0.4s;">
          <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <i class="pi pi-chart-bar text-3xl text-orange-600"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ t('feature4_title') }}</h3>
          <p class="text-gray-600 mb-4">{{ t('feature4_description') }}</p>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature4_benefit1') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature4_benefit2') }}</span>
            </li>
          </ul>
        </div>
        
        <!-- Feature 5 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 fade-in group" style="animation-delay: 0.5s;">
          <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <i class="pi pi-shield text-3xl text-red-600"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ t('feature5_title') }}</h3>
          <p class="text-gray-600 mb-4">{{ t('feature5_description') }}</p>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature5_benefit1') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature5_benefit2') }}</span>
            </li>
          </ul>
        </div>
        
        <!-- Feature 6 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 fade-in group" style="animation-delay: 0.6s;">
          <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <i class="pi pi-bolt text-3xl text-blue-600"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ t('feature6_title') }}</h3>
          <p class="text-gray-600 mb-4">{{ t('feature6_description') }}</p>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature6_benefit1') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check text-green-500 mt-0.5 mr-2"></i>
              <span class="text-sm text-gray-700">{{ t('feature6_benefit2') }}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';
import { useLocaleStore } from '@/stores/locale';

const { t } = useLocaleStore();

// Pattern background as computed property
const patternBackground = computed(() => {
  return `url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")`;
});
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