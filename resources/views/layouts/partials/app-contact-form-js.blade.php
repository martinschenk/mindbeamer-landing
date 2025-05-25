    <script>
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
                    
                    // Verwende den LocaleHelper zur Ermittlung der korrekten Locale
                    const currentLocale = window.LocaleHelper ? window.LocaleHelper.getCurrentLocale() : 'en';
                    console.log('Current locale from LocaleHelper:', currentLocale);
                    
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
                if (!initContactForm()) {
                    setTimeout(initContactForm, 500);
                }
            }
        })();
    </script>
