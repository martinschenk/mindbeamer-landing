<!-- Problem Section -->
<section id="problem" class="bg-gray-50 py-20">
    <div class="container mx-auto px-6 fade-in">
        <h2 class="text-3xl md:text-5xl font-bold text-center mb-12 text-gray-900">
            {{ __('messages.problem_title') }}
        </h2>
        
        <!-- Problems Grid -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="space-y-6">
                <div class="flex items-start space-x-4 bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition">
                    <span class="text-red-500 text-3xl flex-shrink-0">❌</span>
                    <div>
                        <p class="text-lg text-gray-800">
                            <span class="font-bold">{{ __('messages.problem1') }}</span>
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4 bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition">
                    <span class="text-red-500 text-3xl flex-shrink-0">❌</span>
                    <div>
                        <p class="text-lg text-gray-800">
                            <span class="font-bold">{{ __('messages.problem2') }}</span>
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4 bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition">
                    <span class="text-red-500 text-3xl flex-shrink-0">❌</span>
                    <div>
                        <p class="text-lg text-gray-800">
                            <span class="font-bold">{{ __('messages.problem3') }}</span>
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4 bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition">
                    <span class="text-red-500 text-3xl flex-shrink-0">❌</span>
                    <div>
                        <p class="text-lg text-gray-800">
                            <span class="font-bold">{{ __('messages.problem4') }}</span>
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4 bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition">
                    <span class="text-red-500 text-3xl flex-shrink-0">❌</span>
                    <div>
                        <p class="text-lg text-gray-800">
                            <span class="font-bold">{{ __('messages.problem5') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Cost Section -->
        <div class="bg-red-50 border-2 border-red-200 rounded-2xl p-10 max-w-4xl mx-auto">
            <h3 class="text-2xl md:text-3xl font-bold mb-8 text-red-900 text-center">
                {{ __('messages.problem_cost_title') }}
            </h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="flex items-start">
                    <div class="bg-red-100 rounded-full p-2 mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-700 font-medium">{{ __('messages.problem_cost1') }}</p>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-red-100 rounded-full p-2 mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-700 font-medium">{{ __('messages.problem_cost2') }}</p>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-red-100 rounded-full p-2 mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <p class="text-gray-700 font-medium">{{ __('messages.problem_cost3') }}</p>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-red-100 rounded-full p-2 mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-700 font-medium">{{ __('messages.problem_cost4') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Transition Arrow to Solution -->
        <div class="text-center mt-12">
            <svg class="w-12 h-12 text-gray-400 mx-auto animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>