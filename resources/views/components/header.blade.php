<!-- Header -->
<header class="bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 shadow fixed top-0 w-full z-20" x-data="{ open: false }">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="text-3xl font-bold text-white">MindBeamer</a>
        <nav class="hidden md:flex space-x-8">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#how-it-works" class="text-white hover:text-gray-200 font-medium">{{ __('messages.nav_how_it_works') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#features" class="text-white hover:text-gray-200 font-medium">{{ __('messages.nav_features') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#why-us" class="text-white hover:text-gray-200 font-medium">{{ __('messages.nav_why_us') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#contact" class="text-white hover:text-gray-200 font-medium">{{ __('messages.nav_demo') }}</a>
            <div class="flex items-center space-x-2">
                @php
                    $currentRoute = request()->route()->getName();
                    $currentParams = request()->route()->parameters();
                    unset($currentParams['locale']); // Remove current locale to replace it
                @endphp
                <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'en'])) }}" class="text-white hover:text-gray-200 font-medium {{ app()->getLocale() == 'en' ? 'font-bold underline' : '' }}">EN</a>
                <span class="text-white">|</span>
                <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'de'])) }}" class="text-white hover:text-gray-200 font-medium {{ app()->getLocale() == 'de' ? 'font-bold underline' : '' }}">DE</a>
                <span class="text-white">|</span>
                <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'es'])) }}" class="text-white hover:text-gray-200 font-medium {{ app()->getLocale() == 'es' ? 'font-bold underline' : '' }}">ES</a>
            </div>
        </nav>
        <button class="md:hidden" @click="open = !open">
            <i class="ri-menu-line text-2xl text-white"></i>
        </button>
    </div>
    <!-- Mobile menu -->
    <div class="md:hidden" x-show="open" @click.away="open = false">
        <nav class="bg-white px-6 pb-4 space-y-4">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#how-it-works" class="block text-gray-700 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium">{{ __('messages.nav_how_it_works') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#features" class="block text-gray-700 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium">{{ __('messages.nav_features') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#why-us" class="block text-gray-700 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium">{{ __('messages.nav_why_us') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#contact" class="block text-gray-700 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium">{{ __('messages.nav_demo') }}</a>
            <div class="flex items-center space-x-2 pt-2 border-t">
                @php
                    $currentRoute = request()->route()->getName();
                    $currentParams = request()->route()->parameters();
                    unset($currentParams['locale']); // Remove current locale to replace it
                @endphp
                <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'en'])) }}" class="text-gray-700 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium {{ app()->getLocale() == 'en' ? 'font-bold' : '' }}">EN</a>
                <span class="text-gray-500">|</span>
                <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'de'])) }}" class="text-gray-700 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium {{ app()->getLocale() == 'de' ? 'font-bold' : '' }}">DE</a>
                <span class="text-gray-500">|</span>
                <a href="{{ route($currentRoute, array_merge($currentParams, ['locale' => 'es'])) }}" class="text-gray-700 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium {{ app()->getLocale() == 'es' ? 'font-bold' : '' }}">ES</a>
            </div>
        </nav>
    </div>
</header>
