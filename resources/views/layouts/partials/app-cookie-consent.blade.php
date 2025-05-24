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
    </script>
