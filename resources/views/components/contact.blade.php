<!-- Invisible anchor target for menu navigation -->
<span id="contact" class="invisible block" style="position: relative; top: -40px; height: 1px;"></span>

<!-- Contact/Demo Section -->
<section class="bg-gradient-to-br from-indigo-600 via-indigo-500 to-blue-600 py-20 text-white">
    <div class="container mx-auto px-6 fade-in">
        <!-- Main CTA -->
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">{{ __('messages.demo_title') }}</h2>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto mb-8 text-indigo-50">
                {{ __('messages.demo_subtitle') }}
            </p>
        </div>
        
        <!-- What You'll See -->
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 max-w-4xl mx-auto mb-12">
            <h3 class="text-2xl font-bold mb-6 text-center">{{ __('messages.demo_what_you_see') }}</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-emerald-400 mt-1 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p>{{ __('messages.demo_benefit1') }}</p>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-emerald-400 mt-1 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p>{{ __('messages.demo_benefit2') }}</p>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-emerald-400 mt-1 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p>{{ __('messages.demo_benefit3') }}</p>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-emerald-400 mt-1 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p>{{ __('messages.demo_benefit4') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Demo Badges -->
        <div class="flex flex-wrap justify-center gap-6 mb-12">
            <div class="text-center">
                <span class="text-3xl mb-2">🎯</span>
                <p class="font-semibold">{{ __('messages.demo_personal') }}</p>
            </div>
            <div class="text-center">
                <span class="text-3xl mb-2">📅</span>
                <p class="font-semibold">{{ __('messages.demo_available') }}</p>
            </div>
            <div class="text-center">
                <span class="text-3xl mb-2">💯</span>
                <p class="font-semibold">{{ __('messages.demo_no_pressure') }}</p>
            </div>
            <div class="text-center">
                <span class="text-3xl mb-2">🔒</span>
                <p class="font-semibold">{{ __('messages.demo_see_results') }}</p>
            </div>
        </div>
        
        <!-- Form -->
        <div class="max-w-xl mx-auto">
            <form id="demo-form" action="{{ route('api.request-demo') }}" method="POST" class="space-y-6">
                @csrf
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <input type="email" id="email" name="email" placeholder="{{ __('messages.your_email') }}" 
                           class="py-4 px-6 rounded-lg flex-grow text-gray-900 text-lg focus:outline-none focus:ring-4 focus:ring-white/50" required>
                    <button type="submit" class="bg-white text-indigo-600 hover:bg-gray-100 font-bold py-4 px-8 rounded-lg shadow-xl transform transition hover:scale-105 hover:shadow-2xl text-lg">
                        {{ __('messages.ask_for_demo') }}
                    </button>
                </div>
                
                <!-- Marketing-Einwilligung -->
                <div class="mt-4 flex items-center justify-center">
                    <label class="flex items-center text-white/90 text-sm">
                        <input type="checkbox" name="marketing_consent" id="marketing_consent" class="form-checkbox mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-400 rounded">
                        <span>{{ __('messages.marketing_consent_text') }}</span>
                    </label>
                </div>
                
                <div id="form-success" class="hidden bg-white/20 backdrop-blur-sm border border-white/30 text-white p-6 rounded-lg shadow-lg" role="alert">
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
            
            <!-- Trust Line -->
            <p class="text-sm mt-8 text-center text-indigo-100 leading-relaxed">
                {{ __('messages.demo_note') }}
            </p>
        </div>
        
        <!-- Demo Preview Video Placeholder -->
        <div class="mt-16 bg-gray-200 rounded-xl p-12 text-center max-w-4xl mx-auto">
            <p class="text-gray-600 font-medium">
                [DEMO-PREVIEW-VIDEO]: 30-second preview video showing <span translate="no">MindBeamer</span> in action. Split screen: left shows business owner inputting their company info, right shows the AI creating posts in real-time. Shows posts being published across LinkedIn, Facebook, Instagram. Ends with happy business owner looking at increased engagement stats.
            </p>
        </div>
    </div>
</section>
