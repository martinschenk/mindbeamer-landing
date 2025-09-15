<template>
  <div class="privacy-policy-page">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 py-12">
      <!-- Header -->
      <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 text-transparent bg-clip-text mb-6" style="line-height: 1.5;">
          {{ t('title') }}
        </h1>
        <p class="text-surface-600 text-lg">
          {{ t('last_updated') }}: {{ new Date().toLocaleDateString(currentLocale) }}
        </p>
      </div>

      <!-- Content -->
      <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
        <!-- GDPR Compliance Badge -->
        <div class="mb-8 p-4 bg-gradient-to-r from-green-50 to-blue-50 rounded-lg border border-green-200">
          <div class="flex items-center">
            <i class="pi pi-shield text-2xl text-green-600 mr-3"></i>
            <div>
              <h3 class="text-lg font-semibold text-surface-900">{{ t('gdpr_compliant', 'messages') }}</h3>
              <p class="text-sm text-surface-600">{{ t('gdpr_notice') }}</p>
            </div>
          </div>
        </div>
        
        <div class="prose prose-lg max-w-none">
          <!-- Company Information -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ t('company_info_title') }}</h2>
            <div class="bg-gray-50 p-4 rounded-lg">
              <p><strong>{{ t('company_name') }}:</strong> Martin Schenk S.L.</p>
              <p><strong>{{ t('address') }}:</strong> Calle Claudio Coello 14, 5G, 28001 Madrid, España</p>
              <p><strong>{{ t('vat_number', 'legal') }}:</strong> ESB84645654</p>
              <p><strong>{{ t('phone', 'legal') }}:</strong> <a href="tel:+34669686832" class="text-primary hover:text-primary-700">(+34) 669 686 832</a></p>
              <p><strong>{{ t('contact') }}:</strong> m.schenk@mindbeamer.io</p>
            </div>
          </section>

          <!-- Data Collection -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ t('data_collection_title') }}</h2>
            <p class="mb-4">{{ t('data_collection_desc') }}</p>
            <ul class="list-disc pl-6 space-y-2">
              <li>{{ t('data_contact_forms') }}</li>
              <li>{{ t('data_cookies') }}</li>
              <li>{{ t('data_analytics') }}</li>
            </ul>
          </section>

          <!-- Cookies -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ t('cookies_title') }}</h2>
            <p class="mb-4">{{ t('cookies_desc') }}</p>
            <div class="bg-blue-50 p-6 rounded-lg">
              <h3 class="font-semibold mb-2">{{ t('cookies_types') }}:</h3>
              <ul class="list-disc pl-6 space-y-1">
                <li>{{ t('cookies_necessary') }}</li>
                <li>{{ t('cookies_analytics') }}</li>
                <li>{{ t('cookies_preferences') }}</li>
              </ul>
            </div>
          </section>

          <!-- Your Rights -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ t('rights_title') }}</h2>
            <p class="mb-4">{{ t('rights_desc') }}</p>
            <ul class="list-disc pl-6 space-y-2">
              <li>{{ t('right_access') }}</li>
              <li>{{ t('right_rectification') }}</li>
              <li>{{ t('right_erasure') }}</li>
              <li>{{ t('right_portability') }}</li>
              <li>{{ t('right_object') }}</li>
            </ul>
          </section>

          <!-- Contact -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ t('contact_title') }}</h2>
            <p class="mb-4">{{ t('contact_desc') }}</p>
            <div class="bg-gradient-to-r from-primary-50 to-primary-100 p-6 rounded-lg">
              <p class="font-semibold">{{ t('contact_email') }}: m.schenk@mindbeamer.io</p>
            </div>
          </section>
        </div>
      </div>

      <!-- Back to Home -->
      <div class="text-center mt-12">
        <router-link
          :to="currentLocale === 'en' ? '/' : `/${currentLocale}`"
          class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition-colors duration-200"
        >
          <i class="pi pi-arrow-left mr-2"></i>
          {{ localeStore.t('footer_home') }}
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useLocaleStore } from '@/stores/locale';
import { useUIStore } from '@/stores/ui';
import { storeToRefs } from 'pinia';

const localeStore = useLocaleStore();
const uiStore = useUIStore();
const { currentLocale } = storeToRefs(localeStore);

// Custom translation function for privacy namespace
const t = (key, namespace = 'privacy') => {
  const translations = window.__APP_DATA__?.translations || {};
  
  if (namespace === 'privacy') {
    // For privacy namespace, check privacy translations
    const privacyTranslations = window.__APP_DATA__?.privacyTranslations || {};
    return privacyTranslations[key] || key;
  } else if (namespace === 'legal') {
    // For legal namespace
    const legalTranslations = window.__APP_DATA__?.legalTranslations || {};
    return legalTranslations[key] || key;
  } else {
    // Default to messages
    return translations[key] || key;
  }
};

// Fix mobile menu and font issues on mount
onMounted(() => {
  // Ensure mobile menu is closed
  uiStore.closeMobileMenu();

  // Force font to be applied (prevent Inter fallback)
  const logoElements = document.querySelectorAll('.logo-text');
  logoElements.forEach(el => {
    el.style.fontFamily = 'Poppins, sans-serif';
    el.style.fontWeight = '300';
  });
});
</script>