<!-- Footer -->
<footer class="bg-gray-900 text-white py-8">
    <div class="container mx-auto px-6 text-center">
        <p class="mb-2">&copy; 2025 <a href="https://martin-schenk.es" class="text-teal-400 hover:underline">Martin Schenk S.L.</a> {{ __('messages.all_rights_reserved') }}</p>
        
        <!-- Links -->
        <div class="flex justify-center space-x-6 mt-4 mb-4">
            <a href="{{ route('privacy.policy', ['locale' => app()->getLocale()]) }}" class="text-gray-400 hover:text-teal-400 transition-colors">
                {{ __('cookie-consent.policy_links.privacy_policy') }}
            </a>
            <a href="{{ route('legal.impressum', ['locale' => app()->getLocale()]) }}" class="text-gray-400 hover:text-teal-400 transition-colors">
                {{ __('legal.impressum_title') }}
            </a>
            <a href="{{ route('legal.terms', ['locale' => app()->getLocale()]) }}" class="text-gray-400 hover:text-teal-400 transition-colors">
                {{ __('legal.terms_title') }}
            </a>
            <button onclick="showCookieSettings()" class="text-gray-400 hover:text-teal-400 transition-colors cursor-pointer">
                {{ __('cookie-consent.policy_links.cookie_settings') }}
            </button>
        </div>
        
        <!-- GDPR & Security Badges -->
        <div class="flex justify-center items-center space-x-6 mt-4 mb-4">
            <div class="flex items-center space-x-2 text-green-400">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium">{{ __('messages.gdpr_compliant') }}</span>
            </div>
            <div class="flex items-center space-x-2 text-blue-400">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium">{{ __('messages.ssl_secured') }}</span>
            </div>
        </div>
        
        <!-- Language Switcher -->
        <div class="flex justify-center space-x-4">
            <div class="flex items-center space-x-2">
                @php
                    $currentRoute = request()->route()->getName();
                    $currentParams = request()->route()->parameters();
                    unset($currentParams['locale']); // Remove current locale to replace it
                @endphp
                <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'en'])) }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'en' ? 'font-bold text-white' : '' }}">EN</a>
                <span class="text-gray-500">|</span>
                <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'de'])) }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'de' ? 'font-bold text-white' : '' }}">DE</a>
                <span class="text-gray-500">|</span>
                <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'es'])) }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'es' ? 'font-bold text-white' : '' }}">ES</a>
            </div>
        </div>
    </div>
</footer>
