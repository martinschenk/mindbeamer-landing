<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - MindBeamer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col">
    <div class="bg-gradient-to-r from-pink-500 via-purple-500 to-teal-500 py-2">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <a href="/" class="text-white font-bold text-xl">MindBeamer</a>
            </div>
        </div>
    </div>

    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl w-full space-y-8 text-center">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h1 class="section-title text-6xl md:text-7xl font-bold mb-4 bg-gradient-to-r from-pink-500 via-purple-400 to-teal-400 text-transparent bg-clip-text">
                    @yield('code')
                </h1>
                <h2 class="text-2xl md:text-3xl font-bold mb-6 text-gray-700">
                    @yield('title')
                </h2>
                <div class="text-lg text-gray-600 mb-8">
                    @yield('message')
                </div>
                <div class="mt-8">
                    <a href="/" class="bg-white text-pink-600 border border-pink-600 hover:bg-pink-50 font-medium rounded-md px-6 py-3 transition duration-300 ease-in-out">
                        {{ __('messages.return_home') }}
                    </a>
                </div>
                <div class="mt-8 text-sm text-gray-500">
                    <p>{{ __('messages.error_incident_id') }}: {{ Str::uuid() }}</p>
                </div>
            </div>
            <div class="mt-6">
                <div class="inline-flex items-center space-x-1">
                    @foreach(['en', 'de', 'es'] as $locale)
                        <a href="{{ request()->url() }}?lang={{ $locale }}" class="px-3 py-1 {{ app()->getLocale() == $locale ? 'bg-pink-100 text-pink-800' : 'bg-gray-100 text-gray-700' }} rounded-md text-sm font-medium">
                            {{ strtoupper($locale) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-100 py-8">
        <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
            <p>© {{ date('Y') }} MindBeamer.io. {{ __('messages.all_rights_reserved') }}</p>
        </div>
    </footer>
</body>
</html>
