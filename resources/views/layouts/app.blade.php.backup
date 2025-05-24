<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', __('messages.hero_subtitle'))">
    <meta name="keywords" content="autonomous AI content, automated blog posts, autonomous social media, automated content creation, MindBeamer, free demo">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'MindBeamer - ' . __('messages.hero_title'))</title>
    
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
    
    <!-- Styles -->
    @livewireStyles
    <!-- Additional Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @php
        use Devrabiul\CookieConsent\Facades\CookieConsent;
    @endphp
    
    <!-- FilamentPHP App Styles -->
    @filamentStyles
    
    @if(class_exists(\Devrabiul\CookieConsent\Facades\CookieConsent::class))
        {!! CookieConsent::styles() !!}
    @endif
    
    <!-- MindBeamer Cookie Consent Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/cookie-consent-custom.css') }}">
    
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

    @yield('content')
    
    @if(isset($slot))
        {{ $slot }}
    @endif

    @include('components.footer')

    <!-- Filament Notifications Container -->
    <div id="notifications"></div>
    
    @php
        // FORCE OVERRIDE cookie categories to ensure Analytics and Marketing are visible
        $customConfig = app(\App\Services\CookieConsentService::class)->getLocalizedConfig();
        
        // Ensure Analytics and Marketing cookies are always visible in the modal
        $customConfig['cookie_categories']['analytics']['enabled'] = true;
        $customConfig['cookie_categories']['analytics']['visible'] = true;
        $customConfig['cookie_categories']['analytics']['locked'] = false;
        
        $customConfig['cookie_categories']['marketing']['enabled'] = true;
        $customConfig['cookie_categories']['marketing']['visible'] = true;
        $customConfig['cookie_categories']['marketing']['locked'] = false;
    @endphp
    
    @if(class_exists(\Devrabiul\CookieConsent\Facades\CookieConsent::class))
        {!! CookieConsent::scripts($customConfig) !!}
    @endif
    
    <script>
        // Show cookie settings function - ROBUST VERSION
        window.showCookieSettings = function() {
            // Method 1: Look for existing "Manage Preferences" or "Settings" buttons with retry
            const settingsSelectors = [
                '[data-cc="show-preferencesModal"]',
                '[data-role="show-preferences"]', 
                '.cc-btn-preferences',
                '.cc-btn-settings',
                '.cc-customize',
                '.cc-preferences-btn',
                'button[class*="preferences"]',
                'button[class*="settings"]',
                'a[href*="preferences"]'
            ];
            
            // Try multiple times with delays
            let attempts = 0;
            const maxAttempts = 5;
            
            const tryFindButton = () => {
                attempts++;
                
                for (const selector of settingsSelectors) {
                    const buttons = document.querySelectorAll(selector);
                    if (buttons.length > 0) {
                        buttons[0].click();
                        return true;
                    }
                }
                
                // If not found and still have attempts, try again after delay
                if (attempts < maxAttempts) {
                    setTimeout(tryFindButton, 200);
                    return false;
                }
                
                // If all attempts failed, use fallback methods
                return false;
            };
            
            // Start first attempt
            if (tryFindButton()) {
                return;
            }
            
            // Method 2: Try to trigger global cookie consent events (with delay fallback)
            setTimeout(() => {
                const globalEventMethods = [
                    () => window.CookieConsent && window.CookieConsent.showPreferences(),
                    () => window.cookieConsent && window.cookieConsent.showPreferences(),
                    () => window.CC && window.CC.showPreferences(),
                    () => window.showPreferences && window.showPreferences(),
                    () => document.dispatchEvent(new CustomEvent('cc:show-preferences')),
                    () => document.dispatchEvent(new CustomEvent('cookie-consent:show-modal'))
                ];
                
                for (const method of globalEventMethods) {
                    try {
                        method();
                        return;
                    } catch (e) {
                        // Silently continue to next method
                    }
                }
                
                // Method 3: Nuclear option - clear cookies and force reload
                const cookieNames = [
                    'Laravel_App_consent',
                    'Laravel_App_categories',
                    'MindBeamer_consent', 
                    'MindBeamer_categories',
                    'cookie_consent',
                    'laravel_cookie_consent'
                ];
                
                const domains = ['', window.location.hostname, '.' + window.location.hostname];
                
                cookieNames.forEach(name => {
                    domains.forEach(domain => {
                        const domainPart = domain ? `; domain=${domain}` : '';
                        document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/${domainPart}`;
                    });
                });
                
                // Add artificial delay to ensure cookies are cleared
                setTimeout(() => {
                    window.location.href = window.location.pathname + '?show_cookie_banner=1';
                }, 100);
            }, 500);
        };
        
        // Auto-close banner after saving preferences
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                // More specific selectors for save buttons
                const saveSelectors = [
                    '[data-cc="save"]',
                    '.cc-save-btn', 
                    '.cc-save',
                    'button[class*="save"]',
                    'button[type="submit"]'
                ];
                
                let saveButtons = [];
                saveSelectors.forEach(selector => {
                    const buttons = document.querySelectorAll(selector);
                    saveButtons = saveButtons.concat(Array.from(buttons));
                });
                
                saveButtons.forEach((btn, index) => {
                    btn.addEventListener('click', function(e) {
                        // Don't prevent default - let the plugin handle saving
                        setTimeout(() => {
                            try {
                                const modals = document.querySelectorAll('.cc-modal, .cookie-consent-modal, .preferences-modal, [class*="modal"]');
                                
                                modals.forEach(modal => {
                                    if (modal && modal.style) {
                                        modal.style.display = 'none';
                                        modal.style.visibility = 'hidden';
                                        modal.style.opacity = '0';
                                    }
                                });
                                
                                const banners = document.querySelectorAll('.cc-banner, .cookie-consent-banner, [class*="banner"]');
                                
                                banners.forEach(banner => {
                                    if (banner && banner.style) {
                                        banner.style.display = 'none';
                                        banner.style.visibility = 'hidden';
                                        banner.style.opacity = '0';
                                    }
                                });
                                
                                // CRITICAL: Re-bind footer link after saving!
                                setTimeout(() => {
                                    // SIMPLE SOLUTION: Just reload the page after save
                                    // This is not elegant but it WORKS 100%
                                    window.location.reload();
                                }, 800);
                                
                            } catch (error) {
                                // Silently continue
                            }
                        }, 300);
                    }, { passive: true }); // Use passive listener to avoid issues
                });
            }, 1500); // Increased timeout to ensure elements are loaded
        });
        
        // Function to rebind footer cookie link 
        function rebindFooterCookieLink() {
            const footerLinks = document.querySelectorAll('a[onclick*="showCookieSettings"], a[href*="cookie"]');
            footerLinks.forEach(link => {
                // Remove old event listeners by cloning the element
                const newLink = link.cloneNode(true);
                link.parentNode.replaceChild(newLink, link);
                
                // Add fresh event listener
                newLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Small delay to ensure DOM is ready
                    setTimeout(() => {
                        window.showCookieSettings();
                    }, 100);
                });
            });
        }
        
        // Initial binding on page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(rebindFooterCookieLink, 1000);
        });
        
        // CONTACT FORM HANDLER - Robust implementation with conflict handling
        (function() {
            'use strict';
            
            console.log('Contact form handler initializing...');
            
            let formIsSubmitting = false;
            
            function initContactForm() {
                const demoForm = document.getElementById('demo-form');
                
                if (!demoForm) {
                    console.log('Demo form not found, retrying...');
                    return false;
                }
                
                console.log('Demo form found, setting up handler');
                
                // AGGRESSIVE FORM SUBMIT BLOCKING
                // Block ALL submit events on this form
                demoForm.addEventListener('submit', function(event) {
                    console.log('Submit event captured - blocking default behavior');
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    event.stopPropagation();
                    
                    if (!formIsSubmitting) {
                        formIsSubmitting = true;
                        console.log('Form submission intercepted successfully');
                        handleFormSubmission(demoForm);
                    } else {
                        console.log('Form is already submitting, ignoring duplicate');
                    }
                    
                    return false;
                }, true); // Capture phase
                
                // Also block in bubble phase as backup
                demoForm.addEventListener('submit', function(event) {
                    console.log('Submit event in bubble phase - blocking');
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    event.stopPropagation();
                    return false;
                }, false);
                
                // Block button clicks that might trigger submit
                const submitButton = demoForm.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.addEventListener('click', function(event) {
                        console.log('Submit button clicked - blocking default');
                        event.preventDefault();
                        event.stopImmediatePropagation();
                        event.stopPropagation();
                        
                        if (!formIsSubmitting) {
                            formIsSubmitting = true;
                            console.log('Button click intercepted successfully');
                            handleFormSubmission(demoForm);
                        }
                        
                        return false;
                    }, true);
                }
                
                console.log('Contact form handler attached successfully');
                return true;
            }
            
            async function handleFormSubmission(form) {
                const formData = new FormData(form);
                const submitButton = form.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.textContent;
                const successElement = document.getElementById('form-success');
                const errorElement = document.getElementById('form-error');
                
                // Show loading state
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Wird gesendet...
                `;
                
                // Hide existing messages
                if (successElement) successElement.classList.add('hidden');
                if (errorElement) errorElement.classList.add('hidden');
                
                try {
                    console.log('Sending request to:', form.action);
                    
                    // Extract current locale from URL (e.g., /de/, /en/, /es/)
                    const currentLocale = window.location.pathname.split('/')[1] || 'en';
                    console.log('Current locale from URL:', currentLocale);
                    
                    // Record start time for minimum loading duration
                    const startTime = Date.now();
                    const minimumLoadingTime = 2000; // 2 seconds minimum
                    
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Locale': currentLocale  // Send current locale to API
                        }
                    });
                    
                    console.log('Response received, status:', response.status);
                    
                    const data = await response.json();
                    console.log('Response data:', data);
                    
                    // Ensure minimum loading time has passed for better UX
                    const elapsedTime = Date.now() - startTime;
                    const remainingTime = minimumLoadingTime - elapsedTime;
                    
                    if (remainingTime > 0) {
                        console.log(`Waiting additional ${remainingTime}ms for better UX`);
                        await new Promise(resolve => setTimeout(resolve, remainingTime));
                    }
                    
                    if (response.ok && data.success) {
                        form.reset();
                        
                        if (successElement) {
                            successElement.classList.remove('hidden');
                            setTimeout(() => {
                                successElement.classList.add('hidden');
                            }, 5000);
                        }
                        
                        console.log('Form submitted successfully');
                    } else {
                        console.log('Form submission failed:', data);
                        showError(errorElement, data);
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                    showError(errorElement, { message: 'Verbindungsfehler. Bitte versuchen Sie es erneut.' });
                } finally {
                    // Reset button and submission flag
                    submitButton.disabled = false;
                    submitButton.textContent = originalButtonText;
                    formIsSubmitting = false;
                    console.log('Form submission completed, reset flag');
                }
            }
            
            function showError(errorElement, data) {
                if (errorElement) {
                    let errorMsg = 'Beim Senden Ihrer Anfrage ist ein Fehler aufgetreten.';
                    if (data.errors) {
                        errorMsg = 'Bitte überprüfen Sie Ihre Eingaben: ' + Object.values(data.errors).flat().join('. ');
                    } else if (data.message) {
                        errorMsg = data.message;
                    }
                    
                    const errorParagraph = errorElement.querySelector('p');
                    if (errorParagraph) {
                        errorParagraph.textContent = errorMsg;
                    }
                    errorElement.classList.remove('hidden');
                    
                    setTimeout(() => {
                        errorElement.classList.add('hidden');
                    }, 8000);
                }
            }
            
            // Initialize on DOM ready
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM loaded, initializing contact form...');
                if (!initContactForm()) {
                    // Retry after a short delay if not found
                    setTimeout(initContactForm, 500);
                }
            });
            
            // Also try to initialize immediately if DOM is already loaded
            if (document.readyState === 'loading') {
                console.log('DOM is loading, waiting...');
            } else {
                console.log('DOM already loaded, initializing immediately...');
                setTimeout(initContactForm, 100);
            }
        })();
    </script>
</body>
</html>
