<!-- Invisible anchor target for menu navigation -->
<span id="pricing" class="invisible block" style="position: relative; top: -40px; height: 1px;"></span>

<!-- Pricing Section -->
<section class="bg-white py-20">
    <div class="container mx-auto px-6 fade-in">
        <h2 class="text-3xl md:text-5xl font-bold text-center mb-16 text-gray-900">{{ __('messages.pricing_title') }}</h2>
        
        <!-- ROI Calculator Message -->
        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6 max-w-3xl mx-auto mb-12 text-center">
            <p class="text-lg font-semibold text-indigo-900">💡 {{ __('messages.pricing_simple_math') }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Professional Plan -->
            <div class="bg-gray-50 rounded-2xl shadow-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-xl">
                <div class="p-8">
                    <div class="text-center">
                        <span class="text-2xl mb-2">🚀</span>
                        <h3 class="text-2xl font-bold mb-2 text-gray-900">{{ __('messages.light_plan') }}</h3>
                        <p class="text-gray-600 mb-6">{{ __('messages.light_plan_subtitle') }}</p>
                        <div class="mb-6">
                            <span class="text-5xl font-black text-gray-900">{{ __('messages.light_plan_price') }}</span>
                            <span class="text-gray-600">/{{ __('messages.month') }}</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('messages.light_feature1') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('messages.light_feature2') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('messages.light_feature3') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 font-semibold">{{ __('messages.light_feature4') }}</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-4 rounded-lg transition text-center">{{ __('messages.request_demo_button') }}</a>
                </div>
            </div>
            
            <!-- Business Growth Plan -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all hover:scale-105 border-2 border-indigo-500 relative">
                <div class="bg-indigo-500 text-white text-center py-3 absolute w-full z-10">
                    <span class="font-bold text-sm">⭐ {{ __('messages.most_popular') }}</span>
                </div>
                <div class="p-8 pt-16">
                    <div class="text-center">
                        <span class="text-2xl mb-2">⭐</span>
                        <h3 class="text-2xl font-bold mb-2 text-gray-900">{{ __('messages.standard_plan') }}</h3>
                        <p class="text-gray-600 mb-6">{{ __('messages.standard_plan_subtitle') }}</p>
                        <div class="mb-6">
                            <span class="text-5xl font-black text-gray-900">{{ __('messages.standard_plan_price') }}</span>
                            <span class="text-gray-600">/{{ __('messages.month') }}</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('messages.standard_feature1') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('messages.standard_feature2') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('messages.standard_feature3') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 font-semibold">{{ __('messages.standard_feature4') }}</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-4 rounded-lg transition text-center shadow-lg">{{ __('messages.request_demo_button') }}</a>
                </div>
            </div>
            
            <!-- Market Leader Plan -->
            <div class="bg-gray-50 rounded-2xl shadow-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-xl">
                <div class="p-8">
                    <div class="text-center">
                        <span class="text-2xl mb-2">🏆</span>
                        <h3 class="text-2xl font-bold mb-2 text-gray-900">{{ __('messages.news_plan') }}</h3>
                        <p class="text-gray-600 mb-6">{{ __('messages.news_plan_subtitle') }}</p>
                        <div class="mb-6">
                            <span class="text-5xl font-black text-gray-900">{{ __('messages.news_plan_price') }}</span>
                            <span class="text-gray-600">/{{ __('messages.month') }}</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('messages.news_feature1') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('messages.news_feature2') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700">{{ __('messages.news_feature3') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 font-semibold">{{ __('messages.news_feature4') }}</span>
                        </li>
                    </ul>
                    <a href="#contact" class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-4 rounded-lg transition text-center">{{ __('messages.request_demo_button') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
