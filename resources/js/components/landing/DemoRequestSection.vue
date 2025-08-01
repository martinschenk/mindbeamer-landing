<template>
  <section id="demo" class="py-20 bg-gradient-to-br from-primary-50 to-white relative overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0">
      <div class="absolute -top-20 -right-20 w-80 h-80 bg-primary-200 rounded-full opacity-20 blur-3xl animate-float"></div>
      <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-primary-300 rounded-full opacity-20 blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900 mb-4">
          {{ t('demo_title') }}
        </h2>
        <p class="text-xl text-surface-600 max-w-3xl mx-auto mb-8">
          {{ t('demo_subtitle') }}
        </p>
        <!-- Visual separator -->
        <div class="flex items-center justify-center gap-4">
          <div class="h-px w-16 bg-gradient-to-r from-transparent to-primary-300"></div>
          <i class="pi pi-sparkles text-primary-500 text-xl"></i>
          <div class="h-px w-16 bg-gradient-to-l from-transparent to-primary-300"></div>
        </div>
      </div>
      
      <!-- Single centered demo booking option -->
      <div class="max-w-2xl mx-auto">
        <!-- Book Free Demo -->
        <div class="bg-white rounded-2xl shadow-xl p-8 relative overflow-hidden fade-in" style="animation-delay: 0.1s;">
          <!-- Badge -->
          <div class="absolute top-0 right-0 bg-gradient-to-br from-yellow-400 to-orange-400 text-white px-4 py-2 rounded-bl-2xl rounded-tr-2xl">
            <span class="text-sm font-semibold">{{ t('demo_badge') }}</span>
          </div>
          
          <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-full mb-4">
              <i class="pi pi-video text-3xl text-primary-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('demo_main_title') }}</h3>
            <p class="text-surface-600 mb-6">{{ t('demo_main_subtitle') }}</p>
          </div>
          
          <!-- Demo Benefits -->
          <div class="space-y-3 mb-8">
            <div class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('demo_benefit1') }}</span>
            </div>
            <div class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('demo_benefit2') }}</span>
            </div>
            <div class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('demo_benefit3') }}</span>
            </div>
            <div class="flex items-start">
              <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
              <span class="text-surface-700">{{ t('demo_benefit4') }}</span>
            </div>
          </div>
          
          <!-- Demo Button -->
          <Button 
            :label="t('demo_cta')"
            severity="warning"
            size="large"
            class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
            icon="pi pi-calendar"
            iconPos="right"
            @click="openCalendly"
          />
          
          <!-- Trust Indicators -->
          <div class="mt-6 pt-6 border-t border-gray-200">
            <p class="text-sm text-surface-600 text-center">
              <i class="pi pi-check mr-2 text-green-500"></i>
              {{ t('demo_availability') }}
            </p>
          </div>
        </div>
        
        <!-- Trust Note -->
        <div class="text-center mt-12">
          <p class="text-sm text-surface-600">
            <i class="pi pi-lock mr-2"></i>
            {{ t('demo_note') }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue';
import { useLocaleStore } from '@/stores/locale';
import Button from 'primevue/button';

const localeStore = useLocaleStore();
const { t } = localeStore;

// Calendly state
const showCalendlyEmbed = ref(false);

// Open Calendly using official popup widget
const openCalendly = () => {
  // First, ensure Calendly script is loaded
  loadCalendlyScript();
  
  // Check if Calendly is available and open popup
  const attemptOpen = () => {
    if (window.Calendly) {
      window.Calendly.initPopupWidget({
        url: 'https://calendly.com/m-schenk-mindbeamer/30min'
      });
      
      // Simple click-outside-to-close functionality
      setTimeout(() => {
        const calendlyOverlay = document.querySelector('.calendly-overlay');
        
        if (calendlyOverlay) {
          // Add click handler to overlay
          calendlyOverlay.addEventListener('click', (e) => {
            // Only close if clicking the overlay itself, not the popup content
            if (e.target === calendlyOverlay) {
              closeCalendlyPopup();
            }
          });
        }
      }, 500);
    } else {
      // If Calendly not loaded yet, wait a bit and try again
      setTimeout(attemptOpen, 200);
    }
  };
  
  // Small delay to ensure script loads
  setTimeout(attemptOpen, 100);
};

// Close Calendly popup
const closeCalendlyPopup = () => {
  const calendlyClose = document.querySelector('.calendly-close-overlay') || 
                       document.querySelector('.calendly-popup-close');
  if (calendlyClose) {
    calendlyClose.click();
  } else {
    // Fallback: remove the popup elements
    const overlay = document.querySelector('.calendly-overlay');
    const popup = document.querySelector('.calendly-popup');
    if (overlay) overlay.remove();
    if (popup) popup.remove();
  }
};

// Load Calendly script for inline widget (if using embed option)
const loadCalendlyScript = () => {
  if (!document.querySelector('script[src*="calendly.com"]')) {
    const script = document.createElement('script');
    script.src = 'https://assets.calendly.com/assets/external/widget.js';
    script.async = true;
    document.body.appendChild(script);
  }
};
</script>

<style scoped>
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

/* Equal height cards */
@media (min-width: 1024px) {
  .grid > div {
    display: flex;
    flex-direction: column;
  }
}

/* Hover effects for cards */
.bg-white:hover {
  transform: translateY(-4px);
  transition: all 0.3s ease;
}

/* Badge styling */
.absolute.top-0.right-0 {
  font-size: 0.875rem;
}

/* Calendly widget styling if used */
.calendly-inline-widget {
  border-radius: 8px;
  overflow: hidden;
}
</style>