<template>
  <div class="container mx-auto px-6 pt-24 pb-24">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-3xl md:text-4xl font-bold text-center mb-12 bg-gradient-to-r from-primary-600 to-primary-800 text-transparent bg-clip-text leading-relaxed">
        {{ t('impressum_title') }}
      </h1>
      
      <div class="bg-white rounded-lg shadow-lg p-8 md:p-12 space-y-8">
        <!-- Company Information -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('company_info') }}
          </h2>
          <div class="space-y-3 text-surface-700">
            <p><strong>{{ t('company_name') }}:</strong> Martin Schenk S.L.</p>
            <p><strong>{{ t('represented_by') }}:</strong> Martin Schenk</p>
            <p><strong>{{ t('address') }}:</strong></p>
            <div class="ml-4">
              <p>Calle Claudio Coello 14, 5G</p>
              <p>28001 Madrid</p>
              <p>España</p>
            </div>
          </div>
        </section>

        <!-- Contact Information -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('contact_info') }}
          </h2>
          <div class="space-y-3 text-surface-700">
            <p><strong>{{ t('email') }}:</strong> <a href="mailto:m.schenk@mindbeamer.io" class="text-primary hover:text-primary-700">m.schenk@mindbeamer.io</a></p>
            <p><strong>{{ t('phone') }}:</strong> <a href="tel:+34669686832" class="text-primary hover:text-primary-700">(+34) 669 686 832</a></p>
            <p><strong>{{ t('website') }}:</strong> <a href="https://mindbeamer.io" class="text-primary hover:text-primary-700">https://mindbeamer.io</a></p>
          </div>
        </section>

        <!-- VAT Information -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('tax_info') }}
          </h2>
          <div class="space-y-3 text-surface-700">
            <p><strong>{{ t('vat_number') }}:</strong> ESB84645654</p>
            <p><strong>{{ t('tax_office') }}:</strong> Madrid, España</p>
          </div>
        </section>

        <!-- Responsible for Content -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('content_responsibility') }}
          </h2>
          <div class="space-y-3 text-surface-700">
            <p><strong>{{ t('responsible_person') }}:</strong> Martin Schenk</p>
            <p><strong>{{ t('address') }}:</strong> Calle Claudio Coello 14, 5G, 28001 Madrid, España</p>
            <p><strong>{{ t('phone') }}:</strong> <a href="tel:+34669686832" class="text-primary hover:text-primary-700">(+34) 669 686 832</a></p>
            <p><strong>{{ t('email') }}:</strong> <a href="mailto:m.schenk@mindbeamer.io" class="text-primary hover:text-primary-700">m.schenk@mindbeamer.io</a></p>
          </div>
        </section>

        <!-- Disclaimer -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('disclaimer_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('disclaimer_content') }}</p>
            <p>{{ t('disclaimer_liability') }}</p>
          </div>
        </section>

        <!-- Copyright -->
        <section>
          <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
            {{ t('copyright_title') }}
          </h2>
          <div class="space-y-4 text-surface-700">
            <p>{{ t('copyright_content') }}</p>
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
import { useLocaleStore } from '@/stores/locale';
import { storeToRefs } from 'pinia';

const localeStore = useLocaleStore();
const { currentLocale } = storeToRefs(localeStore);

// Custom translation function for legal namespace
const t = (key) => {
  const legalTranslations = window.__APP_DATA__?.legalTranslations || {};
  return legalTranslations[key] || key;
};
</script>