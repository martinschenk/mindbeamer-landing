<!-- Invisible anchor target for menu navigation -->
<span id="pricing" class="invisible block" style="position: relative; top: -40px; height: 1px;"></span>

<!-- Pricing Section -->
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6 fade-in">
        <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12 bg-gradient-to-r from-pink-500 via-purple-400 to-teal-400 text-transparent bg-clip-text">{{ __('messages.pricing_title') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Light Plan -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:scale-105">
                <div class="p-8 text-center">
                    <h3 class="text-2xl font-bold mb-2">{{ __('messages.light_plan') }}</h3>
                    <p class="text-gray-600 mb-6">{{ __('messages.light_plan_subtitle') }}</p>
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-pink-500">€15</span>
                        <span class="text-gray-600">/{{ __('messages.month') }}</span>
                    </div>
                    <ul class="text-left space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.light_feature1') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.light_feature2') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.light_feature3') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.light_feature4') }}</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full bg-gray-200 text-gray-800 font-semibold py-3 rounded-full hover:bg-gray-300 transition">{{ __('messages.request_demo_button') }}</a>
                </div>
            </div>
            
            <!-- Standard Plan -->
            <div class="bg-white rounded-lg shadow-xl overflow-hidden transform transition-transform hover:scale-105 border-2 border-pink-500 relative">
                <div class="bg-pink-500 text-white text-center py-2 absolute w-full">
                    <span class="font-semibold">{{ __('messages.most_popular') }}</span>
                </div>
                <div class="p-8 text-center pt-16">
                    <h3 class="text-2xl font-bold mb-2">{{ __('messages.standard_plan') }}</h3>
                    <p class="text-gray-600 mb-6">{{ __('messages.standard_plan_subtitle') }}</p>
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-pink-500">€49</span>
                        <span class="text-gray-600">/{{ __('messages.month') }}</span>
                    </div>
                    <ul class="text-left space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.standard_feature1') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.standard_feature2') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.standard_feature3') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.standard_feature4') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.standard_feature5') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.standard_feature6') }}</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full bg-pink-500 text-white font-semibold py-3 rounded-full hover:bg-pink-600 transition">{{ __('messages.request_demo_button') }}</a>
                </div>
            </div>
            
            <!-- News Portal Plan -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:scale-105">
                <div class="p-8 text-center">
                    <h3 class="text-2xl font-bold mb-2">{{ __('messages.news_plan') }}</h3>
                    <p class="text-gray-600 mb-6">{{ __('messages.news_plan_subtitle') }}</p>
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-pink-500">€75</span>
                        <span class="text-gray-600">/{{ __('messages.month') }}</span>
                    </div>
                    <ul class="text-left space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.news_feature1') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.news_feature2') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.news_feature3') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.news_feature4') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.news_feature5') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-check-line text-teal-500 mr-2 text-xl"></i>
                            <span>{{ __('messages.news_feature6') }}</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full bg-gray-200 text-gray-800 font-semibold py-3 rounded-full hover:bg-gray-300 transition">{{ __('messages.request_demo_button') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
