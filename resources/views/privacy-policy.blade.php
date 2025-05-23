<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="section-title text-4xl md:text-5xl font-bold bg-gradient-to-r from-pink-500 via-purple-400 to-teal-400 text-transparent bg-clip-text mb-6">
                    {{ __('privacy.title') }}
                </h1>
                <p class="text-gray-600 text-lg">
                    {{ __('privacy.last_updated') }}: {{ now()->format('d.m.Y') }}
                </p>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
                <div class="prose prose-lg max-w-none">
                    
                    <!-- Company Information -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('privacy.company_info_title') }}</h2>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <p class="mb-2"><strong>{{ __('privacy.company_name') }}:</strong> Martin Schenk S.L.</p>
                            <p class="mb-2"><strong>{{ __('privacy.address') }}:</strong> Calle Claudio Coello 14, 5G</p>
                            <p class="mb-2"><strong>{{ __('privacy.city') }}:</strong> 28001 Madrid</p>
                            <p class="mb-2"><strong>{{ __('privacy.country') }}:</strong> España</p>
                            <p><strong>{{ __('privacy.contact') }}:</strong> info@mindbeamer.io</p>
                        </div>
                    </section>

                    <!-- Data Collection -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('privacy.data_collection_title') }}</h2>
                        <p class="mb-4">{{ __('privacy.data_collection_desc') }}</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>{{ __('privacy.data_contact_forms') }}</li>
                            <li>{{ __('privacy.data_cookies') }}</li>
                            <li>{{ __('privacy.data_analytics') }}</li>
                        </ul>
                    </section>

                    <!-- Cookies -->
                    <section class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('privacy.cookies_title') }}</h2>
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
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('privacy.rights_title') }}</h2>
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
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('privacy.contact_title') }}</h2>
                        <p class="mb-4">{{ __('privacy.contact_desc') }}</p>
                        <div class="bg-gradient-to-r from-pink-50 to-purple-50 p-6 rounded-lg">
                            <p class="font-semibold">{{ __('privacy.contact_email') }}: info@mindbeamer.io</p>
                        </div>
                    </section>

                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-12">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 bg-pink-500 text-white font-medium rounded-lg hover:bg-pink-600 transition-colors duration-200">
                    ← {{ __('privacy.back_to_home') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
