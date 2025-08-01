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
        <p class="text-xl text-primary-100 mb-4 fade-in" style="animation-delay: 0.1s;">
          {{ t('final_cta_subheadline') }}
        </p>
        <p class="text-lg text-primary-100 mb-8 fade-in" style="animation-delay: 0.15s;">
          {{ t('final_cta_intro') }}
        </p>
        
        <!-- Benefits List -->
        <div class="max-w-2xl mx-auto mb-10 text-left fade-in" style="animation-delay: 0.2s;">
          <ul class="space-y-3">
            <li class="flex items-start">
              <span class="text-yellow-400 mr-3 mt-1">•</span>
              <p class="text-primary-50">{{ t('final_cta_point1') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-yellow-400 mr-3 mt-1">•</span>
              <p class="text-primary-50">{{ t('final_cta_point2') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-yellow-400 mr-3 mt-1">•</span>
              <p class="text-primary-50">{{ t('final_cta_point3') }}</p>
            </li>
            <li class="flex items-start">
              <span class="text-yellow-400 mr-3 mt-1">•</span>
              <p class="text-primary-50">{{ t('final_cta_point4') }}</p>
            </li>
          </ul>
        </div>
        
        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12 fade-in" style="animation-delay: 0.3s;">
          <Button 
            :label="t('final_cta_primary')"
            severity="warning"
            size="large"
            class="text-lg px-8 py-4 font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all"
            @click="scrollToDemo"
          />
          <Button 
            :label="t('final_cta_secondary')"
            severity="secondary"
            size="large"
            class="bg-white/20 hover:bg-white/30 text-white border-white"
            @click="scrollToStartupsExample"
          />
        </div>
        
        <!-- Personal Touch -->
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 mb-8 fade-in" style="animation-delay: 0.4s;">
          <p class="text-lg font-semibold text-white mb-2">
            {{ t('final_cta_personal') }}
          </p>
          <p class="text-lg italic text-primary-100 leading-relaxed">
            {{ t('final_cta_testimonial') }}
          </p>
        </div>
        
        <!-- Urgency -->
        <div class="bg-yellow-400 text-surface-900 rounded-lg p-4 inline-block mb-8 fade-in" style="animation-delay: 0.5s;">
          <p class="font-bold text-lg">{{ t('final_cta_urgency') }}</p>
          <p class="text-sm">{{ t('final_cta_urgency_sub') }}</p>
        </div>
        
        <!-- Trust Signals -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-3xl mx-auto fade-in" style="animation-delay: 0.6s;">
          <div class="text-primary-100">{{ t('final_cta_trust1') }}</div>
          <div class="text-primary-100">{{ t('final_cta_trust2') }}</div>
          <div class="text-primary-100">{{ t('final_cta_trust3') }}</div>
          <div class="text-primary-100 md:col-span-3 md:text-center">{{ t('final_cta_trust4') }}</div>
          <div class="text-primary-100 md:col-span-3 md:text-center">{{ t('final_cta_trust5') }}</div>
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
  const element = document.querySelector('#demo');
  if (element) {
    window.location.hash = 'demo';
  }
}

function scrollToStartupsExample() {
  const element = document.querySelector('#social-proof');
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

// Mobile adjustments
@media (max-width: 768px) {
  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }
}
</style>