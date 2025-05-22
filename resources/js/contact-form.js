/**
 * Contact form handler with Simple Notifications
 * Handles form submission with loading indicator and error handling
 */

document.addEventListener('DOMContentLoaded', function() {
    const demoForm = document.getElementById('demo-form');
    
    if (demoForm) {
        // Debug: Verify form is found
        console.log('Demo form found, attaching listener');
        
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
                // Send form data via fetch API
                console.log('Sending to:', demoForm.action);
                const response = await fetch(demoForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                const data = await response.json();
                console.log('Response:', data);
                
                // Reset form
                if (response.ok && data.success) {
                    demoForm.reset();
                    
                    // Use translation for success message if available
                    const successMessage = window.translations?.form_success || data.message;
                    
                    // Verwende unsere neue SimpleNotifications-Lösung
                    if (window.notifications) {
                        window.notifications.success(successMessage);
                    } else {
                        console.error('SimpleNotifications nicht verfügbar');
                        
                        // Fallback - Zeige eine einfache Meldung unterhalb des Formulars
                        const successElement = document.getElementById('form-success');
                        if (successElement) {
                            successElement.textContent = successMessage;
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
                        
                        // Verwende unsere neue SimpleNotifications-Lösung
                        if (window.notifications) {
                            window.notifications.error(errorMessage + '<br>' + errorDetails);
                        } else {
                            console.error('SimpleNotifications nicht verfügbar');
                            
                            // Fallback - Zeige eine einfache Meldung unterhalb des Formulars
                            const errorElement = document.getElementById('form-error');
                            if (errorElement) {
                                errorElement.textContent = errorMessage + ' ' + errorDetails;
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
                        
                        // Verwende unsere neue SimpleNotifications-Lösung
                        if (window.notifications) {
                            window.notifications.error(errorMessage);
                        } else {
                            console.error('SimpleNotifications nicht verfügbar');
                            
                            // Fallback - Zeige eine einfache Meldung unterhalb des Formulars
                            const errorElement = document.getElementById('form-error');
                            if (errorElement) {
                                errorElement.textContent = errorMessage;
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
                console.error('Error submitting form:', error);
                
                const errorMessage = window.translations?.connection_error || 'Connection error. Please try again.';
                
                // Verwende unsere neue SimpleNotifications-Lösung
                if (window.notifications) {
                    window.notifications.error(errorMessage);
                } else {
                    console.error('SimpleNotifications nicht verfügbar');
                    
                    // Fallback - Zeige eine einfache Meldung unterhalb des Formulars
                    const errorElement = document.getElementById('form-error');
                    if (errorElement) {
                        errorElement.textContent = errorMessage;
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
        console.error('Demo form not found on page');
    }
});
