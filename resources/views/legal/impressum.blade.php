@extends('layouts.app')

@section('title')
    {{ __('legal.impressum_title') }} - MindBeamer
@endsection

@section('meta_description')
    {{ __('legal.impressum_meta') }}
@endsection

@section('content')
<div class="container mx-auto px-6 py-24">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-12 bg-gradient-to-r from-primary-600 to-primary-800 text-transparent bg-clip-text">
            {{ __('legal.impressum_title') }}
        </h1>
        
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12 space-y-8">
            <!-- Company Information -->
            <section>
                <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.company_info') }}
                </h2>
                <div class="space-y-3 text-surface-700">
                    <p><strong>{{ __('legal.company_name') }}:</strong> Martin Schenk S.L.</p>
                    <p><strong>{{ __('legal.represented_by') }}:</strong> Martin Schenk</p>
                    <p><strong>{{ __('legal.address') }}:</strong></p>
                    <div class="ml-4">
                        <p>Calle Claudio Coello 14, 5G</p>
                        <p>28001 Madrid</p>
                        <p>España</p>
                    </div>
                </div>
            </section>

            <!-- Contact Information -->
            <section>
                <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.contact_info') }}
                </h2>
                <div class="space-y-3 text-surface-700">
                    <p><strong>{{ __('legal.email') }}:</strong> <a href="mailto:m.schenk@mindbeamer.io" class="text-primary hover:text-primary-700">m.schenk@mindbeamer.io</a></p>
                    <p><strong>{{ __('legal.phone') }}:</strong> <a href="tel:+34669686832" class="text-primary hover:text-primary-700">(+34) 669 686 832</a></p>
                    <p><strong>{{ __('legal.website') }}:</strong> <a href="https://mindbeamer.io" class="text-primary hover:text-primary-700">https://mindbeamer.io</a></p>
                </div>
            </section>

            <!-- VAT Information -->
            <section>
                <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.tax_info') }}
                </h2>
                <div class="space-y-3 text-surface-700">
                    <p><strong>{{ __('legal.vat_number') }}:</strong> ESB84645654</p>
                    <p><strong>{{ __('legal.tax_office') }}:</strong> Madrid, España</p>
                </div>
            </section>

            <!-- Responsible for Content -->
            <section>
                <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.content_responsibility') }}
                </h2>
                <div class="space-y-3 text-surface-700">
                    <p><strong>{{ __('legal.responsible_person') }}:</strong> Martin Schenk</p>
                    <p><strong>{{ __('legal.address') }}:</strong> Calle Claudio Coello 14, 5G, 28001 Madrid, España</p>
                    <p><strong>{{ __('legal.phone') }}:</strong> <a href="tel:+34669686832" class="text-primary hover:text-primary-700">(+34) 669 686 832</a></p>
                    <p><strong>{{ __('legal.email') }}:</strong> <a href="mailto:m.schenk@mindbeamer.io" class="text-primary hover:text-primary-700">m.schenk@mindbeamer.io</a></p>
                </div>
            </section>

            <!-- Disclaimer -->
            <section>
                <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.disclaimer_title') }}
                </h2>
                <div class="space-y-4 text-surface-700">
                    <p>{{ __('legal.disclaimer_content') }}</p>
                    <p>{{ __('legal.disclaimer_liability') }}</p>
                </div>
            </section>

            <!-- Copyright -->
            <section>
                <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.copyright_title') }}
                </h2>
                <div class="space-y-4 text-surface-700">
                    <p>{{ __('legal.copyright_content') }}</p>
                </div>
            </section>

            <!-- Trademark Disclaimers -->
            <section>
                <h2 class="text-2xl font-bold text-surface-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.trademark_disclaimer_title') }}
                </h2>
                <div class="space-y-4 text-surface-700">
                    <p>{{ __('legal.trademark_disclaimer_intro') }}</p>
                    <ul class="space-y-2 ml-6 list-disc">
                        <li>{{ __('legal.trademark_wordpress') }}</li>
                        <li>{{ __('legal.trademark_linkedin') }}</li>
                        <li>{{ __('legal.trademark_instagram') }}</li>
                        <li>{{ __('legal.trademark_facebook') }}</li>
                        <li>{{ __('legal.trademark_twitter') }}</li>
                    </ul>
                    <p>{{ __('legal.trademark_disclaimer_outro') }}</p>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
