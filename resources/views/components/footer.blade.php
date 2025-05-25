<!-- Footer -->
<footer class="bg-gray-900 text-white py-8 w-full overflow-hidden">
    <div class="container mx-auto px-6 text-center w-full">
        <p class="mb-2">&copy; 2025 <a href="https://martin-schenk.es" class="text-teal-400 hover:underline">Martin Schenk S.L.</a> {{ __('messages.all_rights_reserved') }}</p>
        
        <!-- Links -->
        <div class="flex flex-wrap justify-center mt-4 mb-4 gap-4 md:gap-6 px-2">
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
            <div class="flex items-center space-x-2 text-blue-500">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zm0 18a8 8 0 100-16 8 8 0 000 16zm0-8a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-medium">{{ __('messages.privacy_first') }}</span>
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
