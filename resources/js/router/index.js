import { createRouter, createWebHistory } from 'vue-router';
import LandingLayout from '@/layouts/LandingLayout.vue';

// Views
import LandingView from '@/views/landing/LandingView.vue';
import PrivacyView from '@/views/legal/PrivacyView.vue';
import TermsView from '@/views/legal/TermsView.vue';
import ImpressumView from '@/views/legal/ImpressumView.vue';

// Router mirrors Laravel routes for SEO
const routes = [
  // Root - English
  {
    path: '/',
    component: LandingLayout,
    children: [
      {
        path: '',
        name: 'root',
        component: LandingView,
        meta: { locale: 'en' }
      },
      // English legal pages (without locale prefix)
      {
        path: 'privacy-policy',
        name: 'privacy-policy-en',
        component: PrivacyView,
        meta: { locale: 'en' }
      },
      {
        path: 'legal-notice',
        name: 'legal-notice-en',
        component: ImpressumView,
        meta: { locale: 'en' }
      },
      {
        path: 'terms',
        name: 'terms-en',
        component: TermsView,
        meta: { locale: 'en' }
      }
    ]
  },
  
  // Localized routes
  {
    path: '/:locale(en|de|es|zh_CN)',
    component: LandingLayout,
    children: [
      {
        path: '',
        name: 'home',
        component: LandingView
      },
      // Legal pages with proper paths
      {
        path: 'privacy-policy',
        name: 'privacy-policy',
        component: PrivacyView
      },
      {
        path: 'datenschutz-richtlinie',
        alias: 'privacy-policy',
        component: PrivacyView
      },
      {
        path: 'politica-privacidad', 
        alias: 'privacy-policy',
        component: PrivacyView
      },
      {
        path: 'legal-notice',
        name: 'legal-notice',
        component: ImpressumView
      },
      {
        path: 'impressum',
        alias: 'legal-notice',
        component: ImpressumView
      },
      {
        path: 'aviso-legal',
        alias: 'legal-notice',
        component: ImpressumView
      },
      {
        path: 'terms',
        name: 'terms',
        component: TermsView
      },
      {
        path: 'agb',
        alias: 'terms',
        component: TermsView
      },
      {
        path: 'terminos',
        alias: 'terms',
        component: TermsView
      }
    ]
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else if (to.hash) {
      return {
        el: to.hash,
        behavior: 'smooth'
      };
    } else {
      return { top: 0 };
    }
  }
});

// Navigation guard to sync with Laravel locale
router.beforeEach((to, from, next) => {
  // Get locale from route params, meta, or default to 'en'
  const locale = to.params.locale || to.meta?.locale || 'en';
  
  // Update document lang attribute
  document.documentElement.lang = locale === 'zh_CN' ? 'zh-CN' : locale;
  
  // Update locale store if available
  const localeStore = window.pinia?.use?.('locale');
  if (localeStore && localeStore.currentLocale !== locale) {
    localeStore.setLocale(locale);
  }
  
  next();
});

export default router;