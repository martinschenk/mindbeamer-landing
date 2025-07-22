<template>
  <section id="trust" class="py-20 bg-gray-50 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-100 rounded-full opacity-10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-200 rounded-full opacity-10 blur-3xl"></div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
          {{ t('trust_headline') }}
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          {{ t('trust_subheadline') }}
        </p>
      </div>
      
      <!-- Trust Indicators Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
        <!-- Years in Business -->
        <div class="text-center fade-in" style="animation-delay: 0.1s;">
          <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="pi pi-calendar text-3xl text-indigo-600"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ t('trust_years_number') }}</h3>
          <p class="text-gray-600">{{ t('trust_years_text') }}</p>
        </div>
        
        <!-- Active Users -->
        <div class="text-center fade-in" style="animation-delay: 0.2s;">
          <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="pi pi-users text-3xl text-green-600"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ t('trust_customers_number') }}</h3>
          <p class="text-gray-600">{{ t('trust_customers_text') }}</p>
        </div>
        
        <!-- Posts Created -->
        <div class="text-center fade-in" style="animation-delay: 0.3s;">
          <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="pi pi-share-alt text-3xl text-purple-600"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ t('trust_posts_number') }}</h3>
          <p class="text-gray-600">{{ t('trust_posts_text') }}</p>
        </div>
        
        <!-- ROI Average -->
        <div class="text-center fade-in" style="animation-delay: 0.4s;">
          <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="pi pi-chart-line text-3xl text-orange-600"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ t('trust_roi_number') }}</h3>
          <p class="text-gray-600">{{ t('trust_roi_text') }}</p>
        </div>
      </div>
      
      <!-- Testimonials -->
      <div class="max-w-6xl mx-auto">
        <h3 class="text-2xl font-bold text-center text-gray-900 mb-12 fade-in">
          {{ t('trust_testimonials_title') }}
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Testimonial 1 -->
          <div class="bg-white rounded-2xl shadow-lg p-8 fade-in" style="animation-delay: 0.5s;">
            <div class="flex items-center mb-4">
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
            </div>
            <p class="text-gray-700 mb-4 italic">"{{ t('testimonial1_text') }}"</p>
            <div class="border-t pt-4">
              <p class="font-semibold text-gray-900">{{ t('testimonial1_name') }}</p>
              <p class="text-sm text-gray-600">{{ t('testimonial1_company') }}</p>
            </div>
          </div>
          
          <!-- Testimonial 2 -->
          <div class="bg-white rounded-2xl shadow-lg p-8 fade-in" style="animation-delay: 0.6s;">
            <div class="flex items-center mb-4">
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
            </div>
            <p class="text-gray-700 mb-4 italic">"{{ t('testimonial2_text') }}"</p>
            <div class="border-t pt-4">
              <p class="font-semibold text-gray-900">{{ t('testimonial2_name') }}</p>
              <p class="text-sm text-gray-600">{{ t('testimonial2_company') }}</p>
            </div>
          </div>
          
          <!-- Testimonial 3 -->
          <div class="bg-white rounded-2xl shadow-lg p-8 fade-in" style="animation-delay: 0.7s;">
            <div class="flex items-center mb-4">
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
              <i class="pi pi-star-fill text-yellow-500"></i>
            </div>
            <p class="text-gray-700 mb-4 italic">"{{ t('testimonial3_text') }}"</p>
            <div class="border-t pt-4">
              <p class="font-semibold text-gray-900">{{ t('testimonial3_name') }}</p>
              <p class="text-sm text-gray-600">{{ t('testimonial3_company') }}</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Awards & Recognition -->
      <div class="mt-16 text-center fade-in" style="animation-delay: 0.8s;">
        <h3 class="text-xl font-semibold text-gray-900 mb-8">{{ t('trust_awards_title') }}</h3>
        <div class="flex flex-wrap justify-center items-center gap-8">
          <div class="text-center">
            <i class="pi pi-verified text-5xl text-indigo-600 mb-2"></i>
            <p class="text-sm text-gray-600">{{ t('trust_certified_partner') }}</p>
          </div>
          <div class="text-center">
            <i class="pi pi-shield text-5xl text-green-600 mb-2"></i>
            <p class="text-sm text-gray-600">{{ t('trust_secure_platform') }}</p>
          </div>
          <div class="text-center">
            <i class="pi pi-trophy text-5xl text-yellow-600 mb-2"></i>
            <p class="text-sm text-gray-600">{{ t('trust_award_winner') }}</p>
          </div>
          <div class="text-center">
            <i class="pi pi-heart text-5xl text-red-600 mb-2"></i>
            <p class="text-sm text-gray-600">{{ t('trust_customer_choice') }}</p>
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
</style>