<template>
  <div class="landing-page">
    <!-- Hero Section -->
    <HeroSection />
    
    <!-- Social Proof Section -->
    <SocialProofSection />
    
    <!-- Problem Section -->
    <ProblemSection />
    
    <!-- How It Works -->
    <HowItWorks />
    
    <!-- Features -->
    <FeaturesSection />
    
    <!-- Founder Story -->
    <FounderSection />
    
    <!-- Pricing -->
    <PricingSection />
    
    <!-- FAQ -->
    <FaqSection />
    
    <!-- Final CTA -->
    <FinalCTASection />
    
    <!-- Contact/Demo -->
    <DemoRequestSection />
  </div>
</template>

<script setup>
import HeroSection from '@/components/landing/HeroSection.vue';
import SocialProofSection from '@/components/landing/SocialProofSection.vue';
import ProblemSection from '@/components/landing/ProblemSection.vue';
import HowItWorks from '@/components/landing/HowItWorks.vue';
import FeaturesSection from '@/components/landing/FeaturesSection.vue';
import FounderSection from '@/components/landing/FounderSection.vue';
import PricingSection from '@/components/landing/PricingSection.vue';
import FaqSection from '@/components/landing/FaqSection.vue';
import FinalCTASection from '@/components/landing/FinalCTASection.vue';
import DemoRequestSection from '@/components/landing/DemoRequestSection.vue';
</script>