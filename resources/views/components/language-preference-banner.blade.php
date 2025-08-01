@if(isset($preferredLocale) && isset($currentLocale) && $preferredLocale !== $currentLocale && isset($isRootDomain) && $isRootDomain)
<div id="language-preference-banner" class="fixed top-0 left-0 right-0 bg-blue-600 text-white p-3 shadow-lg" style="z-index: 1000; display: none;">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
            </svg>
            <p class="text-sm md:text-base">
                @if($preferredLocale === 'de')
                    Diese Seite ist auch auf Deutsch verfügbar
                @elseif($preferredLocale === 'es')
                    Esta página también está disponible en español
                @elseif($preferredLocale === 'zh_CN')
                    此页面也有中文版本
                @else
                    This page is available in your language
                @endif
            </p>
        </div>
        <div class="flex items-center space-x-2">
            <a href="/{{ $preferredLocale }}" 
               onclick="setLanguagePreference('{{ $preferredLocale }}')"
               class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors text-sm">
                @if($preferredLocale === 'de')
                    Auf Deutsch wechseln
                @elseif($preferredLocale === 'es')
                    Cambiar a español
                @elseif($preferredLocale === 'zh_CN')
                    切换到中文
                @else
                    Switch Language
                @endif
            </a>
            <button onclick="dismissLanguageBanner('{{ $currentLocale }}')" 
                    class="text-white/80 hover:text-white p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
function dismissLanguageBanner(currentLocale) {
    document.getElementById('language-preference-banner').style.display = 'none';
    // Save current language as user's preference when dismissing banner
    document.cookie = 'user_language_preference=' + currentLocale + '; path=/; max-age=' + (365 * 24 * 60 * 60) + '; SameSite=Lax'; // 1 year
}

function setLanguagePreference(locale) {
    // Set a permanent cookie for language preference
    document.cookie = 'user_language_preference=' + locale + '; path=/; max-age=' + (365 * 24 * 60 * 60) + '; SameSite=Lax'; // 1 year
}

// Check if user has a language preference cookie
function hasLanguagePreference() {
    return document.cookie.split(';').some((item) => item.trim().startsWith('user_language_preference='));
}

// Show banner only if user has no language preference
document.addEventListener('DOMContentLoaded', function() {
    if (!hasLanguagePreference()) {
        const banner = document.getElementById('language-preference-banner');
        if (banner) {
            banner.style.display = 'block';
            // Trigger header spacing adjustment
            if (typeof adjustBodyPadding === 'function') {
                setTimeout(adjustBodyPadding, 100);
            }
        }
    }
});
</script>
@endif