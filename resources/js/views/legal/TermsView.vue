<template>
  <div class="container mx-auto px-6 pt-24 pb-16">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-3xl md:text-4xl font-bold text-center mb-12 bg-gradient-to-r from-primary-600 to-primary-800 text-transparent bg-clip-text" style="line-height: 1.5;">
        {{ t('terms_title') }}
      </h1>
      
      <div class="bg-white rounded-lg shadow-lg p-8 md:p-12 space-y-8">
        <!-- Introduction -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('terms_introduction_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('terms_introduction') }}</p>
            <p><strong>{{ t('last_updated') }}:</strong> {{ new Date().toLocaleDateString(currentLocale) }}</p>
          </div>
        </section>

        <!-- Service Description -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('service_description_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('service_description') }}</p>
          </div>
        </section>

        <!-- User Obligations -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('user_obligations_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('user_obligations_intro') }}</p>
            <ul class="list-disc list-inside space-y-2 ml-4">
              <li>{{ t('user_obligation_1') }}</li>
              <li>{{ t('user_obligation_2') }}</li>
              <li>{{ t('user_obligation_3') }}</li>
              <li>{{ t('user_obligation_4') }}</li>
            </ul>
          </div>
        </section>

        <!-- Intellectual Property -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('intellectual_property_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('intellectual_property') }}</p>
          </div>
        </section>

        <!-- Limitation of Liability -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('liability_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('liability_limitation') }}</p>
          </div>
        </section>

        <!-- Data Protection -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('data_protection_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>
              {{ t('data_protection') }} 
              <router-link 
                :to="getPrivacyPolicyUrl()"
                class="text-primary hover:text-primary-700 underline"
              >
                {{ t('privacy_policy_link') }}
              </router-link>.
            </p>
          </div>
        </section>

        <!-- Termination -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('termination_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('termination') }}</p>
          </div>
        </section>

        <!-- Applicable Law -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('applicable_law_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('applicable_law') }}</p>
          </div>
        </section>

        <!-- Changes to Terms -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('changes_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('changes_to_terms') }}</p>
          </div>
        </section>

        <!-- Contact -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('contact_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('contact_for_questions') }}</p>
            <div class="bg-gray-50 p-4 rounded-lg">
              <p><strong>Martin Schenk S.L.</strong></p>
              <p>Calle Claudio Coello 14, 5G</p>
              <p>28001 Madrid, España</p>
              <p><strong>{{ t('vat_number') }}:</strong> ESB84645654</p>
              <p><strong>{{ t('phone') }}:</strong> <a href="tel:+34669686832" class="text-primary hover:text-primary-700">(+34) 669 686 832</a></p>
              <p>{{ t('email') }}: <a href="mailto:m.schenk@mindbeamer.io" class="text-primary hover:text-primary-700">m.schenk@mindbeamer.io</a></p>
            </div>
          </div>
        </section>
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

// Custom translation function for legal namespace
const t = (key) => {
  const legalTranslations = window.__APP_DATA__?.legalTranslations || {};
  return legalTranslations[key] || key;
};

// Get localized privacy policy URL
const getPrivacyPolicyUrl = () => {
  const urlMap = {
    en: '/privacy-policy',
    de: '/de/datenschutz-richtlinie',
    es: '/es/politica-privacidad',
    zh_CN: '/zh_CN/privacy-policy'
  };
  return urlMap[currentLocale.value] || '/privacy-policy';
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