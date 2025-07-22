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
            class="font-semibold w-full sm:w-auto"
          />
          <Button 
            @click="declineAll" 
            :label="t('cookie-consent.reject_all')"
            severity="secondary"
            size="large"
            class="w-full sm:w-auto"
          />
          <Button 
            @click="showSettings" 
            :label="t('cookie-consent.settings')"
            outlined
            size="large"
            class="text-surface-700 w-full sm:w-auto"
          />
        </div>
      </template>
    </Dialog>
    
    <!-- Cookie Settings Modal -->
    <Dialog 
      v-model:visible="showSettingsModal" 
      modal
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
        <div class="flex justify-end">
          <Button 
            @click="saveSettings" 
            :label="t('cookie-consent.save_settings')"
            severity="warning"
            size="large"
            icon="pi pi-save"
            iconPos="right"
            class="font-semibold"
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
const { acceptAll, declineAll, showSettings, saveSettings } = cookieConsentStore;

// Use locale store's translation function
const { t } = localeStore;
</script>