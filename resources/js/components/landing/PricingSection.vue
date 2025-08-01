<template>
  <section id="pricing" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(59, 130, 246, 0.1) 35px, rgba(59, 130, 246, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900 mb-4">
          {{ t('pricing_headline') }}
        </h2>
      </div>
      
      <!-- Pricing Cards -->
      <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
          <!-- Starter Plan -->
          <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.1s;">
            <div class="mb-6">
              <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('pricing_starter_name') }}</h3>
              <p class="text-surface-600">{{ t('pricing_starter_desc') }}</p>
            </div>
            
            <div class="mb-8">
              <div class="flex items-baseline">
                <span class="text-5xl font-bold text-surface-900">${{ t('pricing_starter_price') }}</span>
                <span class="text-surface-600 ml-2">/{{ t('pricing_per_month') }}</span>
              </div>
            </div>
            
            <ul class="space-y-3 mb-8">
              <li class="flex items-start">
                <i class="pi pi-check text-green-500 text-xl mt-0.5 mr-3"></i>
                <span class="text-surface-700">{{ t('pricing_starter_feature1') }}</span>
              </li>
              <li class="flex items-start">
                <i class="pi pi-check text-green-500 text-xl mt-0.5 mr-3"></i>
                <span class="text-surface-700">{{ t('pricing_starter_feature2') }}</span>
              </li>
              <li class="flex items-start">
                <i class="pi pi-check text-green-500 text-xl mt-0.5 mr-3"></i>
                <span class="text-surface-700">{{ t('pricing_starter_feature3') }}</span>
              </li>
            </ul>
            
            <Button 
              :label="t('pricing_cta_start')"
              severity="secondary"
              class="w-full"
              size="large"
              @click="scrollToDemo"
            />
          </div>
          
          <!-- Growth Plan (Most Popular) -->
          <div class="bg-primary-600 text-white rounded-2xl shadow-xl p-8 transform scale-105 hover:scale-110 transition-all duration-300 fade-in" style="animation-delay: 0.2s;">
            <div class="text-center mb-4">
              <span class="bg-yellow-400 text-surface-900 px-4 py-2 rounded-full text-sm font-bold">
                {{ t('pricing_most_popular') }}
              </span>
            </div>
            
            <div class="mb-6">
              <h3 class="text-2xl font-bold mb-2">{{ t('pricing_pro_name') }}</h3>
              <p class="text-primary-100">{{ t('pricing_pro_desc') }}</p>
            </div>
            
            <div class="mb-8">
              <div class="flex items-baseline">
                <span class="text-5xl font-bold">${{ t('pricing_pro_price') }}</span>
                <span class="text-primary-100 ml-2">/{{ t('pricing_per_month') }}</span>
              </div>
            </div>
            
            <ul class="space-y-3 mb-8">
              <li class="flex items-start">
                <i class="pi pi-check text-white text-xl mt-0.5 mr-3"></i>
                <span>{{ t('pricing_pro_feature1') }}</span>
              </li>
              <li class="flex items-start">
                <i class="pi pi-check text-white text-xl mt-0.5 mr-3"></i>
                <span>{{ t('pricing_pro_feature2') }}</span>
              </li>
              <li class="flex items-start">
                <i class="pi pi-check text-white text-xl mt-0.5 mr-3"></i>
                <span>{{ t('pricing_pro_feature3') }}</span>
              </li>
            </ul>
            
            <Button 
              :label="t('pricing_cta_popular')"
              severity="warning"
              class="w-full font-bold"
              size="large"
              @click="scrollToDemo"
            />
          </div>
          
          <!-- Scale Plan -->
          <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 fade-in" style="animation-delay: 0.3s;">
            <div class="mb-6">
              <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('pricing_enterprise_name') }}</h3>
              <p class="text-surface-600">{{ t('pricing_enterprise_desc') }}</p>
            </div>
            
            <div class="mb-8">
              <div class="flex items-baseline">
                <span class="text-5xl font-bold text-surface-900">${{ t('pricing_enterprise_price') }}</span>
                <span class="text-surface-600 ml-2">/{{ t('pricing_per_month') }}</span>
              </div>
            </div>
            
            <ul class="space-y-3 mb-8">
              <li class="flex items-start">
                <i class="pi pi-check text-green-500 text-xl mt-0.5 mr-3"></i>
                <span class="text-surface-700">{{ t('pricing_enterprise_feature1') }}</span>
              </li>
              <li class="flex items-start">
                <i class="pi pi-check text-green-500 text-xl mt-0.5 mr-3"></i>
                <span class="text-surface-700">{{ t('pricing_enterprise_feature2') }}</span>
              </li>
              <li class="flex items-start">
                <i class="pi pi-check text-green-500 text-xl mt-0.5 mr-3"></i>
                <span class="text-surface-700">{{ t('pricing_enterprise_feature3') }}</span>
              </li>
            </ul>
            
            <Button 
              :label="t('pricing_cta_contact')"
              severity="secondary"
              class="w-full"
              size="large"
              @click="scrollToDemo"
            />
          </div>
        </div>
      </div>
      
      <!-- All Plans Include -->
      <div class="mt-16 bg-white rounded-2xl shadow-lg p-8 md:p-12 max-w-4xl mx-auto fade-in" style="animation-delay: 0.4s;">
        <h3 class="text-2xl font-bold text-surface-900 mb-6 text-center">{{ t('pricing_includes_title') }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="flex items-center">
            <span class="text-2xl mr-3">{{ t('pricing_include1').substring(0, 2) }}</span>
            <p class="text-surface-700">{{ t('pricing_include1').substring(2) }}</p>
          </div>
          <div class="flex items-center">
            <span class="text-2xl mr-3">{{ t('pricing_include2').substring(0, 2) }}</span>
            <p class="text-surface-700">{{ t('pricing_include2').substring(2) }}</p>
          </div>
          <div class="flex items-center">
            <span class="text-2xl mr-3">{{ t('pricing_include3').substring(0, 2) }}</span>
            <p class="text-surface-700">{{ t('pricing_include3').substring(2) }}</p>
          </div>
          <div class="flex items-center">
            <span class="text-2xl mr-3">{{ t('pricing_include4').substring(0, 2) }}</span>
            <p class="text-surface-700">{{ t('pricing_include4').substring(2) }}</p>
          </div>
        </div>
      </div>
      
      <!-- Beta Note -->
      <div class="text-center mt-8 fade-in" style="animation-delay: 0.5s;">
        <p class="text-lg text-surface-600 font-medium">{{ t('pricing_beta_note') }}</p>
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
  
  // Remove scale on mobile for popular plan
  .transform.scale-105 {
    transform: scale(1);
  }
}
</style>