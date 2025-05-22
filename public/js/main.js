/**
 * MindBeamer.io - Main JavaScript
 */
document.addEventListener('DOMContentLoaded', function() {
    // Form handling
    const demoForm = document.getElementById('demo-form');
    if (demoForm) {
        demoForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            const formSuccess = document.getElementById('form-success');
            const formError = document.getElementById('form-error');
            
            // Disable submit button
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.classList.add('opacity-75');
            }
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Show success message
                    form.reset();
                    if (formSuccess) {
                        formSuccess.classList.remove('hidden');
                    }
                    if (formError) {
                        formError.classList.add('hidden');
                    }
                } else {
                    // Show error message
                    if (formError) {
                        formError.textContent = result.message || 'An error occurred. Please try again.';
                        formError.classList.remove('hidden');
                    }
                    if (formSuccess) {
                        formSuccess.classList.add('hidden');
                    }
                }
            } catch (error) {
                console.error('Form submission error:', error);
                
                // Show error message
                if (formError) {
                    formError.textContent = 'An error occurred. Please try again.';
                    formError.classList.remove('hidden');
                }
                if (formSuccess) {
                    formSuccess.classList.add('hidden');
                }
            } finally {
                // Re-enable submit button
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.classList.remove('opacity-75');
                }
            }
        });
    }

    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Adjust for header height
                    behavior: 'smooth'
                });
            }
        });
    });
});
