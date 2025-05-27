    <script>
        // CONTACT FORM HANDLER - Robust implementation with conflict handling
        (function() {
            'use strict';
            
            // Mehrsprachige Übersetzungen aus Laravel
            const translations = {
                defaultError: "{{ __('messages.form_error') }}",
                connectionError: "{{ __('messages.js_connection_error') }}"
            };
            
            let formIsSubmitting = false;
            
            function initContactForm() {
                const demoForm = document.getElementById('demo-form');
                
                if (!demoForm) {
                    return false;
                }
                
                // AGGRESSIVE FORM SUBMIT BLOCKING
                // Block ALL submit events on this form
                demoForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    event.stopPropagation();
                    
                    if (!formIsSubmitting) {
                        formIsSubmitting = true;
                        handleFormSubmission(demoForm);
                    }
                    
                    return false;
                }, true); // Capture phase
                
                // Also block in bubble phase as backup
                demoForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    event.stopPropagation();
                    return false;
                }, false);
                
                // Block button clicks that might trigger submit
                const submitButton = demoForm.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.addEventListener('click', function(event) {
                        event.preventDefault();
                        event.stopImmediatePropagation();
                        event.stopPropagation();
                        
                        if (!formIsSubmitting) {
                            formIsSubmitting = true;
                            handleFormSubmission(demoForm);
                        }
                        
                        return false;
                    }, true);
                }
                
                return true;
            }
            
            async function handleFormSubmission(form) {
                // Nutze native HTML5-Validierung
                if (!form.checkValidity()) {
                    // Zeige native Browser-Validierungsmeldungen
                    form.reportValidity();
                    formIsSubmitting = false; // Wichtig: Zurücksetzen des Flags
                    return false;
                }
                
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
                    {{ __('messages.sending') }}
                `;
                
                // Hide existing messages
                if (successElement) successElement.classList.add('hidden');
                if (errorElement) errorElement.classList.add('hidden');
                
                try {
                    // Einfache Locale-Ermittlung über den LocaleHelper
                    const currentLocale = window.LocaleHelper 
                        ? window.LocaleHelper.getCurrentLocale() 
                        : window.location.pathname.split('/')[1] || document.documentElement.lang.replace('-', '_') || 'en';
                    
                    // Marketing-Consent-Checkbox Status abrufen
                    const marketingConsentCheckbox = form.querySelector('#marketing_consent');
                    const marketingConsentChecked = marketingConsentCheckbox ? marketingConsentCheckbox.checked : false;
                    
                    // IMMER die Checkbox-Info zum FormData hinzufügen, unabhängig von Cookie-Einstellungen
                    formData.set('marketing_consent', marketingConsentChecked ? '1' : '0');
                    
                    // Record start time for minimum loading duration
                    const startTime = Date.now();
                    const minimumLoadingTime = 1000; // 1 second minimum
                    
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                            'X-Locale': currentLocale  // Send current locale to API
                        }
                    });
                    
                    const data = await response.json();
                    
                    // Ensure minimum loading time has passed for better UX
                    const elapsedTime = Date.now() - startTime;
                    const remainingTime = minimumLoadingTime - elapsedTime;
                    
                    if (remainingTime > 0) {
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
                    } else {
                        showError(errorElement, data);
                    }
                } catch (error) {
                    showError(errorElement, { message: translations.connectionError });
                } finally {
                    // Reset button and submission flag
                    submitButton.disabled = false;
                    submitButton.textContent = originalButtonText;
                    formIsSubmitting = false;
                }
            }
            
            function showError(errorElement, data) {
                if (errorElement) {
                    // Standard-Fehlermeldung aus den übersetzten Texten
                    let errorMsg = translations.defaultError;
                    
                    // Wenn eine lokalisierte Nachricht vom Server zurückgegeben wird, verwenden wir diese direkt
                    if (data.message) {
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
                if (!initContactForm()) {
                    // Retry after a short delay if not found
                    setTimeout(initContactForm, 500);
                }
            });
            
            // Also try to initialize immediately if DOM is already loaded
            if (document.readyState !== 'loading') {
                if (!initContactForm()) {
                    setTimeout(initContactForm, 500);
                }
            }
        })();
    </script>
