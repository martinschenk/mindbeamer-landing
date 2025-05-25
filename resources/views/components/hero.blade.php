<!-- Hero Section -->
<section id="hero" class="bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 text-white pt-36 pb-20">
    <div class="container mx-auto px-6 text-center fade-in w-full">
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
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zm0 18a8 8 0 100-16 8 8 0 000 16zm0-8a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                </svg>
                <span>{{ __('messages.privacy_first') }}</span>
            </div>
        </div>
    </div>
</section>
