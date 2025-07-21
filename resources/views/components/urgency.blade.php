<!-- Urgency Section -->
<section id="urgency" class="bg-yellow-50 py-12">
    <div class="container mx-auto px-6 fade-in">
        <div class="max-w-3xl mx-auto text-center">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <span class="text-4xl mb-4 inline-block">⚡</span>
                <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900">
                    {{ __('messages.urgency_title') }}
                </h3>
                <p class="text-lg text-gray-700 mb-8">
                    {{ __('messages.urgency_subtitle') }}
                </p>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-emerald-50 rounded-lg p-6">
                        <p class="text-3xl font-bold text-emerald-700 mb-2">{{ __('messages.urgency_slots') }}</p>
                        <div class="flex justify-center space-x-1">
                            @for ($i = 0; $i < 12; $i++)
                                @if ($i < 8)
                                    <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                @else
                                    <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                                @endif
                            @endfor
                        </div>
                    </div>
                    
                    <div class="bg-red-50 rounded-lg p-6">
                        <p class="text-3xl font-bold text-red-700 mb-2">{{ __('messages.urgency_waitlist') }}</p>
                        <p class="text-sm text-gray-600">Growing daily...</p>
                    </div>
                </div>
                
                <div class="mt-8">
                    <a href="#contact" class="inline-flex items-center justify-center bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-4 px-8 rounded-lg shadow-xl transform transition hover:scale-105 hover:shadow-2xl">
                        Secure Your Spot Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>