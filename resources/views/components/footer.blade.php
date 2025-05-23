<!-- Footer -->
<footer class="bg-gray-900 text-white py-8">
    <div class="container mx-auto px-6 text-center">
        <p class="mb-2">© 2025 MindBeamer.io, {{ __('messages.created_by') }} <a href="#" class="text-teal-400 hover:underline">Martin Schenk</a>. {{ __('messages.all_rights_reserved') }}</p>
        <div class="flex justify-center space-x-4 mt-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('language.switch', ['locale' => 'en']) }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'en' ? 'font-bold text-white' : '' }}">EN</a>
                <span class="text-gray-500">|</span>
                <a href="{{ route('language.switch', ['locale' => 'de']) }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'de' ? 'font-bold text-white' : '' }}">DE</a>
                <span class="text-gray-500">|</span>
                <a href="{{ route('language.switch', ['locale' => 'es']) }}" class="text-gray-400 hover:text-white {{ app()->getLocale() == 'es' ? 'font-bold text-white' : '' }}">ES</a>
            </div>
        </div>
    </div>
</footer>
