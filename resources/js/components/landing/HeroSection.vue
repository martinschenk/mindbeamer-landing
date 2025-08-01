<template>
  <section class="relative overflow-hidden bg-gradient-to-br from-primary-50 via-white to-primary-50 pb-32" :style="{ paddingTop: `${totalOffset + 48}px` }">
    <!-- Diamond Theme Animated Background -->
    <div class="hero-bg-animation">
      <div class="hero-bg-shape-1"></div>
      <div class="hero-bg-shape-2"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <div class="max-w-4xl mx-auto">
        <!-- Text Content - Now Centered -->
        <div class="text-center fade-in">
          <!-- Main Headline - Only H1 on page for SEO -->
          <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-surface-900 mb-8 leading-tight">
            {{ t('hero_headline') }}
          </h1>
          
          <!-- Subheadline - Using p tags for SEO but keeping original styling -->
          <p class="text-2xl md:text-3xl text-surface-700 mb-3">
            {{ t('hero_subheadline') }}
          </p>
          <p class="text-2xl md:text-3xl text-surface-700 mb-8">
            {{ t('hero_subheadline2') }}
          </p>
          
          <!-- Problem Setup -->
          <div class="max-w-3xl mx-auto mb-8">
            <p class="text-xl md:text-2xl text-surface-600 italic mb-6">
              {{ t('hero_problem_setup') }}
            </p>
            <p class="text-xl md:text-2xl text-surface-800 font-semibold mb-2">
              {{ t('hero_problem_twist') }}
            </p>
            <p class="text-xl md:text-2xl text-surface-800 font-bold mb-8">
              {{ t('hero_problem_repeat') }}
            </p>
          </div>
          
          <!-- Solution Hook - Using p tag instead of h2 for SEO -->
          <p class="text-3xl md:text-4xl font-bold text-primary-600 mb-10">
            {{ t('hero_solution') }}
          </p>
          
          <!-- CTA Buttons -->
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <Button 
              :label="t('hero_cta_primary')"
              severity="success"
              size="large"
              class="text-lg px-8 py-4 font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all"
              @click="jumpToDemo"
            />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useLocaleStore } from '@/stores/locale';
import { useHeaderOffset } from '@/composables/useHeaderOffset';
import Button from 'primevue/button';

const { t } = useLocaleStore();
const { totalOffset } = useHeaderOffset();

function jumpToDemo() {
  // Direct jump to demo section without smooth scrolling
  window.location.hash = 'demo';
}

function playDemo() {
  // Smooth scroll to how-it-works section with header offset
  const element = document.querySelector('#how-it-works');
  if (element) {
    const headerHeight = 80; // Approximate header height
    const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
    const offsetPosition = elementPosition - headerHeight;
    
    window.scrollTo({
      top: offsetPosition,
      behavior: 'smooth'
    });
  }
}
</script>

<style scoped lang="scss">
// Fade in animations
.fade-in {
  animation: fadeInUp 0.8s ease-out;
}

.fade-in-delayed {
  animation: fadeInUp 0.8s ease-out 0.3s both;
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