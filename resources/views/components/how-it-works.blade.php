<!-- Invisible anchor target for menu navigation -->
<span id="how-it-works" class="invisible block" style="position: relative; top: -40px; height: 1px;"></span>

<!-- How It Works Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6 fade-in">
        <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-6 bg-gradient-to-r from-pink-500 via-purple-400 to-teal-400 text-transparent bg-clip-text">{{ __('messages.how_it_works_title') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div class="text-center">
                <div class="text-pink-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-settings-3-line bg-pink-100 p-4 rounded-full"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">{{ __('messages.step1_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step1_description') }}</p>
            </div>
            <div class="text-center">
                <div class="text-teal-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-lightbulb-flash-line bg-teal-100 p-4 rounded-full"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">{{ __('messages.step2_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step2_description') }}</p>
            </div>
            <div class="text-center">
                <div class="text-pink-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-file-edit-line bg-pink-100 p-4 rounded-full"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">{{ __('messages.step3_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step3_description') }}</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="text-center">
                <div class="text-teal-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-edit-line bg-teal-100 p-4 rounded-full"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">{{ __('messages.step4_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step4_description') }}</p>
            </div>
            <div class="text-center">
                <div class="text-pink-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-rocket-line bg-pink-100 p-4 rounded-full"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">{{ __('messages.step5_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step5_description') }}</p>
            </div>
        </div>
        <div class="text-center mt-12">
            <a href="#contact" class="btn-primary bg-pink-500 text-white font-semibold py-4 px-8 rounded-full shadow-lg hover:bg-pink-600">{{ __('messages.hero_cta') }}</a>
        </div>
    </div>
</section>
