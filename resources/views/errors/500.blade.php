@extends('errors.layout')

@section('code', '500')

@section('title', __('messages.error_500_title'))

@section('message')
    <p>{{ __('messages.error_500_message') }}</p>
    <p class="mt-4 italic">{{ __('messages.error_500_joke') }}</p>
@endsection
