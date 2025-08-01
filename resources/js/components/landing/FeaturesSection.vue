<template>
  <section id="features" class="py-20 bg-gradient-to-br from-white to-gray-50 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(99, 102, 241, 0.1) 35px, rgba(99, 102, 241, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900">
          {{ t('features_title') }}
        </h2>
      </div>
      
      <!-- Business Types Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
        <!-- Business Type 1: Consultants & Advisors -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 hover:shadow-2xl transition-all duration-300 fade-in" style="animation-delay: 0.1s;">
          <div class="flex items-start mb-6">
            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0">
              <i class="pi pi-briefcase text-3xl text-blue-600"></i>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('business_type1_title') }}</h3>
              <p class="text-lg font-semibold text-surface-700">{{ t('business_type1_hook') }}</p>
            </div>
          </div>
          
          <ul class="space-y-3 mb-6">
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type1_point1') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type1_point2') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type1_point3') }}</p>
            </li>
          </ul>
          
          <div class="bg-blue-50 rounded-lg p-4">
            <p class="text-sm text-surface-600 italic">{{ t('business_type1_example') }}</p>
          </div>
        </div>
        
        <!-- Business Type 2: Online Retailers & E-commerce -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 hover:shadow-2xl transition-all duration-300 fade-in" style="animation-delay: 0.2s;">
          <div class="flex items-start mb-6">
            <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0">
              <i class="pi pi-shopping-cart text-3xl text-purple-600"></i>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('business_type2_title') }}</h3>
              <p class="text-lg font-semibold text-surface-700">{{ t('business_type2_hook') }}</p>
            </div>
          </div>
          
          <ul class="space-y-3 mb-6">
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type2_point1') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type2_point2') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type2_point3') }}</p>
            </li>
          </ul>
          
          <div class="bg-purple-50 rounded-lg p-4">
            <p class="text-sm text-surface-600 italic">{{ t('business_type2_example') }}</p>
          </div>
        </div>
        
        <!-- Business Type 3: Manufacturers & Product Creators -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 hover:shadow-2xl transition-all duration-300 fade-in" style="animation-delay: 0.3s;">
          <div class="flex items-start mb-6">
            <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0">
              <i class="pi pi-building text-3xl text-orange-600"></i>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('business_type3_title') }}</h3>
              <p class="text-lg font-semibold text-surface-700">{{ t('business_type3_hook') }}</p>
            </div>
          </div>
          
          <ul class="space-y-3 mb-6">
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type3_point1') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type3_point2') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type3_point3') }}</p>
            </li>
          </ul>
          
          <div class="bg-orange-50 rounded-lg p-4">
            <p class="text-sm text-surface-600 italic">{{ t('business_type3_example') }}</p>
          </div>
        </div>
        
        <!-- Business Type 4: Local Service Providers -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 hover:shadow-2xl transition-all duration-300 fade-in" style="animation-delay: 0.4s;">
          <div class="flex items-start mb-6">
            <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0">
              <i class="pi pi-map-marker text-3xl text-green-600"></i>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('business_type4_title') }}</h3>
              <p class="text-lg font-semibold text-surface-700">{{ t('business_type4_hook') }}</p>
            </div>
          </div>
          
          <ul class="space-y-3 mb-6">
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type4_point1') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type4_point2') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 mt-1">•</span>
              <p class="text-surface-700">{{ t('business_type4_point3') }}</p>
            </li>
          </ul>
          
          <div class="bg-green-50 rounded-lg p-4">
            <p class="text-sm text-surface-600 italic">{{ t('business_type4_example') }}</p>
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

// Mobile adjustments
@media (max-width: 768px) {
  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }
  
  .bg-white {
    padding: 1.5rem;
  }
}
</style>