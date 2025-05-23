@extends('layouts.app')

@section('title')
    {{ __('legal.terms_title') }} - MindBeamer
@endsection

@section('meta_description')
    {{ __('legal.terms_meta') }}
@endsection

@section('content')
<div class="container mx-auto px-6 py-16">
    <div class="max-w-4xl mx-auto">
        <h1 class="section-title text-3xl md:text-4xl font-bold text-center mb-12 bg-gradient-to-r from-pink-500 via-purple-400 to-teal-400 text-transparent bg-clip-text">
            {{ __('legal.terms_title') }}
        </h1>
        
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12 space-y-8">
            <!-- Introduction -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.terms_introduction_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.terms_introduction') }}</p>
                    <p><strong>{{ __('legal.last_updated') }}:</strong> {{ date('d.m.Y') }}</p>
                </div>
            </section>

            <!-- Service Description -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.service_description_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.service_description') }}</p>
                </div>
            </section>

            <!-- User Obligations -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.user_obligations_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.user_obligations_intro') }}</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>{{ __('legal.user_obligation_1') }}</li>
                        <li>{{ __('legal.user_obligation_2') }}</li>
                        <li>{{ __('legal.user_obligation_3') }}</li>
                        <li>{{ __('legal.user_obligation_4') }}</li>
                    </ul>
                </div>
            </section>

            <!-- Intellectual Property -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.intellectual_property_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.intellectual_property') }}</p>
                </div>
            </section>

            <!-- Limitation of Liability -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.liability_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.liability_limitation') }}</p>
                </div>
            </section>

            <!-- Data Protection -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.data_protection_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.data_protection') }} 
                        <a href="{{ route('privacy.policy', ['locale' => app()->getLocale()]) }}" class="text-pink-600 hover:text-pink-800 underline">{{ __('legal.privacy_policy_link') }}</a>.
                    </p>
                </div>
            </section>

            <!-- Termination -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.termination_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.termination') }}</p>
                </div>
            </section>

            <!-- Applicable Law -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.applicable_law_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.applicable_law') }}</p>
                </div>
            </section>

            <!-- Changes to Terms -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.changes_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.changes_to_terms') }}</p>
                </div>
            </section>

            <!-- Contact -->
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                    {{ __('legal.contact_title') }}
                </h2>
                <div class="space-y-4 text-gray-700">
                    <p>{{ __('legal.contact_for_questions') }}</p>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p><strong>Martin Schenk S.L.</strong></p>
                        <p>Calle Claudio Coello 14, 5G</p>
                        <p>28001 Madrid, España</p>
                        <p><strong>{{ __('legal.vat_number') }}:</strong> ESB84645654</p>
                        <p><strong>{{ __('legal.phone') }}:</strong> <a href="tel:+34669686832" class="text-pink-600 hover:text-pink-800">(+34) 669 686 832</a></p>
                        <p>{{ __('legal.email') }}: <a href="mailto:m.schenk@mindbeamer.io" class="text-pink-600 hover:text-pink-800">m.schenk@mindbeamer.io</a></p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
