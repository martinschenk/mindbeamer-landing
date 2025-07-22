<template>
  <section id="final-cta" class="py-20 bg-gradient-to-br from-primary-600 to-primary-700 text-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255, 255, 255, 0.1) 35px, rgba(255, 255, 255, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <div class="max-w-4xl mx-auto text-center">
        <!-- Main CTA -->
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 fade-in">
          {{ t('final_cta_headline') }}
        </h2>
        <p class="text-xl text-primary-100 mb-12 fade-in" style="animation-delay: 0.1s;">
          {{ t('final_cta_subheadline') }}
        </p>
        
        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12 fade-in" style="animation-delay: 0.2s;">
          <Button 
            :label="t('final_cta_primary')"
            severity="warning"
            size="large"
            icon="pi pi-arrow-right"
            iconPos="right"
            class="font-semibold shadow-lg hover:scale-105 transition-transform"
            @click="scrollToDemo"
          />
          <Button 
            :label="t('final_cta_secondary')"
            severity="secondary"
            size="large"
            icon="pi pi-phone"
            iconPos="left"
            class="bg-white text-primary-700 hover:bg-surface-50"
            @click="scheduleCall"
          />
        </div>
        
        <!-- Guarantees -->
        <div class="flex flex-wrap justify-center gap-6 mb-12 fade-in" style="animation-delay: 0.3s;">
          <span class="text-primary-100">{{ t('final_cta_guarantee1') }}</span>
          <span class="text-primary-100">{{ t('final_cta_guarantee2') }}</span>
          <span class="text-primary-100">{{ t('final_cta_guarantee3') }}</span>
          <span class="text-primary-100">{{ t('final_cta_guarantee4') }}</span>
        </div>
        
        <!-- Founder Note -->
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 mt-12 fade-in" style="animation-delay: 0.4s;">
          <p class="text-lg italic text-primary-50 leading-relaxed">
            {{ t('final_cta_founder_note') }}
          </p>
          <p class="text-primary-200 mt-4 font-semibold">- Martin Schenk, Founder</p>
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
  const element = document.querySelector('#social-proof');
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
}

function scheduleCall() {
  // TODO: Implement calendar booking
  window.open('https://calendly.com/mindbeamer/demo', '_blank');
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