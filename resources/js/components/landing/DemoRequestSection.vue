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
      
      <!-- Two-column layout for demo options -->
      <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          
          <!-- Option 1: Quick Demo Form -->
          <div class="bg-white rounded-2xl shadow-xl p-8 relative overflow-hidden fade-in" style="animation-delay: 0.1s;">
            <!-- Badge -->
            <div class="absolute top-0 right-0 bg-gradient-to-br from-yellow-400 to-orange-400 text-white px-4 py-2 rounded-bl-2xl rounded-tr-2xl">
              <span class="text-sm font-semibold">{{ t('demo_form_badge') }}</span>
            </div>
            
            <div class="text-center mb-6">
              <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-full mb-4">
                <i class="pi pi-video text-3xl text-primary-600"></i>
              </div>
              <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('demo_form_title') }}</h3>
              <p class="text-surface-600">{{ t('demo_form_subtitle') }}</p>
            </div>
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Email Field -->
            <div>
              <label for="demo-email" class="block text-sm font-medium text-surface-700 mb-2">
                {{ t('your_email') }} <span class="text-red-500">*</span>
              </label>
              <InputText 
                id="demo-email"
                v-model="formData.email"
                type="email"
                :placeholder="'you@company.com'"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-colors"
                :class="{ 'p-invalid': errors.email, 'border-red-500': errors.email }"
                :disabled="loading"
              />
              <small v-if="errors.email" class="p-error">{{ errors.email }}</small>
            </div>
            
            <!-- Marketing Consent -->
            <div class="field">
              <div class="flex items-center justify-between">
                <label class="text-sm text-surface-600 flex-1 mr-4">
                  {{ t('marketing_consent_text') }}
                </label>
                <InputSwitch 
                  v-model="formData.marketing_consent"
                  :disabled="loading"
                  class="flex-shrink-0"
                />
              </div>
            </div>
            
            <!-- Submit Button -->
            <Button 
              type="submit"
              :label="loading ? t('sending') : t('ask_for_demo')"
              severity="warning"
              size="large"
              class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
              :loading="loading"
              icon="pi pi-arrow-right"
              iconPos="right"
            />
          </form>
          
          <!-- Success Message -->
          <div v-if="showSuccess" class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
              <i class="pi pi-check-circle text-green-600 text-xl mr-2"></i>
              <p class="text-green-800">{{ t('form_success') }}</p>
            </div>
          </div>
          
          <!-- Error Message -->
          <div v-if="showError" class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center">
              <i class="pi pi-times-circle text-red-600 text-xl mr-2"></i>
              <p class="text-red-800">{{ errorMessage || t('form_error') }}</p>
            </div>
          </div>
          </div>
          
          <!-- Option 2: Book Live Call -->
          <div class="bg-white rounded-2xl shadow-xl p-8 relative overflow-hidden fade-in" style="animation-delay: 0.2s;">
            <!-- Badge -->
            <div class="absolute top-0 right-0 bg-gradient-to-br from-green-400 to-teal-400 text-white px-4 py-2 rounded-bl-2xl rounded-tr-2xl">
              <span class="text-sm font-semibold">{{ t('calendly_badge') }}</span>
            </div>
            
            <div class="text-center mb-6">
              <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                <i class="pi pi-video text-3xl text-green-600"></i>
              </div>
              <h3 class="text-2xl font-bold text-surface-900 mb-2">{{ t('calendly_title') }}</h3>
              <p class="text-surface-600 mb-6">{{ t('calendly_subtitle') }}</p>
            </div>
            
            <!-- Calendly Benefits -->
            <div class="space-y-3 mb-8">
              <div class="flex items-start">
                <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
                <span class="text-surface-700">{{ t('calendly_benefit1') }}</span>
              </div>
              <div class="flex items-start">
                <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
                <span class="text-surface-700">{{ t('calendly_benefit2') }}</span>
              </div>
              <div class="flex items-start">
                <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
                <span class="text-surface-700">{{ t('calendly_benefit3') }}</span>
              </div>
            </div>
            
            <!-- Calendly Button -->
            <Button 
              :label="t('calendly_cta')"
              severity="success"
              size="large"
              class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
              icon="pi pi-calendar"
              iconPos="right"
              @click="openCalendly"
            />
            
            <!-- Optional: Direct Calendly embed could go here -->
            <div v-if="showCalendlyEmbed" class="mt-6">
              <!-- Calendly inline widget will be dynamically inserted here -->
              <div class="calendly-inline-widget" 
                data-url="https://calendly.com/m-schenk-mindbeamer/30min?hide_gdpr_banner=1" 
                style="min-width:320px;height:630px;">
              </div>
            </div>
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
import { ref, reactive } from 'vue';
import { useLocaleStore } from '@/stores/locale';
import { useToast } from 'primevue/usetoast';
import InputText from 'primevue/inputtext';
import InputSwitch from 'primevue/inputswitch';
import Button from 'primevue/button';
import axios from 'axios';

const localeStore = useLocaleStore();
const { t, currentLocale } = localeStore;
const toast = useToast();

// Form data
const formData = reactive({
  email: '',
  marketing_consent: false
});

// Form state
const loading = ref(false);
const errors = ref({});
const showSuccess = ref(false);
const showError = ref(false);
const errorMessage = ref('');

// Calendly state
const showCalendlyEmbed = ref(false);

// Form validation
const validateForm = () => {
  errors.value = {};
  
  if (!formData.email) {
    errors.value.email = t('contact_error_email_required');
    return false;
  }
  
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
    errors.value.email = t('contact_error_email_invalid');
    return false;
  }
  
  return true;
};

// Handle form submission
const handleSubmit = async () => {
  if (!validateForm()) {
    return;
  }
  
  loading.value = true;
  showSuccess.value = false;
  showError.value = false;
  errorMessage.value = '';
  
  // Minimum loading time for better UX
  const startTime = Date.now();
  
  try {
    const response = await axios.post(window.__APP_DATA__.routes['api.demo-request'], {
      email: formData.email,
      marketing_consent: formData.marketing_consent
    }, {
      headers: {
        'X-CSRF-TOKEN': window.__APP_DATA__.csrfToken,
        'X-Locale': currentLocale,
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      }
    });
    
    // Ensure minimum 2 second loading time
    const elapsedTime = Date.now() - startTime;
    if (elapsedTime < 2000) {
      await new Promise(resolve => setTimeout(resolve, 2000 - elapsedTime));
    }
    
    // Success
    showSuccess.value = true;
    
    // Also show toast notification
    toast.add({ 
      severity: 'success', 
      summary: t('contact_success_title'), 
      detail: t('form_success'),
      life: 5000 
    });
    
    // Reset form
    formData.email = '';
    formData.marketing_consent = false;
    
  } catch (error) {
    // Ensure minimum 2 second loading time
    const elapsedTime = Date.now() - startTime;
    if (elapsedTime < 2000) {
      await new Promise(resolve => setTimeout(resolve, 2000 - elapsedTime));
    }
    
    // Error handling
    showError.value = true;
    
    if (error.response?.data?.errors?.email) {
      errors.value.email = error.response.data.errors.email[0];
    } else if (error.response?.data?.message) {
      errorMessage.value = error.response.data.message;
    } else {
      errorMessage.value = t('form_error');
    }
    
    // Also show toast notification
    toast.add({ 
      severity: 'error', 
      summary: t('contact_error_title'), 
      detail: errorMessage.value || t('form_error'),
      life: 5000 
    });
  } finally {
    loading.value = false;
  }
};

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

/* Style for InputSwitch */
:deep(.p-inputswitch) {
  width: 3rem !important;
  height: 1.75rem !important;
}

:deep(.p-inputswitch .p-inputswitch-slider) {
  background: #e5e7eb !important;
  transition: background-color 0.2s, transform 0.2s !important;
}

:deep(.p-inputswitch.p-inputswitch-checked .p-inputswitch-slider) {
  background: #3b82f6 !important;
}

:deep(.p-inputswitch:hover .p-inputswitch-slider) {
  background: #d1d5db !important;
}

:deep(.p-inputswitch.p-inputswitch-checked:hover .p-inputswitch-slider) {
  background: #2563eb !important;
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