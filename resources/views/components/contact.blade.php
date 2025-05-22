<!-- Contact/Demo Section -->
<section id="contact" class="bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 py-16 text-white">
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
                
                <div id="form-success" class="hidden bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                    <p>{{ __('messages.form_success') }}</p>
                </div>
                
                <div id="form-error" class="hidden bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                    <p>{{ __('messages.form_error') }}</p>
                </div>
            </form>
            
            <p class="text-sm mt-4">{{ __('messages.demo_note') }}</p>
        </div>
    </div>
</section>
