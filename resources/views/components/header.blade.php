<!-- Header -->
<header class="bg-white shadow-md fixed top-0 w-full z-20 border-b border-gray-100" x-data="{ open: false }">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center w-full">
        <!-- Logo with Diamond Theme Style -->
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="flex items-center space-x-2">
            <!-- MindBeamer Logo Icon -->
            <svg width="32" height="32" viewBox="0 0 40 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="logo-icon">
                <g>
                    <circle cx="5" cy="40" r="6" fill="#6366f1" class="text-primary"></circle>
                    <path d="M5 25 A15 15 0 0 1 20 40 A15 15 0 0 1 5 55" stroke="#6366f1" stroke-width="3" fill="none" class="text-primary"></path>
                    <path d="M5 15 A25 25 0 0 1 30 40 A25 25 0 0 1 5 65" stroke="#6366f1" stroke-width="2" fill="none" class="text-primary" opacity="0.7"></path>
                    <path d="M5 5 A35 35 0 0 1 40 40 A35 35 0 0 1 5 75" stroke="#6366f1" stroke-width="2" fill="none" class="text-primary" opacity="0.4"></path>
                </g>
            </svg>
            <div class="text-2xl font-bold">
                <span class="text-indigo-500" style="font-family: 'Inter', sans-serif;">Mind</span><span class="text-gray-900" style="font-family: 'Inter', sans-serif;">Beamer</span>
            </div>
        </a>
        <nav class="hidden lg:flex items-center space-x-8">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#how-it-works" class="text-gray-700 hover:text-indigo-500 font-medium transition-colors">{{ __('messages.nav_how_it_works') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#features" class="text-gray-700 hover:text-indigo-500 font-medium transition-colors">{{ __('messages.nav_features') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#why-us" class="text-gray-700 hover:text-indigo-500 font-medium transition-colors">{{ __('messages.nav_why_us') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#pricing" class="text-gray-700 hover:text-indigo-500 font-medium transition-colors">{{ __('messages.nav_pricing') }}</a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#contact" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors">{{ __('messages.nav_demo') }}</a>
        </nav>
        <button class="lg:hidden" @click="open = !open">
            <i class="ri-menu-line text-2xl text-gray-700"></i>
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
        <nav class="bg-white border-t border-gray-100 shadow-lg px-6 py-6 space-y-5">
            
            <!-- Menu items -->
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#how-it-works" 
               @click="open = false"
               class="block text-gray-700 hover:text-indigo-500 font-medium text-lg py-2 transition-colors">
                {{ __('messages.nav_how_it_works') }}
            </a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#features" 
               @click="open = false"
               class="block text-gray-700 hover:text-indigo-500 font-medium text-lg py-2 transition-colors">
                {{ __('messages.nav_features') }}
            </a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#why-us" 
               @click="open = false"
               class="block text-gray-700 hover:text-indigo-500 font-medium text-lg py-2 transition-colors">
                {{ __('messages.nav_why_us') }}
            </a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#pricing" 
               @click="open = false"
               class="block text-gray-700 hover:text-indigo-500 font-medium text-lg py-2 transition-colors">
                {{ __('messages.nav_pricing') }}
            </a>
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#contact" 
               @click="open = false"
               class="block bg-indigo-500 hover:bg-indigo-600 text-white font-semibold text-center py-3 px-6 rounded-lg transition-colors">
                {{ __('messages.nav_demo') }}
            </a>
        </nav>
    </div>
</header>
