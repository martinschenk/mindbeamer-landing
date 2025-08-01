<template>
  <div class="landing-page">
    <!-- Hero Section -->
    <HeroSection />
    
    <!-- Maria Story Section (NEW) -->
    <MariaStorySection />
    
    <!-- Social Proof Section (Startups Españolas Focus) -->
    <SocialProofSection />
    
    <!-- Problem Section (Psychological Pain Points) -->
    <ProblemSection />
    
    <!-- How It Works (Simplified) -->
    <HowItWorks />
    
    <!-- Features (Business Types) -->
    <FeaturesSection />
    
    <!-- Pricing -->
    <PricingSection />
    
    <!-- Objections Section (NEW) -->
    <ObjectionsSection />
    
    <!-- Final CTA -->
    <FinalCTASection />
    
    <!-- Contact/Demo -->
    <DemoRequestSection />
  </div>
</template>

<script setup>
import HeroSection from '@/components/landing/HeroSection.vue';
import MariaStorySection from '@/components/landing/MariaStorySection.vue';
import SocialProofSection from '@/components/landing/SocialProofSection.vue';
import ProblemSection from '@/components/landing/ProblemSection.vue';
import HowItWorks from '@/components/landing/HowItWorks.vue';
import FeaturesSection from '@/components/landing/FeaturesSection.vue';
import PricingSection from '@/components/landing/PricingSection.vue';
import ObjectionsSection from '@/components/landing/ObjectionsSection.vue';
import FinalCTASection from '@/components/landing/FinalCTASection.vue';
import DemoRequestSection from '@/components/landing/DemoRequestSection.vue';
</script>