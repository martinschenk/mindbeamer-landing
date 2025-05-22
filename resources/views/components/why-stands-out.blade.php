<!-- Why MindBeamer Stands Out Section -->
<section id="why-us" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="section-title text-3xl md:text-4xl font-bold text-center mb-6 bg-gradient-to-r from-pink-500 via-purple-400 to-teal-400 text-transparent bg-clip-text">{{ __('messages.why_stands_out_title') }}</h2>
        
        <p class="text-lg text-center text-gray-700 max-w-4xl mx-auto mb-16">
            {{ __('messages.why_stands_out_subtitle') }}
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- vs Jasper -->
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <h3 class="text-xl font-semibold mb-4">{{ __('messages.vs_jasper_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.vs_jasper_description') }}</p>
            </div>
            
            <!-- vs Buffer/Hootsuite -->
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <h3 class="text-xl font-semibold mb-4">{{ __('messages.vs_buffer_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.vs_buffer_description') }}</p>
            </div>
            
            <!-- vs ContentStudio -->
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <h3 class="text-xl font-semibold mb-4">{{ __('messages.vs_contentstudio_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.vs_contentstudio_description') }}</p>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <p class="text-xl mb-8">{{ __('messages.ready_to_see') }}</p>
            <a href="#contact" class="btn-primary bg-gradient-to-r from-pink-500 to-purple-600 text-white px-8 py-3 rounded-full font-medium hover:from-pink-600 hover:to-purple-700 transition duration-300">{{ __('messages.ask_for_demo') }}</a>
        </div>
    </div>
</section>
