<!-- Hero Section -->
<section id="hero" class="relative bg-gradient-to-br from-indigo-600 via-indigo-500 to-blue-600 text-white pt-36 pb-24 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" xmlns="http://www.w3.org/2000/svg"%3E%3Cdefs%3E%3Cpattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse"%3E%3Cpath d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1" opacity="0.3"/%3E%3C/pattern%3E%3C/defs%3E%3Crect width="100%25" height="100%25" fill="url(%23grid)"/%3E%3C/svg%3E')"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
        <!-- Credibility Bar -->
        <div class="text-center mb-8 animate-fade-in">
            <p class="text-indigo-100 text-sm md:text-base font-medium">
                {{ __('messages.hero_credibility') }}
            </p>
        </div>
        
        <!-- Main Content -->
        <div class="text-center fade-in w-full">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight">
                {{ __('messages.hero_title') }}
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto text-indigo-50 leading-relaxed">
                {{ __('messages.hero_subtitle') }}
            </p>
            
            <!-- Save Time Badge -->
            <div class="mb-10">
                <span class="inline-block bg-white/20 backdrop-blur-sm text-white px-6 py-2 rounded-full text-lg font-semibold shadow-lg border border-white/30">
                    ⏰ {{ __('messages.hero_save_time') }}
                </span>
                <p class="text-indigo-100 mt-3 text-sm italic">
                    {{ __('messages.hero_stop_posting') }}
                </p>
            </div>
            
            <!-- CTA Button -->
            <div class="flex flex-col md:flex-row justify-center gap-4 mb-12">
                <a href="#contact" class="inline-flex items-center justify-center bg-white text-indigo-600 hover:bg-gray-100 font-bold py-5 px-10 rounded-lg shadow-xl transform transition hover:scale-105 hover:shadow-2xl text-lg">
                    {{ __('messages.hero_cta') }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Target Badges -->
            <div class="grid md:grid-cols-3 gap-4 max-w-4xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 transform transition hover:scale-105 hover:bg-white/20">
                    <div class="text-3xl mb-3">🏭</div>
                    <p class="text-sm font-semibold">{{ __('messages.hero_target_product') }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 transform transition hover:scale-105 hover:bg-white/20">
                    <div class="text-3xl mb-3">💼</div>
                    <p class="text-sm font-semibold">{{ __('messages.hero_target_service') }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 transform transition hover:scale-105 hover:bg-white/20">
                    <div class="text-3xl mb-3">🏪</div>
                    <p class="text-sm font-semibold">{{ __('messages.hero_target_local') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Trust Badges -->
        <div class="flex justify-center items-center space-x-6 mt-12 opacity-90">
            <div class="flex items-center space-x-2 text-white/80 text-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ __('messages.gdpr_compliant') }}</span>
            </div>
            <div class="flex items-center space-x-2 text-white/80 text-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
                <span>{{ __('messages.privacy_first') }}</span>
            </div>
        </div>
    </div>
</section>
