import { defineStore } from 'pinia';
import { ref } from 'vue';
import axios from 'axios';

export const useContactStore = defineStore('contact', () => {
  // State
  const form = ref({
    name: '',
    email: '',
    phone: '',
    company: '',
    website: '',
    revenue: '',
    comments: ''
  });
  
  const loading = ref(false);
  const success = ref(false);
  const error = ref(null);
  
  // Actions
  async function submitDemoRequest() {
    loading.value = true;
    error.value = null;
    success.value = false;
    
    try {
      // Get CSRF token
      const csrfToken = window.__APP_DATA__?.csrfToken || 
        document.querySelector('meta[name="csrf-token"]')?.content;
      
      const response = await axios.post(
        window.__APP_DATA__?.routes?.['api.demo-request'] || '/api/demo-request',
        form.value,
        {
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          }
        }
      );
      
      if (response.data.success) {
        success.value = true;
        resetForm();
        
        // Track conversion if analytics consent given
        if (window.gtag && localStorage.getItem('cookieConsent')) {
          const consent = JSON.parse(localStorage.getItem('cookieConsent'));
          if (consent.analytics) {
            window.gtag('event', 'conversion', {
              'send_to': 'AW-XXXXXXXXX/XXXXXXXXX',
              'value': 1.0,
              'currency': 'USD'
            });
          }
        }
      }
    } catch (err) {
      error.value = err.response?.data?.message || 'An error occurred. Please try again.';
    } finally {
      loading.value = false;
    }
  }
  
  function resetForm() {
    form.value = {
      name: '',
      email: '',
      phone: '',
      company: '',
      website: '',
      revenue: '',
      comments: ''
    };
  }
  
  function validateForm() {
    const errors = {};
    
    if (!form.value.name?.trim()) {
      errors.name = 'Name is required';
    }
    
    if (!form.value.email?.trim()) {
      errors.email = 'Email is required';
    } else if (!isValidEmail(form.value.email)) {
      errors.email = 'Please enter a valid email';
    }
    
    if (!form.value.company?.trim()) {
      errors.company = 'Company is required';
    }
    
    return Object.keys(errors).length === 0 ? null : errors;
  }
  
  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }
  
  return {
    // State
    form,
    loading,
    success,
    error,
    
    // Actions
    submitDemoRequest,
    resetForm,
    validateForm
  };
});