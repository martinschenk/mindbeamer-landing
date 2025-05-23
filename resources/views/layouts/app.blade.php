<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('messages.hero_subtitle') }}">
    <meta name="keywords" content="autonomous AI content, automated blog posts, autonomous social media, automated content creation, MindBeamer, free demo">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>MindBeamer - {{ __('messages.hero_title') }}</title>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <!-- Filament Assets -->
    <link rel="stylesheet" href="{{ asset('css/filament/support/support.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filament/notifications/notifications.css') }}">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero-bg { background: linear-gradient(135deg, #EC4899, #9F7AEA, #4ECDC4); }
        .btn-primary { transition: transform 0.2s, background-color 0.3s; }
        .btn-primary:hover { transform: scale(1.05); }
        /* Section title styling moved to app.css */
        .fade-in { animation: fadeIn 1s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    <link rel="canonical" href="https://mindbeamer.io">
    
    @vite(['resources/js/app.js'])
    
    <!-- Filament Scripts - Must be loaded before body -->
    <script src="{{ asset('js/filament/support/support.js') }}"></script>
    <script src="{{ asset('js/filament/notifications/notifications.js') }}"></script>
    <script>
        // Ensure the Filament Notifications is globally available
        document.addEventListener('DOMContentLoaded', function() {
            // Debug if Filament Notifications is available
            if (window.Livewire) {
                // Livewire is available - use it
            } else {
                // Initialize custom notification system silently
            }
            
            if (!window.Notification) {
                // Create a global Notification object if not provided by Filament
                window.Notification = {
                    make: function() {
                        let notification = {
                            _title: '',
                            _body: '',
                            _status: 'info',
                            title: function(title) {
                                this._title = title;
                                return this;
                            },
                            body: function(body) {
                                this._body = body;
                                return this;
                            },
                            success: function() {
                                this._status = 'success';
                                return this;
                            },
                            danger: function() {
                                this._status = 'danger';
                                return this;
                            },
                            warning: function() {
                                this._status = 'warning';
                                return this;
                            },
                            info: function() {
                                this._status = 'info';
                                return this;
                            },
                            send: function() {
                                // Create a notification element
                                const notificationElement = document.createElement('div');
                                notificationElement.className = `notification notification-${this._status} fixed right-4 top-4 z-50 max-w-md rounded-lg p-4 shadow-lg transition-all duration-300 transform translate-y-0 opacity-100`;
                                notificationElement.style.backgroundColor = this._status === 'success' ? '#10B981' : 
                                                                           this._status === 'danger' ? '#EF4444' : 
                                                                           this._status === 'warning' ? '#F59E0B' : '#3B82F6';
                                notificationElement.style.color = 'white';
                                
                                // Add title and body
                                notificationElement.innerHTML = `
                                    <div class="flex items-start">
                                        <div class="shrink-0">
                                            ${this._status === 'success' ? 
                                                '<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' : 
                                                this._status === 'danger' ? 
                                                '<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>' :
                                                '<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'}
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p class="text-sm font-medium">${this._title}</p>
                                            ${this._body ? `<p class="mt-1 text-sm">${this._body}</p>` : ''}
                                        </div>
                                        <div class="ml-4 flex shrink-0">
                                            <button class="inline-flex text-white hover:text-gray-200" onclick="this.parentElement.parentElement.parentElement.remove()">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                `;
                                
                                document.body.appendChild(notificationElement);
                                
                                // Auto-remove after 5 seconds
                                setTimeout(() => {
                                    notificationElement.style.opacity = '0';
                                    notificationElement.style.transform = 'translateY(-20px)';
                                    setTimeout(() => {
                                        notificationElement.remove();
                                    }, 300);
                                }, 5000);
                            }
                        };
                        
                        return notification;
                    }
                };
            }
        });
    </script>
</head>
<body class="bg-gray-50 text-gray-900">

    @include('components.header')

    {{ $slot }}

    @include('components.footer')

    <!-- Filament Notifications Container -->
    <div id="notifications"></div>
</body>
</html>
