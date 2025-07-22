<template>
  <section id="contact" class="py-20 bg-gradient-to-br from-indigo-50 to-white relative overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0">
      <div class="absolute -top-20 -right-20 w-80 h-80 bg-indigo-200 rounded-full opacity-20 blur-3xl animate-float"></div>
      <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-purple-200 rounded-full opacity-20 blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
          {{ t('contact_headline') }}
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          {{ t('contact_subheadline') }}
        </p>
      </div>
      
      <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div class="fade-in" style="animation-delay: 0.1s;">
          <div class="bg-white rounded-2xl shadow-xl p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ t('contact_form_title') }}</h3>
            
            <form @submit.prevent="handleSubmit" class="space-y-6">
              <!-- Name Field -->
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                  {{ t('contact_name') }} <span class="text-red-500">*</span>
                </label>
                <InputText 
                  id="name"
                  v-model="formData.name"
                  :placeholder="t('contact_name_placeholder')"
                  class="w-full"
                  :class="{ 'p-invalid': errors.name }"
                />
                <small v-if="errors.name" class="p-error">{{ errors.name }}</small>
              </div>
              
              <!-- Email Field -->
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                  {{ t('contact_email') }} <span class="text-red-500">*</span>
                </label>
                <InputText 
                  id="email"
                  v-model="formData.email"
                  type="email"
                  :placeholder="t('contact_email_placeholder')"
                  class="w-full"
                  :class="{ 'p-invalid': errors.email }"
                />
                <small v-if="errors.email" class="p-error">{{ errors.email }}</small>
              </div>
              
              <!-- Company Field -->
              <div>
                <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                  {{ t('contact_company') }}
                </label>
                <InputText 
                  id="company"
                  v-model="formData.company"
                  :placeholder="t('contact_company_placeholder')"
                  class="w-full"
                />
              </div>
              
              <!-- Message Field -->
              <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                  {{ t('contact_message') }}
                </label>
                <Textarea 
                  id="message"
                  v-model="formData.message"
                  :placeholder="t('contact_message_placeholder')"
                  rows="4"
                  class="w-full"
                />
              </div>
              
              <!-- Privacy Consent -->
              <div class="flex items-start">
                <Checkbox 
                  id="privacy"
                  v-model="formData.privacy"
                  :binary="true"
                  :class="{ 'p-invalid': errors.privacy }"
                />
                <label for="privacy" class="ml-3 text-sm text-gray-600">
                  {{ t('contact_privacy_consent') }}
                  <router-link :to="getLocalizedUrl('privacy')" class="text-indigo-600 hover:text-indigo-700">
                    {{ t('footer_privacy') }}
                  </router-link>
                </label>
              </div>
              <small v-if="errors.privacy" class="p-error block">{{ errors.privacy }}</small>
              
              <!-- Submit Button -->
              <Button 
                type="submit"
                :label="t('contact_submit')"
                severity="primary"
                size="large"
                class="w-full"
                :loading="loading"
                icon="pi pi-send"
                iconPos="right"
              />
            </form>
          </div>
        </div>
        
        <!-- Benefits & Info -->
        <div class="space-y-8 fade-in" style="animation-delay: 0.2s;">
          <!-- What to Expect -->
          <div class="bg-white rounded-2xl shadow-lg p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('contact_what_to_expect_title') }}</h3>
            <ul class="space-y-3">
              <li class="flex items-start">
                <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
                <span class="text-gray-700">{{ t('contact_expect1') }}</span>
              </li>
              <li class="flex items-start">
                <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
                <span class="text-gray-700">{{ t('contact_expect2') }}</span>
              </li>
              <li class="flex items-start">
                <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
                <span class="text-gray-700">{{ t('contact_expect3') }}</span>
              </li>
              <li class="flex items-start">
                <i class="pi pi-check-circle text-green-500 mt-0.5 mr-3"></i>
                <span class="text-gray-700">{{ t('contact_expect4') }}</span>
              </li>
            </ul>
          </div>
          
          <!-- Contact Info -->
          <div class="bg-indigo-600 text-white rounded-2xl p-8">
            <h3 class="text-xl font-bold mb-4">{{ t('contact_other_ways_title') }}</h3>
            <div class="space-y-4">
              <div class="flex items-center">
                <i class="pi pi-envelope text-2xl mr-4"></i>
                <div>
                  <p class="font-semibold">{{ t('contact_email_label') }}</p>
                  <a href="mailto:hello@mindbeamer.io" class="text-indigo-200 hover:text-white">
                    hello@mindbeamer.io
                  </a>
                </div>
              </div>
              <div class="flex items-center">
                <i class="pi pi-phone text-2xl mr-4"></i>
                <div>
                  <p class="font-semibold">{{ t('contact_phone_label') }}</p>
                  <p class="text-indigo-200">{{ t('contact_phone_hours') }}</p>
                </div>
              </div>
              <div class="flex items-center">
                <i class="pi pi-comments text-2xl mr-4"></i>
                <div>
                  <p class="font-semibold">{{ t('contact_chat_label') }}</p>
                  <p class="text-indigo-200">{{ t('contact_chat_desc') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useLocaleStore } from '@/stores/locale';
import { useContactStore } from '@/stores/contact';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Checkbox from 'primevue/checkbox';
import Button from 'primevue/button';
import { useToast } from 'primevue/usetoast';

const router = useRouter();
const { t, currentLocale } = useLocaleStore();
const contactStore = useContactStore();
const toast = useToast();

const formData = ref({
  name: '',
  email: '',
  company: '',
  message: '',
  privacy: false
});

const errors = ref({});
const loading = ref(false);

function getLocalizedUrl(page) {
  const locale = currentLocale;
  const urlMap = {
    privacy: {
      en: '/privacy-policy',
      de: '/de/datenschutz-richtlinie',
      es: '/es/politica-privacidad',
      zh_CN: '/zh_CN/privacy-policy'
    }
  };
  
  return urlMap[page]?.[locale] || urlMap[page]?.en || '#';
}

function validateForm() {
  errors.value = {};
  
  if (!formData.value.name.trim()) {
    errors.value.name = t('contact_error_name_required');
  }
  
  if (!formData.value.email.trim()) {
    errors.value.email = t('contact_error_email_required');
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.value.email)) {
    errors.value.email = t('contact_error_email_invalid');
  }
  
  if (!formData.value.privacy) {
    errors.value.privacy = t('contact_error_privacy_required');
  }
  
  return Object.keys(errors.value).length === 0;
}

async function handleSubmit() {
  if (!validateForm()) {
    return;
  }
  
  loading.value = true;
  
  try {
    await contactStore.submitDemoRequest(formData.value);
    
    // Show success message
    toast.add({
      severity: 'success',
      summary: t('contact_success_title'),
      detail: t('contact_success_message'),
      life: 5000
    });
    
    // Reset form
    formData.value = {
      name: '',
      email: '',
      company: '',
      message: '',
      privacy: false
    };
    
  } catch (error) {
    toast.add({
      severity: 'error',
      summary: t('contact_error_title'),
      detail: t('contact_error_message'),
      life: 5000
    });
  } finally {
    loading.value = false;
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

.animate-float {
  animation: float 20s ease-in-out infinite;
}

@keyframes float {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(30px, -30px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
}
</style>