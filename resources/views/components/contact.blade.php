<!-- Invisible anchor target for menu navigation -->
<span id="contact" class="invisible block" style="position: relative; top: -40px; height: 1px;"></span>

<!-- Contact/Demo Section -->
<section class="bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 py-16 text-white">
    <div class="container mx-auto px-6 fade-in text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">{{ __('messages.demo_title') }}</h2>
        <p class="text-xl max-w-3xl mx-auto mb-10">
            {{ __('messages.demo_subtitle') }}
        </p>
        
        <div class="max-w-md mx-auto">
            <form id="demo-form" action="{{ route('api.request-demo') }}" method="POST" class="space-y-6">
                @csrf
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <input type="email" id="email" name="email" placeholder="{{ __('messages.your_email') }}" 
                           class="py-3 px-6 rounded-full flex-grow text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                    <button type="submit" class="btn-primary bg-pink-600 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-pink-700">
                        {{ __('messages.ask_for_demo') }}
                    </button>
                </div>
                
                <!-- Marketing-Einwilligung -->
                <div class="mt-4 flex items-center justify-center">
                    <label class="flex items-center text-white text-sm">
                        <input type="checkbox" name="marketing_consent" id="marketing_consent" class="form-checkbox mr-2 h-4 w-4 text-pink-500 focus:ring-pink-500">
                        <span>{{ __('messages.marketing_consent_text') }}</span>
                    </label>
                </div>
                
                <div id="form-success" class="hidden bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 text-white p-6 rounded-lg shadow-lg border-l-4 border-white" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="font-semibold">{{ __('messages.form_success') }}</p>
                    </div>
                </div>
                
                <div id="form-error" class="hidden bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                    <p>{{ __('messages.form_error') }}</p>
                </div>
            </form>
            
            <p class="text-sm mt-4">{{ __('messages.demo_note') }}</p>
        </div>
    </div>
</section>
