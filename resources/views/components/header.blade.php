<!-- Header -->
<header class="bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 shadow fixed top-0 w-full z-20" x-data="{ open: false }">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center w-full">
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="text-3xl font-bold text-white" style="font-family: 'Poppins', sans-serif;">MindBeamer</a>
        <nav class="hidden lg:flex space-x-8">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#how-it-works" class="text-white hover:text-gray-200 font-medium">{{ __('messages.nav_how_it_works') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#features" class="text-white hover:text-gray-200 font-medium">{{ __('messages.nav_features') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#why-us" class="text-white hover:text-gray-200 font-medium">{{ __('messages.nav_why_us') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#pricing" class="text-white hover:text-gray-200 font-medium">{{ __('messages.nav_pricing') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#contact" class="text-white hover:text-gray-200 font-medium">{{ __('messages.nav_demo') }}</a>
            {{-- Desktop Language Switcher (ohne Chinesisch wie gewünscht) --}}
            <div class="flex items-center space-x-2">
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('en') }}" class="text-white hover:text-gray-200 font-medium {{ app()->getLocale() == 'en' ? 'font-bold underline' : '' }}">EN</a>
                <span class="text-white">|</span>
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('de') }}" class="text-white hover:text-gray-200 font-medium {{ app()->getLocale() == 'de' ? 'font-bold underline' : '' }}">DE</a>
                <span class="text-white">|</span>
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('es') }}" class="text-white hover:text-gray-200 font-medium {{ app()->getLocale() == 'es' ? 'font-bold underline' : '' }}">ES</a>
            </div>
        </nav>
        <button class="lg:hidden" @click="open = !open">
            <i class="ri-menu-line text-2xl text-white"></i>
        </button>
    </div>
    <!-- Mobile menu with animations -->
    <div class="lg:hidden overflow-hidden" 
         x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-4"
         @click.away="open = false">
        <nav class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 shadow-xl px-6 py-6 space-y-5 relative overflow-hidden">
            <!-- Animated background effect -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNOCAwSDE2TDAgMTZWOEw4IDBaIiBmaWxsPSJyZ2JhKDIzNiwgNzIsIDE1MywgMC4wMikiLz48L3N2Zz4=')] opacity-30"></div>
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 animate-gradient-x"></div>
            
            <!-- Menu items with animated gradient hover effect -->
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#how-it-works" 
               @click="open = false"
               class="block text-white hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium text-lg py-2 transform transition-all duration-300 hover:translate-x-2 relative group">
                <span class="absolute left-0 w-0 h-full border-b-2 border-pink-500 group-hover:w-full transition-all duration-300"></span>
                {{ __('messages.nav_how_it_works') }}
            </a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#features" 
               @click="open = false"
               class="block text-white hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium text-lg py-2 transform transition-all duration-300 hover:translate-x-2 relative group">
                <span class="absolute left-0 w-0 h-full border-b-2 border-purple-500 group-hover:w-full transition-all duration-300"></span>
                {{ __('messages.nav_features') }}
            </a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#why-us" 
               @click="open = false"
               class="block text-white hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium text-lg py-2 transform transition-all duration-300 hover:translate-x-2 relative group">
                <span class="absolute left-0 w-0 h-full border-b-2 border-teal-500 group-hover:w-full transition-all duration-300"></span>
                {{ __('messages.nav_why_us') }}
            </a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#pricing" 
               @click="open = false"
               class="block text-white hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium text-lg py-2 transform transition-all duration-300 hover:translate-x-2 relative group">
                <span class="absolute left-0 w-0 h-full border-b-2 border-purple-400 group-hover:w-full transition-all duration-300"></span>
                {{ __('messages.nav_pricing') }}
            </a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#contact" 
               @click="open = false"
               class="block text-white hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500 font-medium text-lg py-2 transform transition-all duration-300 hover:translate-x-2 relative group">
                <span class="absolute left-0 w-0 h-full border-b-2 border-pink-400 group-hover:w-full transition-all duration-300"></span>
                {{ __('messages.nav_demo') }}
            </a>
            
            <!-- Language switcher with glowing effect -->
            {{-- Mobile Language Switcher (ohne Chinesisch, nur im Footer verfügbar) --}}
            <div class="flex items-center space-x-4 pt-4 mt-2 border-t border-gray-700 relative">
                <!-- Animated dot for active language -->
                <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700"></div>
                
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('en') }}" @click="open = false" class="relative text-white font-medium {{ app()->getLocale() == 'en' ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500' : '' }} transition-all duration-300 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500">
                    @if(app()->getLocale() == 'en')
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 animate-pulse"></span>
                    @endif
                    EN
                </a>
                <span class="text-gray-500">|</span>
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('de') }}" @click="open = false" class="relative text-white font-medium {{ app()->getLocale() == 'de' ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500' : '' }} transition-all duration-300 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500">
                    @if(app()->getLocale() == 'de')
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 animate-pulse"></span>
                    @endif
                    DE
                </a>
                <span class="text-gray-500">|</span>
                <a href="{{ \App\Helpers\LocalizedUrlHelper::currentPageInLocale('es') }}" @click="open = false" class="relative text-white font-medium {{ app()->getLocale() == 'es' ? 'font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500' : '' }} transition-all duration-300 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-teal-500">
                    @if(app()->getLocale() == 'es')
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 animate-pulse"></span>
                    @endif
                    ES
                </a>
            </div>
        </nav>
    </div>
    
    <!-- Add animation styles -->
    <style>
        @keyframes gradient-x {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient-x {
            background-size: 200% 200%;
            animation: gradient-x 3s ease infinite;
        }
    </style>
</header>
