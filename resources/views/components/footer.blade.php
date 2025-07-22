<!-- Footer -->
<footer class="bg-gray-900 text-white py-8 w-full overflow-hidden">
    <div class="container mx-auto px-6 text-center w-full">
        <p class="mb-2">&copy; 2025 <span translate="no">MindBeamer</span>. {{ __('messages.all_rights_reserved') }}</p>
        
        <!-- Links -->
        {{-- Verwendet LocalizedUrlHelper für sprachspezifische URLs --}}
        {{-- Beispiel: /de/datenschutz-richtlinie statt /de/privacy-policy --}}
        <div class="flex flex-wrap justify-center mt-4 mb-4 gap-4 md:gap-6 px-2">
            <a href="{{ \App\Helpers\LocalizedUrlHelper::privacyUrl() }}" class="text-gray-400 hover:text-indigo-400 transition-colors">
                {{ __('messages.footer_privacy') }}
            </a>
            <a href="{{ \App\Helpers\LocalizedUrlHelper::impressumUrl() }}" class="text-gray-400 hover:text-indigo-400 transition-colors">
                {{ __('legal.impressum_title') }}
            </a>
            <a href="{{ \App\Helpers\LocalizedUrlHelper::termsUrl() }}" class="text-gray-400 hover:text-indigo-400 transition-colors">
                {{ __('legal.terms_title') }}
            </a>
            <a href="javascript:void(0);" onclick="window.openCookieSettings()" class="text-gray-400 hover:text-indigo-400 transition-colors">
                {{ __('messages.cookie_settings') }}
            </a>
        </div>
        
        <!-- Language Switcher -->
        {{-- Language Switcher behält die aktuelle Seite bei und wechselt nur die Sprache --}}
        {{-- LocalizedUrlHelper::currentPageInLocale() erkennt automatisch die richtige URL --}}
        <div class="flex justify-center space-x-4">
            <div class="flex items-center space-x-2">
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('en') }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'en' ? 'font-bold text-white' : '' }}">EN</a>
                <span class="text-gray-500">|</span>
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('de') }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'de' ? 'font-bold text-white' : '' }}">DE</a>
                <span class="text-gray-500">|</span>
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('es') }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'es' ? 'font-bold text-white' : '' }}">ES</a>
                <span class="text-gray-500">|</span>
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('zh_CN') }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'zh_CN' ? 'font-bold text-white' : '' }}">ZH</a>
            </div>
        </div>
    </div>
</footer>
