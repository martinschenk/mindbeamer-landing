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
        <p class="text-xl text-surface-600 max-w-3xl mx-auto">
          {{ t('demo_subtitle') }}
        </p>
      </div>
      
      <div class="max-w-2xl mx-auto">
        <!-- Simple Demo Request Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
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
                class="w-full"
                :class="{ 'p-invalid': errors.email }"
                :disabled="loading"
              />
              <small v-if="errors.email" class="p-error">{{ errors.email }}</small>
            </div>
            
            <!-- Marketing Consent -->
            <div class="flex items-start">
              <Checkbox 
                id="marketing-consent"
                v-model="formData.marketing_consent"
                :binary="true"
                :disabled="loading"
              />
              <label for="marketing-consent" class="ml-3 text-sm text-surface-600 cursor-pointer">
                {{ t('marketing_consent_text') }}
              </label>
            </div>
            
            <!-- Submit Button -->
            <Button 
              type="submit"
              :label="loading ? t('sending') : t('ask_for_demo')"
              severity="warning"
              size="large"
              class="w-full"
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
        
        <!-- Trust Note -->
        <div class="text-center mt-8">
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
import Checkbox from 'primevue/checkbox';
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
</style>