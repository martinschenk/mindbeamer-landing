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
          <h3 class="text-lg font-semibold">{{ t('cookie-consent.banner_title') }}</h3>
          <p class="text-gray-700 text-sm font-normal">{{ t('cookie-consent.banner_description') }}</p>
        </div>
      </template>
      
      <template #footer>
        <div class="flex flex-wrap gap-2 justify-end">
          <Button 
            @click="acceptAll" 
            :label="t('cookie-consent.accept_all')"
            severity="primary"
            size="small"
          />
          <Button 
            @click="declineAll" 
            :label="t('cookie-consent.reject_all')"
            severity="secondary"
            size="small"
          />
          <Button 
            @click="showSettings" 
            :label="t('cookie-consent.settings')"
            outlined
            size="small"
          />
        </div>
      </template>
    </Dialog>
    
    <!-- Cookie Settings Modal -->
    <Dialog 
      v-model:visible="showSettingsModal" 
      modal
      :header="t('cookie-consent.banner_title')"
      :style="{ width: '90vw', maxWidth: '600px' }"
      :pt="{
        header: { 
          class: 'bg-gradient-to-r from-indigo-500 via-purple-400 to-teal-400 text-transparent bg-clip-text' 
        }
      }"
    >
      <div class="space-y-4 mt-6">
        <!-- Analytics Cookies -->
        <div class="border border-gray-200 rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div>
              <h4 class="font-semibold">{{ t('cookie-consent.analytics_title') }}</h4>
              <p class="text-sm text-gray-600 mt-1">{{ t('cookie-consent.analytics_description') }}</p>
            </div>
            <div class="ml-4">
              <ToggleSwitch 
                v-model="consent.analytics"
                :pt="{
                  slider: { class: consent.analytics ? 'bg-indigo-500' : 'bg-gray-200' }
                }"
              />
            </div>
          </div>
        </div>
        
        <!-- Preference Cookies -->
        <div class="border border-gray-200 rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div>
              <h4 class="font-semibold">{{ t('cookie-consent.preferences_title') }}</h4>
              <p class="text-sm text-gray-600 mt-1">{{ t('cookie-consent.preferences_description') }}</p>
            </div>
            <div class="ml-4">
              <ToggleSwitch 
                v-model="consent.preferences"
                :pt="{
                  slider: { class: consent.preferences ? 'bg-indigo-500' : 'bg-gray-200' }
                }"
              />
            </div>
          </div>
        </div>
        
        <!-- Essential Cookies -->
        <div class="border border-gray-200 rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div>
              <h4 class="font-semibold">{{ t('cookie-consent.essential_title') }}</h4>
              <p class="text-sm text-gray-600 mt-1">{{ t('cookie-consent.essential_description') }}</p>
            </div>
            <div class="ml-4">
              <span class="inline-block px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded">
                {{ t('cookie-consent.active') }}
              </span>
            </div>
          </div>
        </div>
      </div>
      
      <template #footer>
        <Button 
          @click="saveSettings" 
          :label="t('cookie-consent.save_settings')"
          severity="primary"
          size="small"
        />
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