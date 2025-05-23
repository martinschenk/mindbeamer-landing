<!-- Hero Section -->
<section id="hero" class="bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 text-white pt-36 pb-20">
    <div class="container mx-auto px-6 text-center fade-in">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ __('messages.hero_title') }}</h1>
        <p class="text-xl md:text-2xl mb-12 max-w-3xl mx-auto">
            {{ __('messages.hero_subtitle') }}
        </p>
        <div class="flex flex-col md:flex-row justify-center gap-4">
            <a href="#contact" class="btn-primary bg-white text-pink-600 font-semibold py-4 px-8 rounded-full shadow-lg hover:bg-gray-100">{{ __('messages.hero_cta') }}</a>
        </div>
        
        <!-- Trust Badges -->
        <div class="flex justify-center items-center space-x-6 mt-8 opacity-90">
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
                <span>{{ __('messages.ssl_secured') }}</span>
            </div>
        </div>
    </div>
</section>
