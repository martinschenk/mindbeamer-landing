<!-- Invisible anchor target for menu navigation -->
<span id="how-it-works" class="invisible block" style="position: relative; top: -40px; height: 1px;"></span>

<!-- How It Works Section -->
<section class="bg-white py-20">
    <div class="container mx-auto px-6 fade-in">
        <h2 class="text-3xl md:text-5xl font-bold text-center mb-16 text-gray-900">{{ __('messages.how_it_works_title') }}</h2>
        
        <!-- Steps Container -->
        <div class="max-w-5xl mx-auto">
            <!-- Step 1 -->
            <div class="flex flex-col md:flex-row items-center mb-16">
                <div class="md:w-1/3 mb-6 md:mb-0">
                    <div class="bg-emerald-100 rounded-full p-8 inline-flex items-center justify-center">
                        <span class="text-5xl">⚡</span>
                    </div>
                </div>
                <div class="md:w-2/3 md:pl-8">
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">{{ __('messages.step1_title') }}</h3>
                    <p class="text-lg text-gray-700">{{ __('messages.step1_description') }}</p>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="flex flex-col md:flex-row-reverse items-center mb-16">
                <div class="md:w-1/3 mb-6 md:mb-0">
                    <div class="bg-blue-100 rounded-full p-8 inline-flex items-center justify-center">
                        <span class="text-5xl">🚀</span>
                    </div>
                </div>
                <div class="md:w-2/3 md:pr-8">
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">{{ __('messages.step2_title') }}</h3>
                    <p class="text-lg text-gray-700 mb-4">{{ __('messages.step2_description') }}</p>
                    
                    <!-- Business Type Content Examples -->
                    <div class="bg-gray-50 rounded-lg p-6 space-y-4">
                        <div>
                            <p class="font-semibold text-gray-800 mb-2">{{ __('messages.step2_product') }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 mb-2">{{ __('messages.step2_service') }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 mb-2">{{ __('messages.step2_local') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="flex flex-col md:flex-row items-center mb-16">
                <div class="md:w-1/3 mb-6 md:mb-0">
                    <div class="bg-emerald-100 rounded-full p-8 inline-flex items-center justify-center">
                        <span class="text-5xl">✋</span>
                    </div>
                </div>
                <div class="md:w-2/3 md:pl-8">
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">{{ __('messages.step3_title') }}</h3>
                    <p class="text-lg text-gray-700">{{ __('messages.step3_description') }}</p>
                </div>
            </div>
            
            <!-- Step 4 -->
            <div class="flex flex-col md:flex-row-reverse items-center mb-16">
                <div class="md:w-1/3 mb-6 md:mb-0">
                    <div class="bg-blue-100 rounded-full p-8 inline-flex items-center justify-center">
                        <span class="text-5xl">📈</span>
                    </div>
                </div>
                <div class="md:w-2/3 md:pr-8">
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">{{ __('messages.step4_title') }}</h3>
                    <p class="text-lg text-gray-700">{{ __('messages.step4_description') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Result Box -->
        <div class="bg-gradient-to-r from-emerald-50 to-blue-50 rounded-2xl p-8 max-w-4xl mx-auto text-center">
            <p class="text-xl font-semibold text-gray-800">
                {{ __('messages.how_it_works_result') }}
            </p>
        </div>
        
        <div class="text-center mt-12">
            <a href="#contact" class="inline-flex items-center justify-center bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-5 px-10 rounded-lg shadow-xl transform transition hover:scale-105 hover:shadow-2xl text-lg">
                {{ __('messages.hero_cta') }}
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
