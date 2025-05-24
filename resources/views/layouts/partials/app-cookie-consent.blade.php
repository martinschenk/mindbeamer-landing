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
        // Cookie Consent Modal State Manager
        window.MBCookieModal = {
            isOpen: false,
            lastInteraction: 0,
            modalSelectors: [
                '.cc-modal',
                '.cookie-consent-modal',
                '.preferences-modal',
                '[class*="cookie-modal"]',
                '[class*="cookie_modal"]',
                '[class*="preferences-modal"]'
            ],
            buttonSelectors: [
                '[data-cc="show-preferencesModal"]',
                '[data-role="show-preferences"]', 
                '.cc-btn-preferences',
                '.cc-btn-settings',
                '.cc-customize',
                '.cc-preferences-btn',
                'button[class*="preferences"]',
                'button[class*="settings"]',
                'a[href*="preferences"]'
            ],
            saveButtonSelectors: [
                '[data-cc="save"]',
                '.cc-save-btn', 
                '.cc-save',
                'button[class*="save"]',
                'button[type="submit"]'
            ],
            
            // Find modal element
            getModalElement: function() {
                for (const selector of this.modalSelectors) {
                    const elements = document.querySelectorAll(selector);
                    if (elements.length > 0) {
                        return elements[0];
                    }
                }
                return null;
            },
            
            // Find settings button
            getSettingsButton: function() {
                for (const selector of this.buttonSelectors) {
                    const buttons = document.querySelectorAll(selector);
                    if (buttons.length > 0) {
                        return buttons[0];
                    }
                }
                return null;
            },
            
            // Find all save buttons
            getSaveButtons: function() {
                let saveButtons = [];
                for (const selector of this.saveButtonSelectors) {
                    const buttons = document.querySelectorAll(selector);
                    if (buttons.length > 0) {
                        saveButtons = saveButtons.concat(Array.from(buttons));
                    }
                }
                return saveButtons;
            },
            
            // Shows the modal
            showModal: function() {
                const button = this.getSettingsButton();
                if (button) {
                    button.click();
                    this.isOpen = true;
                    this.lastInteraction = Date.now();
                    return true;
                }
                
                // Try global methods if button not found
                const globalMethods = [
                    () => window.CookieConsent && window.CookieConsent.showPreferences(),
                    () => window.cookieConsent && window.cookieConsent.showPreferences(),
                    () => window.CC && window.CC.showPreferences(),
                    () => window.showPreferences && window.showPreferences(),
                    () => document.dispatchEvent(new CustomEvent('cc:show-preferences')),
                    () => document.dispatchEvent(new CustomEvent('cookie-consent:show-modal'))
                ];
                
                for (const method of globalMethods) {
                    try {
                        method();
                        this.isOpen = true;
                        this.lastInteraction = Date.now();
                        return true;
                    } catch (e) {
                        // Continue to next method
                    }
                }
                
                return false;
            },
            
            // Setup event listeners for save buttons
            setupSaveListeners: function() {
                const saveButtons = this.getSaveButtons();
                if (saveButtons.length === 0) return;
                
                saveButtons.forEach(btn => {
                    // Remove existing listeners by cloning
                    const newBtn = btn.cloneNode(true);
                    if (btn.parentNode) {
                        btn.parentNode.replaceChild(newBtn, btn);
                    }
                    
                    // Add our custom listener
                    newBtn.addEventListener('click', (e) => {
                        // Don't prevent default - let the plugin save cookies
                        this.lastInteraction = Date.now();
                        
                        // Give time for saving to complete
                        setTimeout(() => {
                            this.isOpen = false;
                            
                            // Only hide the modal, don't reload page
                            const modal = this.getModalElement();
                            if (modal) {
                                modal.style.display = 'none';
                                modal.style.visibility = 'hidden';
                                modal.style.opacity = '0';
                                
                                // Reset the modal structure
                                this.resetModalStructure();
                            }
                        }, 500);
                    }, { passive: true });
                });
            },
            
            // Reset the modal structure without page reload
            resetModalStructure: function() {
                // Perform a "soft reset" on the cookie consent system
                if (window.cookieConsent) {
                    try {
                        // This is a more elegant approach than page reload
                        if (typeof window.cookieConsent.resetInstance === 'function') {
                            window.cookieConsent.resetInstance();
                        }
                        
                        // Some libraries have a reset method
                        if (typeof window.cookieConsent.reset === 'function') {
                            window.cookieConsent.reset();
                        }
                    } catch (e) {
                        console.log('Cookie consent reset failed:', e);
                    }
                }
                
                // Rebind all footer cookie links
                this.rebindCookieLinks();
            },
            
            // Setup DOM mutation observer to watch for modal changes
            setupMutationObserver: function() {
                // Watch the entire document for changes
                const observer = new MutationObserver((mutations) => {
                    // Look for cookie modal being added to the DOM
                    let shouldBindSaveButtons = false;
                    
                    for (const mutation of mutations) {
                        if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                            for (const node of mutation.addedNodes) {
                                if (node.nodeType === Node.ELEMENT_NODE) {
                                    // Check if this element or any of its children match our modal selectors
                                    for (const selector of this.modalSelectors) {
                                        if (node.matches && node.matches(selector) || node.querySelector(selector)) {
                                            shouldBindSaveButtons = true;
                                            break;
                                        }
                                    }
                                    
                                    // If we found something, no need to check other nodes
                                    if (shouldBindSaveButtons) break;
                                }
                            }
                        }
                        
                        // If we found something, no need to check other mutations
                        if (shouldBindSaveButtons) break;
                    }
                    
                    // If modal was added, set up save button listeners
                    if (shouldBindSaveButtons) {
                        setTimeout(() => this.setupSaveListeners(), 300);
                    }
                });
                
                // Start observing with these configuration options
                observer.observe(document.body, {
                    childList: true,
                    subtree: true,
                    attributes: false,
                    characterData: false
                });
            },
            
            // Rebind all cookie links in the footer
            rebindCookieLinks: function() {
                const footerLinks = document.querySelectorAll('button[onclick*="showCookieSettings"], a[onclick*="showCookieSettings"]');
                footerLinks.forEach(link => {
                    // Remove old event by cloning
                    const newLink = link.cloneNode(true);
                    if (link.parentNode) {
                        link.parentNode.replaceChild(newLink, link);
                    }
                    
                    // Add fresh click handler
                    newLink.addEventListener('click', (e) => {
                        e.preventDefault();
                        window.showCookieSettings();
                    });
                });
            },
            
            // Initialize the cookie modal manager
            init: function() {
                // Set up mutation observer to detect modal changes
                this.setupMutationObserver();
                
                // Initial binding of footer links
                setTimeout(() => this.rebindCookieLinks(), 1000);
                
                // Add to window object for debugging
                window.MBCookieModal = this;
                
                console.log('MindBeamer Cookie Modal Manager initialized');
            }
        };
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            window.MBCookieModal.init();
        });
        
        // Show cookie settings function - improved version
        window.showCookieSettings = function() {
            return window.MBCookieModal.showModal();
        };
    </script>
