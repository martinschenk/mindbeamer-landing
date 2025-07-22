import { computed, ref, onMounted, onUnmounted, watch, nextTick } from 'vue';
import { storeToRefs } from 'pinia';
import { useUIStore } from '@/stores/ui';

export function useHeaderOffset() {
  const uiStore = useUIStore();
  const { languageBannerVisible } = storeToRefs(uiStore);
  
  const headerOffset = ref(0);
  const totalOffset = ref(80); // Default header height
  
  function updateOffsets() {
    const banner = document.getElementById('language-preference-banner');
    const header = document.querySelector('header');
    
    let bannerHeight = 0;
    let headerHeight = 80; // Default
    
    if (banner && languageBannerVisible.value) {
      bannerHeight = banner.offsetHeight;
    }
    
    if (header) {
      headerHeight = header.offsetHeight;
    }
    
    headerOffset.value = bannerHeight;
    totalOffset.value = bannerHeight + headerHeight;
  }
  
  // Watch for language banner visibility changes
  watch(languageBannerVisible, async () => {
    await nextTick();
    updateOffsets();
  });
  
  onMounted(() => {
    updateOffsets();
    window.addEventListener('resize', updateOffsets);
  });
  
  onUnmounted(() => {
    window.removeEventListener('resize', updateOffsets);
  });
  
  return {
    headerOffset: computed(() => headerOffset.value),
    totalOffset: computed(() => totalOffset.value)
  };
}