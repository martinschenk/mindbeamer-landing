<!-- FAQ Section -->
<section id="faq" class="bg-white py-16">
    <div class="container mx-auto px-6 fade-in">
        <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-12">{{ __('messages.faq_title') }}</h2>
        
        <div class="max-w-3xl mx-auto space-y-6" x-data="{selected:1}">
            <!-- Question 1 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div 
                    @click="selected !== 1 ? selected = 1 : selected = null"
                    class="flex items-center justify-between p-5 cursor-pointer bg-gray-50 hover:bg-gray-100"
                    :class="{'bg-gray-100': selected === 1}"
                >
                    <h3 class="font-semibold text-lg">{{ __('messages.faq1_question') }}</h3>
                    <span class="text-xl" x-text="selected === 1 ? '−' : '+'"></span>
                </div>
                <div 
                    x-show="selected === 1" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="p-5 border-t border-gray-100"
                >
                    <p class="text-gray-700">{{ __('messages.faq1_answer') }}</p>
                </div>
            </div>
            
            <!-- Question 2 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div 
                    @click="selected !== 2 ? selected = 2 : selected = null"
                    class="flex items-center justify-between p-5 cursor-pointer bg-gray-50 hover:bg-gray-100"
                    :class="{'bg-gray-100': selected === 2}"
                >
                    <h3 class="font-semibold text-lg">{{ __('messages.faq2_question') }}</h3>
                    <span class="text-xl" x-text="selected === 2 ? '−' : '+'"></span>
                </div>
                <div 
                    x-show="selected === 2" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="p-5 border-t border-gray-100"
                >
                    <p class="text-gray-700">{{ __('messages.faq2_answer') }}</p>
                </div>
            </div>
            
            <!-- Question 3 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div 
                    @click="selected !== 3 ? selected = 3 : selected = null"
                    class="flex items-center justify-between p-5 cursor-pointer bg-gray-50 hover:bg-gray-100"
                    :class="{'bg-gray-100': selected === 3}"
                >
                    <h3 class="font-semibold text-lg">{{ __('messages.faq3_question') }}</h3>
                    <span class="text-xl" x-text="selected === 3 ? '−' : '+'"></span>
                </div>
                <div 
                    x-show="selected === 3" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="p-5 border-t border-gray-100"
                >
                    <p class="text-gray-700">{{ __('messages.faq3_answer') }}</p>
                </div>
            </div>
            
            <!-- Question 4 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div 
                    @click="selected !== 4 ? selected = 4 : selected = null"
                    class="flex items-center justify-between p-5 cursor-pointer bg-gray-50 hover:bg-gray-100"
                    :class="{'bg-gray-100': selected === 4}"
                >
                    <h3 class="font-semibold text-lg">{{ __('messages.faq4_question') }}</h3>
                    <span class="text-xl" x-text="selected === 4 ? '−' : '+'"></span>
                </div>
                <div 
                    x-show="selected === 4" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="p-5 border-t border-gray-100"
                >
                    <p class="text-gray-700">{{ __('messages.faq4_answer') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
