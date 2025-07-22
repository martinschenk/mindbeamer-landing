<template>
  <section id="pricing" class="py-20 bg-gradient-to-br from-white to-primary-50 relative overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0">
      <div class="absolute top-1/4 -left-20 w-60 h-60 bg-primary-200 rounded-full opacity-20 blur-3xl animate-pulse"></div>
      <div class="absolute bottom-1/4 -right-20 w-60 h-60 bg-primary-300 rounded-full opacity-20 blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900 mb-4">
          {{ t('pricing_headline') }}
        </h2>
        <p class="text-xl text-surface-600 max-w-3xl mx-auto">
          {{ t('pricing_subheadline') }}
        </p>
      </div>
      
      <!-- Beta Benefits -->
      <div class="flex flex-wrap justify-center gap-4 mb-12 fade-in" style="animation-delay: 0.1s;">
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-medium">
          {{ t('pricing_beta_benefit1') }}
        </div>
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-medium">
          {{ t('pricing_beta_benefit2') }}
        </div>
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-medium">
          {{ t('pricing_beta_benefit3') }}
        </div>
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-medium">
          {{ t('pricing_beta_benefit4') }}
        </div>
      </div>
      
      <!-- Pricing Cards -->
      <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 justify-center">
        <!-- Starter Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-8 relative overflow-hidden fade-in" style="animation-delay: 0.1s;">
          <div class="mb-8">
            <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('pricing_starter_name') }}</h3>
            <p class="text-surface-600">{{ t('pricing_starter_desc') }}</p>
          </div>
          
          <div class="mb-8">
            <div class="text-center">
              <div class="text-surface-500 line-through text-xl mb-2">{{ t('pricing_starter_old_price') }}</div>
              <div class="flex items-baseline justify-center">
                <span class="text-5xl font-bold text-surface-900">${{ t('pricing_starter_price') }}</span>
                <span class="text-surface-600 ml-2">/{{ t('pricing_per_month') }}</span>
              </div>
              <p class="text-green-600 text-sm font-semibold mt-2">{{ t('pricing_starter_savings') }}</p>
            </div>
          </div>
          
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('pricing_starter_feature1') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('pricing_starter_feature2') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('pricing_starter_feature3') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('pricing_starter_feature4') }}</span>
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
        
        <!-- Professional Plan (Recommended) -->
        <div class="bg-primary-600 text-white rounded-2xl shadow-xl p-8 relative overflow-hidden transform scale-105 fade-in" style="animation-delay: 0.2s;">
          <div class="absolute top-0 right-0 bg-yellow-400 text-surface-900 px-4 py-1 rounded-bl-lg text-sm font-semibold">
            {{ t('pricing_most_popular') }}
          </div>
          
          <div class="mb-8">
            <h3 class="text-2xl font-bold mb-2">{{ t('pricing_pro_name') }}</h3>
            <p class="text-primary-200">{{ t('pricing_pro_desc') }}</p>
          </div>
          
          <div class="mb-8">
            <div class="text-center">
              <div class="text-primary-200 line-through text-xl mb-2">{{ t('pricing_pro_old_price') }}</div>
              <div class="flex items-baseline justify-center">
                <span class="text-5xl font-bold">${{ t('pricing_pro_price') }}</span>
                <span class="text-primary-200 ml-2">/{{ t('pricing_per_month') }}</span>
              </div>
              <p class="text-yellow-300 text-sm font-semibold mt-2">{{ t('pricing_pro_savings') }}</p>
            </div>
          </div>
          
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <i class="pi pi-check-circle text-yellow-300 mt-0.5 mr-3"></i>
              <span>{{ t('pricing_pro_feature1') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-yellow-300 mt-0.5 mr-3"></i>
              <span>{{ t('pricing_pro_feature2') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-yellow-300 mt-0.5 mr-3"></i>
              <span>{{ t('pricing_pro_feature3') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-yellow-300 mt-0.5 mr-3"></i>
              <span>{{ t('pricing_pro_feature4') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-yellow-300 mt-0.5 mr-3"></i>
              <span>{{ t('pricing_pro_feature5') }}</span>
            </li>
          </ul>
          
          <Button 
            :label="t('pricing_cta_popular')"
            severity="warning"
            class="w-full"
            size="large"
            @click="scrollToDemo"
          />
        </div>
        
        <!-- Enterprise Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-8 relative overflow-hidden fade-in" style="animation-delay: 0.3s;">
          <div class="mb-8">
            <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('pricing_enterprise_name') }}</h3>
            <p class="text-surface-600">{{ t('pricing_enterprise_desc') }}</p>
          </div>
          
          <div class="mb-8">
            <div class="text-center">
              <div class="text-surface-500 line-through text-xl mb-2">{{ t('pricing_enterprise_old_price') }}</div>
              <div class="flex items-baseline justify-center">
                <span class="text-5xl font-bold text-surface-900">${{ t('pricing_enterprise_price') }}</span>
                <span class="text-surface-600 ml-2">/{{ t('pricing_per_month') }}</span>
              </div>
              <p class="text-green-600 text-sm font-semibold mt-2">{{ t('pricing_enterprise_savings') }}</p>
            </div>
          </div>
          
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('pricing_enterprise_feature1') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('pricing_enterprise_feature2') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('pricing_enterprise_feature3') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('pricing_enterprise_feature4') }}</span>
            </li>
            <li class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('pricing_enterprise_feature5') }}</span>
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
      
      <!-- Money Back Guarantee -->
      <div class="text-center mt-16 fade-in" style="animation-delay: 0.4s;">
        <div class="inline-flex items-center bg-green-100 rounded-full px-6 py-3">
          <i class="pi pi-shield text-green-600 text-2xl mr-3"></i>
          <div class="text-left">
            <p class="font-bold text-gray-900">{{ t('pricing_guarantee_title') }}</p>
            <p class="text-sm text-gray-700">{{ t('pricing_guarantee_desc') }}</p>
          </div>
        </div>
      </div>
      
      <!-- Beta Counter -->
      <div class="text-center mt-12 fade-in" style="animation-delay: 0.5s;">
        <div class="bg-surface-100 rounded-lg p-6 inline-block">
          <p class="text-surface-700 mb-2" v-html="t('pricing_beta_counter')"></p>
          <p class="text-surface-600" v-html="t('pricing_beta_note')"></p>
        </div>
      </div>
      
      <!-- FAQ Link -->
      <div class="text-center mt-8 fade-in" style="animation-delay: 0.6s;">
        <p class="text-gray-600">
          {{ t('pricing_questions') }} 
          <a href="#contact" class="text-indigo-600 hover:text-indigo-700 font-semibold">{{ t('pricing_contact_us') }}</a>
        </p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useLocaleStore } from '@/stores/locale';
import Button from 'primevue/button';

const { t } = useLocaleStore();

function scrollToDemo() {
  const element = document.querySelector('#contact');
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