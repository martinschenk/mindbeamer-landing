<template>
  <section id="guarantee" class="py-20 bg-gradient-to-br from-green-50 to-emerald-50 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0">
      <div class="absolute top-20 left-20 w-96 h-96 bg-green-200 rounded-full opacity-20 blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-emerald-200 rounded-full opacity-20 blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Main Guarantee Box -->
      <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden fade-in">
          <!-- Header -->
          <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white p-8 text-center">
            <i class="pi pi-shield text-6xl mb-4"></i>
            <h2 class="text-3xl md:text-4xl font-bold mb-2">
              {{ t('guarantee_headline') }}
            </h2>
            <p class="text-xl text-green-100">
              {{ t('guarantee_subheadline') }}
            </p>
          </div>
          
          <!-- Content -->
          <div class="p-8 md:p-12">
            <!-- Main Promise -->
            <div class="text-center mb-10">
              <p class="text-xl text-gray-700 leading-relaxed">
                {{ t('guarantee_promise') }}
              </p>
            </div>
            
            <!-- Guarantee Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
              <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                  <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="pi pi-check text-green-600"></i>
                  </div>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 mb-1">{{ t('guarantee_point1_title') }}</h3>
                  <p class="text-gray-600">{{ t('guarantee_point1_desc') }}</p>
                </div>
              </div>
              
              <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                  <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="pi pi-check text-green-600"></i>
                  </div>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 mb-1">{{ t('guarantee_point2_title') }}</h3>
                  <p class="text-gray-600">{{ t('guarantee_point2_desc') }}</p>
                </div>
              </div>
              
              <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                  <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="pi pi-check text-green-600"></i>
                  </div>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 mb-1">{{ t('guarantee_point3_title') }}</h3>
                  <p class="text-gray-600">{{ t('guarantee_point3_desc') }}</p>
                </div>
              </div>
              
              <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                  <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="pi pi-check text-green-600"></i>
                  </div>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 mb-1">{{ t('guarantee_point4_title') }}</h3>
                  <p class="text-gray-600">{{ t('guarantee_point4_desc') }}</p>
                </div>
              </div>
            </div>
            
            <!-- Risk Reversal -->
            <div class="bg-green-50 rounded-2xl p-6 text-center mb-8">
              <i class="pi pi-info-circle text-green-600 text-2xl mb-3"></i>
              <p class="text-gray-700">
                <strong>{{ t('guarantee_risk_title') }}</strong><br>
                {{ t('guarantee_risk_desc') }}
              </p>
            </div>
            
            <!-- CTA -->
            <div class="text-center">
              <Button 
                :label="t('guarantee_cta')"
                severity="success"
                size="large"
                @click="scrollToDemo"
                icon="pi pi-arrow-right"
                iconPos="right"
                class="transform hover:scale-105 transition-transform"
              />
              <p class="text-sm text-gray-600 mt-4">{{ t('guarantee_disclaimer') }}</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Trust Badges -->
      <div class="mt-12 text-center fade-in" style="animation-delay: 0.3s;">
        <p class="text-gray-600 mb-4">{{ t('guarantee_trusted_by') }}</p>
        <div class="flex flex-wrap justify-center items-center gap-8">
          <div class="text-center">
            <i class="pi pi-verified text-4xl text-indigo-600 mb-2"></i>
            <p class="text-sm text-gray-600">{{ t('guarantee_badge1') }}</p>
          </div>
          <div class="text-center">
            <i class="pi pi-lock text-4xl text-green-600 mb-2"></i>
            <p class="text-sm text-gray-600">{{ t('guarantee_badge2') }}</p>
          </div>
          <div class="text-center">
            <i class="pi pi-star-fill text-4xl text-yellow-500 mb-2"></i>
            <p class="text-sm text-gray-600">{{ t('guarantee_badge3') }}</p>
          </div>
          <div class="text-center">
            <i class="pi pi-thumbs-up text-4xl text-blue-600 mb-2"></i>
            <p class="text-sm text-gray-600">{{ t('guarantee_badge4') }}</p>
          </div>
        </div>
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