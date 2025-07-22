<template>
  <section id="founder-story" class="py-20 bg-gradient-to-br from-surface-50 to-white relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
      <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Founder Image -->
          <div class="order-2 lg:order-1 fade-in">
            <div class="relative">
              <div class="absolute inset-0 bg-gradient-to-br from-primary-100 to-primary-50 rounded-2xl transform rotate-3"></div>
              <div class="relative bg-white rounded-2xl shadow-xl p-8">
                <div class="text-center">
                  <div class="w-48 h-48 mx-auto mb-6 overflow-hidden rounded-full border-4 border-primary-100 shadow-xl">
                    <picture>
                      <source 
                        srcset="/images/profile-images/martin-schenk-founder-mindbeamer-400x400.webp 1x,
                                /images/profile-images/martin-schenk-founder-mindbeamer-600x600.webp 2x,
                                /images/profile-images/martin-schenk-founder-mindbeamer-800x800.webp 3x" 
                        type="image/webp">
                      <source 
                        srcset="/images/profile-images/martin-schenk-founder-mindbeamer-400x400.jpg 1x,
                                /images/profile-images/martin-schenk-founder-mindbeamer-600x600.jpg 2x,
                                /images/profile-images/martin-schenk-founder-mindbeamer-800x800.jpg 3x" 
                        type="image/jpeg">
                      <img 
                        src="/images/profile-images/martin-schenk-founder-mindbeamer-400x400.jpg" 
                        alt="Martin Schenk - Founder & CEO of MindBeamer - German Software Engineer"
                        class="w-full h-full object-cover object-top"
                        width="400"
                        height="400"
                        loading="lazy"
                      >
                    </picture>
                  </div>
                  <h3 class="text-2xl font-bold text-surface-900 mb-2">Martin Schenk</h3>
                  <p class="text-surface-600">Founder & Developer</p>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Founder Text -->
          <div class="order-1 lg:order-2 fade-in" style="animation-delay: 0.2s;">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-surface-900 mb-4">
              {{ t('founder_headline') }}
            </h2>
            <h3 class="text-xl text-surface-700 mb-8">
              {{ t('founder_subtitle') }}
            </h3>
            
            <div class="space-y-6">
              <div>
                <p class="font-bold text-surface-900 mb-2">{{ t('founder_track_record') }}</p>
                <p class="text-surface-600">{{ t('founder_track_record_text') }}</p>
              </div>
              
              <div>
                <p class="font-bold text-surface-900 mb-2">{{ t('founder_expertise') }}</p>
                <p class="text-surface-600">{{ t('founder_expertise_text') }}</p>
              </div>
              
              <div>
                <p class="font-bold text-surface-900 mb-2">{{ t('founder_why') }}</p>
                <p class="text-surface-600 italic">{{ t('founder_why_text') }}</p>
              </div>
              
              <div class="flex flex-wrap gap-4 mt-8">
                <span class="inline-flex items-center bg-primary-50 text-primary-700 px-4 py-2 rounded-full text-sm font-medium">
                  {{ t('founder_credential1') }}
                </span>
                <span class="inline-flex items-center bg-primary-50 text-primary-700 px-4 py-2 rounded-full text-sm font-medium">
                  {{ t('founder_credential2') }}
                </span>
                <span class="inline-flex items-center bg-primary-50 text-primary-700 px-4 py-2 rounded-full text-sm font-medium">
                  {{ t('founder_credential3') }}
                </span>
              </div>
              
              <div class="mt-8">
                <a 
                  href="https://martin-schenk.es/en" 
                  target="_blank"
                  class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold text-lg group"
                >
                  {{ t('founder_profile_link') }}
                  <i class="pi pi-external-link ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useLocaleStore } from '@/stores/locale';

const { t } = useLocaleStore();
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
</style>