<!-- Invisible anchor target for menu navigation -->
<span id="how-it-works" class="invisible block" style="position: relative; top: -40px; height: 1px;"></span>

<!-- How It Works Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6 fade-in">
        <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-8 bg-gradient-to-r from-pink-500 via-purple-400 to-teal-400 text-transparent bg-clip-text">{{ __('messages.how_it_works_title') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Step 1 -->
            <div class="text-center bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-pink-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-settings-3-line bg-pink-100 p-4 rounded-full transition-all duration-300 hover:bg-pink-200 hover:scale-110"></i>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('messages.step1_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step1_description') }}</p>
            </div>
            
            <!-- Step 2 -->
            <div class="text-center bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-teal-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-lightbulb-flash-line bg-teal-100 p-4 rounded-full transition-all duration-300 hover:bg-teal-200 hover:scale-110"></i>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('messages.step2_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step2_description') }}</p>
            </div>
            
            <!-- Step 3 -->
            <div class="text-center bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-pink-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-file-edit-line bg-pink-100 p-4 rounded-full transition-all duration-300 hover:bg-pink-200 hover:scale-110"></i>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('messages.step3_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step3_description') }}</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Step 4 -->
            <div class="text-center bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-teal-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-edit-line bg-teal-100 p-4 rounded-full transition-all duration-300 hover:bg-teal-200 hover:scale-110"></i>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('messages.step4_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step4_description') }}</p>
            </div>
            
            <!-- Step 5 -->
            <div class="text-center bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-pink-500 text-4xl mb-4 flex justify-center">
                    <i class="ri-rocket-line bg-pink-100 p-4 rounded-full transition-all duration-300 hover:bg-pink-200 hover:scale-110"></i>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('messages.step5_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.step5_description') }}</p>
            </div>
        </div>
        
        <div class="text-center mt-14">
            <a href="#contact" class="btn-primary bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold py-4 px-8 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:from-pink-600 hover:to-purple-600">{{ __('messages.hero_cta') }}</a>
        </div>
    </div>
</section>
