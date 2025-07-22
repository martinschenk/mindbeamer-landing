<template>
  <section id="roi-calculator" class="py-20 bg-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="absolute inset-0" :style="{ backgroundImage: patternBackground, backgroundSize: '40px 40px' }"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
          {{ t('roi_headline') }}
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          {{ t('roi_subheadline') }}
        </p>
      </div>
      
      <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
          <div class="grid grid-cols-1 lg:grid-cols-2">
            <!-- Calculator Inputs -->
            <div class="p-8 lg:p-12 bg-gray-50">
              <h3 class="text-2xl font-bold text-gray-900 mb-8">{{ t('roi_input_title') }}</h3>
              
              <div class="space-y-6">
                <!-- Hours per Week -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ t('roi_hours_label') }}
                  </label>
                  <div class="flex items-center space-x-4">
                    <Slider 
                      v-model="inputs.hoursPerWeek" 
                      :min="1" 
                      :max="40" 
                      class="flex-1"
                    />
                    <InputNumber 
                      v-model="inputs.hoursPerWeek" 
                      :min="1" 
                      :max="40"
                      class="w-20"
                      showButtons
                      buttonLayout="vertical"
                    />
                  </div>
                  <p class="text-xs text-gray-500 mt-1">{{ t('roi_hours_help') }}</p>
                </div>
                
                <!-- Hourly Rate -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ t('roi_rate_label') }}
                  </label>
                  <div class="flex items-center space-x-4">
                    <Slider 
                      v-model="inputs.hourlyRate" 
                      :min="20" 
                      :max="200" 
                      :step="10"
                      class="flex-1"
                    />
                    <InputNumber 
                      v-model="inputs.hourlyRate" 
                      :min="20" 
                      :max="200"
                      mode="currency" 
                      currency="USD" 
                      locale="en-US"
                      class="w-32"
                    />
                  </div>
                  <p class="text-xs text-gray-500 mt-1">{{ t('roi_rate_help') }}</p>
                </div>
                
                <!-- Team Size -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ t('roi_team_label') }}
                  </label>
                  <div class="flex items-center space-x-4">
                    <Slider 
                      v-model="inputs.teamSize" 
                      :min="1" 
                      :max="20" 
                      class="flex-1"
                    />
                    <InputNumber 
                      v-model="inputs.teamSize" 
                      :min="1" 
                      :max="20"
                      class="w-20"
                      showButtons
                      buttonLayout="vertical"
                    />
                  </div>
                  <p class="text-xs text-gray-500 mt-1">{{ t('roi_team_help') }}</p>
                </div>
                
                <!-- Conversion Rate Improvement -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ t('roi_conversion_label') }}
                  </label>
                  <SelectButton 
                    v-model="inputs.conversionImprovement" 
                    :options="conversionOptions" 
                    optionLabel="label" 
                    optionValue="value"
                    class="w-full"
                  />
                  <p class="text-xs text-gray-500 mt-1">{{ t('roi_conversion_help') }}</p>
                </div>
              </div>
            </div>
            
            <!-- Results -->
            <div class="p-8 lg:p-12 bg-gradient-to-br from-indigo-600 to-purple-600 text-white">
              <h3 class="text-2xl font-bold mb-8">{{ t('roi_results_title') }}</h3>
              
              <!-- Monthly Savings -->
              <div class="mb-8">
                <p class="text-lg mb-2 text-indigo-200">{{ t('roi_monthly_savings') }}</p>
                <p class="text-5xl font-bold">${{ monthlyTimeSavings.toLocaleString() }}</p>
                <p class="text-sm text-indigo-200 mt-1">{{ t('roi_time_saved', { hours: hoursSaved }) }}</p>
              </div>
              
              <!-- Annual ROI -->
              <div class="mb-8">
                <p class="text-lg mb-2 text-indigo-200">{{ t('roi_annual_return') }}</p>
                <p class="text-5xl font-bold">${{ annualROI.toLocaleString() }}</p>
                <p class="text-sm text-indigo-200 mt-1">{{ roiPercentage }}% {{ t('roi_return_rate') }}</p>
              </div>
              
              <!-- Break Even -->
              <div class="mb-8">
                <p class="text-lg mb-2 text-indigo-200">{{ t('roi_break_even') }}</p>
                <p class="text-3xl font-bold">{{ breakEvenDays }} {{ t('roi_days') }}</p>
              </div>
              
              <!-- CTA -->
              <div class="mt-10">
                <Button 
                  :label="t('roi_cta')"
                  severity="warning"
                  size="large"
                  class="w-full"
                  @click="scrollToDemo"
                  icon="pi pi-arrow-right"
                  iconPos="right"
                />
                <p class="text-sm text-indigo-200 text-center mt-4">{{ t('roi_disclaimer') }}</p>
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
import { useLocaleStore } from '@/stores/locale';
import Slider from 'primevue/slider';
import InputNumber from 'primevue/inputnumber';
import SelectButton from 'primevue/selectbutton';
import Button from 'primevue/button';

const { t } = useLocaleStore();

// Calculator inputs
const inputs = ref({
  hoursPerWeek: 10,
  hourlyRate: 50,
  teamSize: 3,
  conversionImprovement: 20
});

const conversionOptions = [
  { label: '10%', value: 10 },
  { label: '20%', value: 20 },
  { label: '30%', value: 30 },
  { label: '50%', value: 50 }
];

// Pattern background
const patternBackground = computed(() => {
  return `url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%236366f1' fill-opacity='0.4'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E")`;
});

// Calculations
const hoursSaved = computed(() => {
  // Assume MindBeamer saves 70% of social media management time
  return Math.round(inputs.value.hoursPerWeek * 0.7 * inputs.value.teamSize);
});

const monthlyTimeSavings = computed(() => {
  return Math.round(hoursSaved.value * 4.33 * inputs.value.hourlyRate);
});

const annualROI = computed(() => {
  const annualSavings = monthlyTimeSavings.value * 12;
  const conversionBoost = annualSavings * (inputs.value.conversionImprovement / 100);
  return Math.round(annualSavings + conversionBoost);
});

const roiPercentage = computed(() => {
  // Assuming $149/month subscription
  const annualCost = 149 * 12;
  return Math.round((annualROI.value / annualCost - 1) * 100);
});

const breakEvenDays = computed(() => {
  const monthlyCost = 149;
  const dailySavings = monthlyTimeSavings.value / 30;
  return Math.max(1, Math.round(monthlyCost / dailySavings));
});

function scrollToDemo() {
  const element = document.querySelector('#contact');
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
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
</style>