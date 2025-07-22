<template>
  <div v-if="showModal || showSettingsModal">
    <!-- Cookie Banner -->
    <Dialog 
      v-model:visible="showModal" 
      modal
      :closable="false"
      :draggable="false"
      :style="{ width: '90vw', maxWidth: '500px' }"
      :pt="{
        root: { class: 'border-0' },
        header: { class: 'pb-0' },
        content: { class: 'pb-4' }
      }"
    >
      <template #header>
        <div class="flex flex-col gap-2 w-full">
          <h3 class="text-2xl font-bold text-surface-900">{{ t('cookie-consent.banner_title') }}</h3>
          <p class="text-surface-600 text-base font-normal">{{ t('cookie-consent.banner_description') }}</p>
        </div>
      </template>
      
      <template #footer>
        <div class="flex flex-col sm:flex-row flex-wrap gap-3 justify-center sm:justify-end">
          <Button 
            @click="acceptAll" 
            :label="t('cookie-consent.accept_all')"
            severity="warning"
            size="large"
            icon="pi pi-check"
            iconPos="right"
            class="font-semibold w-full sm:w-auto px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-200"
          />
          <Button 
            @click="declineAll" 
            :label="t('cookie-consent.reject_all')"
            severity="secondary"
            size="large"
            class="w-full sm:w-auto px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg shadow-md hover:shadow-lg transition-all duration-200"
          />
          <Button 
            @click="showSettings" 
            :label="t('cookie-consent.settings')"
            outlined
            size="large"
            class="text-surface-700 w-full sm:w-auto px-6 py-3 border-2 border-gray-300 hover:border-gray-400 hover:bg-gray-50 rounded-lg transition-all duration-200"
          />
        </div>
      </template>
    </Dialog>
    
    <!-- Cookie Settings Modal -->
    <Dialog 
      v-model:visible="showSettingsModal" 
      modal
      :dismissableMask="true"
      :style="{ width: '90vw', maxWidth: '600px' }"
      :pt="{
        root: { class: 'border-0' },
        header: { class: 'pb-4' },
        content: { class: 'pb-4' }
      }"
    >
      <template #header>
        <h3 class="text-2xl font-bold text-surface-900">{{ t('cookie-consent.banner_title') }}</h3>
      </template>
      <div class="space-y-4 mt-6">
        <!-- Analytics Cookies -->
        <div class="diamond-card">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <h4 class="font-semibold text-surface-900">{{ t('cookie-consent.analytics_title') }}</h4>
              <p class="text-sm text-surface-600 mt-1">{{ t('cookie-consent.analytics_description') }}</p>
            </div>
            <div class="ml-4">
              <ToggleSwitch 
                v-model="consent.analytics"
                :pt="{
                  slider: { class: consent.analytics ? 'bg-primary-500' : 'bg-surface-200' }
                }"
              />
            </div>
          </div>
        </div>
        
        <!-- Preference Cookies -->
        <div class="diamond-card">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <h4 class="font-semibold text-surface-900">{{ t('cookie-consent.preferences_title') }}</h4>
              <p class="text-sm text-surface-600 mt-1">{{ t('cookie-consent.preferences_description') }}</p>
            </div>
            <div class="ml-4">
              <ToggleSwitch 
                v-model="consent.preferences"
                :pt="{
                  slider: { class: consent.preferences ? 'bg-primary-500' : 'bg-surface-200' }
                }"
              />
            </div>
          </div>
        </div>
        
        <!-- Essential Cookies -->
        <div class="diamond-card">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <h4 class="font-semibold text-surface-900">{{ t('cookie-consent.essential_title') }}</h4>
              <p class="text-sm text-surface-600 mt-1">{{ t('cookie-consent.essential_description') }}</p>
            </div>
            <div class="ml-4">
              <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                {{ t('cookie-consent.active') }}
              </span>
            </div>
          </div>
        </div>
      </div>
      
      <template #footer>
        <div class="flex justify-end gap-3">
          <Button 
            @click="cancelSettings" 
            :label="t('cookie-consent.cancel')"
            severity="secondary"
            size="large"
            outlined
            class="px-6 py-3 border-2 border-gray-300 hover:border-gray-400 hover:bg-gray-50 text-gray-700 rounded-lg transition-all duration-200"
          />
          <Button 
            @click="saveSettings" 
            :label="t('cookie-consent.save_settings')"
            severity="warning"
            size="large"
            icon="pi pi-save"
            iconPos="right"
            class="font-semibold px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-200"
          />
        </div>
      </template>
    </Dialog>
  </div>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useCookieConsentStore } from '@/stores/cookieConsent';
import { useLocaleStore } from '@/stores/locale';
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import ToggleSwitch from 'primevue/toggleswitch';

const cookieConsentStore = useCookieConsentStore();
const localeStore = useLocaleStore();

const { showModal, showSettingsModal, consent } = storeToRefs(cookieConsentStore);
const { acceptAll, declineAll, showSettings, cancelSettings, saveSettings } = cookieConsentStore;

// Use locale store's translation function
const { t } = localeStore;
</script>

<style scoped>
/* Ensure button visibility and proper styling */
:deep(.p-button) {
  font-weight: 600;
  text-transform: none;
  transition: all 0.2s ease;
}

:deep(.p-button:not(.p-button-outlined)) {
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

:deep(.p-button:not(.p-button-outlined):hover) {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transform: translateY(-1px);
}

:deep(.p-button.p-button-outlined) {
  background-color: white;
}

:deep(.p-button.p-button-outlined:hover) {
  background-color: rgba(0, 0, 0, 0.02);
}

/* Dialog footer padding for better button spacing */
:deep(.p-dialog-footer) {
  padding: 1.25rem;
  background-color: #f9fafb;
}

/* Diamond card style for settings */
.diamond-card {
  padding: 1.25rem;
  background: white;
  border: 1px solid #e5e7eb;
  border-radius: 0.75rem;
  transition: all 0.2s ease;
}

.diamond-card:hover {
  border-color: #d1d5db;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}
</style>