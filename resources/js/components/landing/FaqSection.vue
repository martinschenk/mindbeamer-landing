<template>
  <section id="faq" class="py-20 bg-white">
    <div class="container mx-auto px-6">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900 mb-4">
          {{ t('faq_title') }}
        </h2>
      </div>
      
      <!-- FAQ Items -->
      <div class="max-w-3xl mx-auto space-y-6">
        <div 
          v-for="(faq, index) in faqs" 
          :key="index"
          class="diamond-card fade-in"
          :style="`animation-delay: ${index * 0.1}s;`"
        >
          <h3 class="text-xl font-bold text-surface-900 mb-3">
            {{ t(faq.question) }}
          </h3>
          <p class="text-surface-600 leading-relaxed">
            {{ t(faq.answer) }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useLocaleStore } from '@/stores/locale';

const { t } = useLocaleStore();

const faqs = [
  { question: 'faq1_question', answer: 'faq1_answer' },
  { question: 'faq2_question', answer: 'faq2_answer' },
  { question: 'faq3_question', answer: 'faq3_answer' },
  { question: 'faq4_question', answer: 'faq4_answer' },
  { question: 'faq5_question', answer: 'faq5_answer' }
];
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