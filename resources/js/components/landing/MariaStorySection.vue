<template>
  <section id="maria-story" class="py-20 bg-gradient-to-br from-orange-50 to-yellow-50 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
      <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(251, 146, 60, 0.1) 35px, rgba(251, 146, 60, 0.1) 70px);"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-12 fade-in">
        <h2 class="text-4xl md:text-5xl font-bold text-surface-900 mb-8">
          {{ t('maria_headline') }}
        </h2>
      </div>
      
      <!-- Maria's Story -->
      <div class="max-w-4xl mx-auto">
        <!-- Introduction -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-8 fade-in" style="animation-delay: 0.1s;">
          <p class="text-lg md:text-xl text-surface-700 leading-relaxed">
            {{ t('maria_intro') }}
          </p>
        </div>
        
        <!-- The Sunday Struggle -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-8 fade-in" style="animation-delay: 0.2s;">
          <h3 class="text-2xl font-bold text-red-600 mb-4">{{ t('maria_struggle_title') }}</h3>
          <p class="text-lg text-surface-700 mb-6">{{ t('maria_struggle_subtitle') }}</p>
          
          <!-- Maria's Story Illustration -->
          <div class="my-8">
            <img 
              src="/images/maria-story.webp" 
              alt="Maria's transformation from stressed to relaxed with MindBeamer" 
              class="w-full max-w-3xl mx-auto rounded-xl shadow-lg"
              loading="lazy"
            />
          </div>
          
          <div class="space-y-4 mb-6">
            <div class="flex items-start">
              <span class="text-2xl mr-4">📸</span>
              <p class="text-lg text-surface-700"><strong>{{ t('maria_instagram') }}</strong></p>
            </div>
            <div class="flex items-start">
              <span class="text-2xl mr-4">📘</span>
              <p class="text-lg text-surface-700"><strong>{{ t('maria_facebook') }}</strong></p>
            </div>
            <div class="flex items-start">
              <span class="text-2xl mr-4">💼</span>
              <p class="text-lg text-surface-700"><strong>{{ t('maria_linkedin') }}</strong></p>
            </div>
            <div class="flex items-start">
              <span class="text-2xl mr-4">🌐</span>
              <p class="text-lg text-surface-700"><strong>{{ t('maria_blog') }}</strong></p>
            </div>
          </div>
          
          <p class="text-xl font-bold text-red-700">
            {{ t('maria_time') }}
          </p>
        </div>
        
        <!-- The Transformation -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-xl p-8 md:p-12 mb-8 fade-in" style="animation-delay: 0.3s;">
          <h3 class="text-2xl font-bold text-green-700 mb-6">{{ t('maria_transformation') }}</h3>
          
          <div class="space-y-3 mb-8">
            <div class="flex items-center">
              <span class="text-green-600 text-2xl mr-3">✅</span>
              <p class="text-lg text-surface-700">{{ t('maria_benefit1') }}</p>
            </div>
            <div class="flex items-center">
              <span class="text-green-600 text-2xl mr-3">✅</span>
              <p class="text-lg text-surface-700">{{ t('maria_benefit2') }}</p>
            </div>
            <div class="flex items-center">
              <span class="text-green-600 text-2xl mr-3">✅</span>
              <p class="text-lg text-surface-700">{{ t('maria_benefit3') }}</p>
            </div>
            <div class="flex items-center">
              <span class="text-green-600 text-2xl mr-3">✅</span>
              <p class="text-lg text-surface-700 font-bold">{{ t('maria_benefit4') }}</p>
            </div>
          </div>
          
          <div class="border-t-2 border-green-200 pt-6">
            <p class="text-xl text-surface-800 mb-2">{{ t('maria_result1') }}</p>
            <p class="text-xl text-surface-800 font-bold">{{ t('maria_result2') }}</p>
          </div>
        </div>
        
        <!-- CTA -->
        <div class="text-center fade-in" style="animation-delay: 0.4s;">
          <Button 
            :label="t('maria_cta')"
            severity="warning"
            size="large"
            class="text-xl px-10 py-5 font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all animate-bounce"
            @click="scrollToDemo"
          />
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

// Bounce animation for CTA
@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-10px);
  }
  60% {
    transform: translateY(-5px);
  }
}

.animate-bounce {
  animation: bounce 2s infinite;
}
</style>