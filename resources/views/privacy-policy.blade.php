@extends('layouts.app')

@section('title')
    {{ __('privacy.title') }} - MindBeamer
@endsection

@section('meta_description')
    {{ __('privacy.meta_description') }}
@endsection

@section('content')
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 text-transparent bg-clip-text mb-6">
                    {{ __('privacy.title') }}
                </h1>
                <p class="text-surface-600 text-lg">
                    {{ __('privacy.last_updated') }}: {{ now()->format('d.m.Y') }}
                </p>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
                <!-- GDPR Compliance Badge -->
                <div class="mb-8 p-4 bg-gradient-to-r from-green-50 to-blue-50 rounded-lg border border-green-200">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-lg font-semibold text-surface-900">{{ __('messages.gdpr_compliant') }}</h3>
                            <p class="text-sm text-surface-600">{{ __('privacy.gdpr_notice') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="prose prose-lg max-w-none">
                    
                    <!-- Company Information -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ __('privacy.company_info_title') }}</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>{{ __('privacy.company') }}:</strong> Martin Schenk S.L.</p>
                            <p><strong>{{ __('privacy.address') }}:</strong> Calle Claudio Coello 14, 5G, 28001 Madrid, España</p>
                            <p><strong>{{ __('legal.vat_number') }}:</strong> ESB84645654</p>
                            <p><strong>{{ __('legal.phone') }}:</strong> <a href="tel:+34669686832" class="text-primary hover:text-primary-700">(+34) 669 686 832</a></p>
                            <p><strong>{{ __('privacy.contact') }}:</strong> m.schenk@mindbeamer.io</p>
                        </div>
                    </section>

                    <!-- Data Collection -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ __('privacy.data_collection_title') }}</h2>
                        <p class="mb-4">{{ __('privacy.data_collection_desc') }}</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>{{ __('privacy.data_contact_forms') }}</li>
                            <li>{{ __('privacy.data_cookies') }}</li>
                            <li>{{ __('privacy.data_analytics') }}</li>
                        </ul>
                    </section>

                    <!-- Cookies -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ __('privacy.cookies_title') }}</h2>
                        <p class="mb-4">{{ __('privacy.cookies_desc') }}</p>
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="font-semibold mb-2">{{ __('privacy.cookies_types') }}:</h3>
                            <ul class="list-disc pl-6 space-y-1">
                                <li>{{ __('privacy.cookies_necessary') }}</li>
                                <li>{{ __('privacy.cookies_analytics') }}</li>
                                <li>{{ __('privacy.cookies_preferences') }}</li>
                            </ul>
                        </div>
                    </section>

                    <!-- Your Rights -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ __('privacy.rights_title') }}</h2>
                        <p class="mb-4">{{ __('privacy.rights_desc') }}</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>{{ __('privacy.right_access') }}</li>
                            <li>{{ __('privacy.right_rectification') }}</li>
                            <li>{{ __('privacy.right_erasure') }}</li>
                            <li>{{ __('privacy.right_portability') }}</li>
                            <li>{{ __('privacy.right_object') }}</li>
                        </ul>
                    </section>

                    <!-- Contact -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-surface-900 mb-4">{{ __('privacy.contact_title') }}</h2>
                        <p class="mb-4">{{ __('privacy.contact_desc') }}</p>
                        <div class="bg-gradient-to-r from-primary-50 to-primary-100 p-6 rounded-lg">
                            <p class="font-semibold">{{ __('privacy.contact_email') }}: m.schenk@mindbeamer.io</p>
                        </div>
                    </section>

                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-12">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" 
                   class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition-colors duration-200">
                    ← {{ __('privacy.back_to_home') }}
                </a>
            </div>
        </div>
    </div>
@endsection
