/**
 * Contact form handler with Simple Notifications
 * Handles form submission with loading indicator and error handling
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Contact form script loaded');
    
    const demoForm = document.getElementById('demo-form');
    
    if (demoForm) {
        console.log('Demo form found');
        
        // Attach form submit event listener
        demoForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            console.log('Form submitted');
            
            // Get form data
            const formData = new FormData(demoForm);
            const submitButton = demoForm.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.textContent;
            
            // Show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                ${window.translations?.sending || 'Sending...'}
            `;
            
            try {
                console.log('Sending request to:', demoForm.action);
                
                // Einfache Locale-Ermittlung über den LocaleHelper
                const currentLocale = window.LocaleHelper 
                    ? window.LocaleHelper.getCurrentLocale() 
                    : window.location.pathname.split('/')[1] || document.documentElement.lang.replace('-', '_') || 'en';
                console.log('Current locale:', currentLocale);
                
                // Record start time for minimum loading duration
                const startTime = Date.now();
                const minimumLoadingTime = 2000; // 2 seconds minimum
                
                // Send form data via fetch API
                const response = await fetch(demoForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Locale': currentLocale  // Send current locale to API
                    }
                });
                
                console.log('Response status:', response.status);
                
                const data = await response.json();
                console.log('Response data:', data);
                
                // Ensure minimum loading time has passed for better UX
                const elapsedTime = Date.now() - startTime;
                const remainingTime = minimumLoadingTime - elapsedTime;
                
                if (remainingTime > 0) {
                    console.log(`Waiting additional ${remainingTime}ms for better UX`);
                    await new Promise(resolve => setTimeout(resolve, remainingTime));
                }
                
                // Reset form
                if (response.ok && data.success) {
                    demoForm.reset();
                    
                    // Use translation for success message if available
                    const successMessage = window.translations?.form_success || data.message;
                    
                    // Show success notification
                    if (window.notifications) {
                        console.log('Showing success notification');
                        window.notifications.success(successMessage);
                    } else {
                        console.log('No notifications system found, using fallback');
                        // Fallback - show message below form
                        const successElement = document.getElementById('form-success');
                        if (successElement) {
                            successElement.querySelector('p').textContent = successMessage;
                            successElement.classList.remove('hidden');
                            
                            // Hide after 5 seconds
                            setTimeout(() => {
                                successElement.classList.add('hidden');
                            }, 5000);
                        }
                    }
                } else {
                    // Show error notification
                    let errorMessage;
                    
                    if (data.errors) {
                        // If we have validation errors
                        errorMessage = window.translations?.validation_error || 'Please check your inputs';
                        const errorDetails = Object.values(data.errors).flat().join('. ');
                        
                        if (window.notifications) {
                            window.notifications.error(errorMessage + ': ' + errorDetails);
                        } else {
                            // Fallback - show message below form
                            const errorElement = document.getElementById('form-error');
                            if (errorElement) {
                                errorElement.querySelector('p').textContent = errorMessage + ' ' + errorDetails;
                                errorElement.classList.remove('hidden');
                                
                                // Hide after 5 seconds
                                setTimeout(() => {
                                    errorElement.classList.add('hidden');
                                }, 5000);
                            }
                        }
                    } else {
                        // General error
                        errorMessage = window.translations?.form_error || data.message;
                        
                        if (window.notifications) {
                            window.notifications.error(errorMessage);
                        } else {
                            // Fallback - show message below form
                            const errorElement = document.getElementById('form-error');
                            if (errorElement) {
                                errorElement.querySelector('p').textContent = errorMessage;
                                errorElement.classList.remove('hidden');
                                
                                // Hide after 5 seconds
                                setTimeout(() => {
                                    errorElement.classList.add('hidden');
                                }, 5000);
                            }
                        }
                    }
                }
            } catch (error) {
                console.error('Fetch error:', error);
                const errorMessage = window.translations?.connection_error || 'Connection error. Please try again.';
                
                if (window.notifications) {
                    window.notifications.error(errorMessage);
                } else {
                    // Fallback - show message below form
                    const errorElement = document.getElementById('form-error');
                    if (errorElement) {
                        errorElement.querySelector('p').textContent = errorMessage;
                        errorElement.classList.remove('hidden');
                        
                        // Hide after 5 seconds
                        setTimeout(() => {
                            errorElement.classList.add('hidden');
                        }, 5000);
                    }
                }
            } finally {
                // Reset button state
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        });
    } else {
        console.log('Demo form not found on page');
    }
});
