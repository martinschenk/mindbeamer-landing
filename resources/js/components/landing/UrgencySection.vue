<template>
  <section id="urgency" class="py-20 bg-gradient-to-r from-red-600 to-orange-600 text-white relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0">
      <div class="absolute top-0 left-0 w-full h-full bg-black opacity-10"></div>
      <div class="absolute -top-10 -right-10 w-40 h-40 bg-white rounded-full opacity-10 animate-ping"></div>
      <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white rounded-full opacity-10 animate-ping" style="animation-delay: 1s;"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Main Urgency Message -->
      <div class="text-center mb-12 fade-in">
        <div class="inline-flex items-center bg-yellow-400 text-gray-900 rounded-full px-6 py-2 mb-6 animate-bounce">
          <i class="pi pi-clock text-xl mr-2"></i>
          <span class="font-bold">{{ t('urgency_limited_time') }}</span>
        </div>
        
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
          {{ t('urgency_headline') }}
        </h2>
        <p class="text-xl text-white/90 max-w-3xl mx-auto">
          {{ t('urgency_subheadline') }}
        </p>
      </div>
      
      <!-- Countdown Timer -->
      <div class="max-w-2xl mx-auto mb-12 fade-in" style="animation-delay: 0.2s;">
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center">
          <p class="text-lg mb-4">{{ t('urgency_offer_ends') }}</p>
          <div class="grid grid-cols-4 gap-4">
            <div>
              <div class="text-4xl font-bold">{{ days }}</div>
              <p class="text-sm text-white/80">{{ t('urgency_days') }}</p>
            </div>
            <div>
              <div class="text-4xl font-bold">{{ hours }}</div>
              <p class="text-sm text-white/80">{{ t('urgency_hours') }}</p>
            </div>
            <div>
              <div class="text-4xl font-bold">{{ minutes }}</div>
              <p class="text-sm text-white/80">{{ t('urgency_minutes') }}</p>
            </div>
            <div>
              <div class="text-4xl font-bold">{{ seconds }}</div>
              <p class="text-sm text-white/80">{{ t('urgency_seconds') }}</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Bonus Offers -->
      <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <!-- Bonus 1 -->
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center fade-in" style="animation-delay: 0.3s;">
          <i class="pi pi-gift text-4xl mb-3"></i>
          <h3 class="font-bold text-lg mb-2">{{ t('urgency_bonus1_title') }}</h3>
          <p class="text-sm text-white/90">{{ t('urgency_bonus1_desc') }}</p>
          <p class="text-yellow-300 font-bold mt-2">{{ t('urgency_bonus1_value') }}</p>
        </div>
        
        <!-- Bonus 2 -->
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center fade-in" style="animation-delay: 0.4s;">
          <i class="pi pi-book text-4xl mb-3"></i>
          <h3 class="font-bold text-lg mb-2">{{ t('urgency_bonus2_title') }}</h3>
          <p class="text-sm text-white/90">{{ t('urgency_bonus2_desc') }}</p>
          <p class="text-yellow-300 font-bold mt-2">{{ t('urgency_bonus2_value') }}</p>
        </div>
        
        <!-- Bonus 3 -->
        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center fade-in" style="animation-delay: 0.5s;">
          <i class="pi pi-users text-4xl mb-3"></i>
          <h3 class="font-bold text-lg mb-2">{{ t('urgency_bonus3_title') }}</h3>
          <p class="text-sm text-white/90">{{ t('urgency_bonus3_desc') }}</p>
          <p class="text-yellow-300 font-bold mt-2">{{ t('urgency_bonus3_value') }}</p>
        </div>
      </div>
      
      <!-- Scarcity Message -->
      <div class="text-center mb-12 fade-in" style="animation-delay: 0.6s;">
        <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-8 py-4">
          <i class="pi pi-exclamation-triangle text-yellow-300 text-2xl mr-3 animate-pulse"></i>
          <div class="text-left">
            <p class="font-bold">{{ t('urgency_spots_remaining', { spots: spotsRemaining }) }}</p>
            <p class="text-sm text-white/90">{{ t('urgency_spots_desc') }}</p>
          </div>
        </div>
      </div>
      
      <!-- CTA -->
      <div class="text-center fade-in" style="animation-delay: 0.7s;">
        <Button 
          :label="t('urgency_cta')"
          severity="warning"
          size="large"
          @click="scrollToDemo"
          icon="pi pi-arrow-right"
          iconPos="right"
          class="animate-wiggle transform hover:scale-105 transition-all duration-200"
        />
        <p class="text-sm text-white/80 mt-4">{{ t('urgency_no_credit_card') }}</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { useLocaleStore } from '@/stores/locale';
import Button from 'primevue/button';

const { t } = useLocaleStore();

// Countdown timer
const endDate = ref(new Date(Date.now() + 3 * 24 * 60 * 60 * 1000)); // 3 days from now
const now = ref(new Date());
let timer = null;

const days = computed(() => {
  const diff = endDate.value - now.value;
  return Math.floor(diff / (1000 * 60 * 60 * 24));
});

const hours = computed(() => {
  const diff = endDate.value - now.value;
  return Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
});

const minutes = computed(() => {
  const diff = endDate.value - now.value;
  return Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
});

const seconds = computed(() => {
  const diff = endDate.value - now.value;
  return Math.floor((diff % (1000 * 60)) / 1000);
});

// Scarcity
const spotsRemaining = ref(7);

onMounted(() => {
  timer = setInterval(() => {
    now.value = new Date();
  }, 1000);
});

onUnmounted(() => {
  if (timer) {
    clearInterval(timer);
  }
});

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

.animate-wiggle {
  animation: wiggle 2s ease-in-out infinite;
}

@keyframes wiggle {
  0%, 100% {
    transform: rotate(-3deg);
  }
  50% {
    transform: rotate(3deg);
  }
}
</style>