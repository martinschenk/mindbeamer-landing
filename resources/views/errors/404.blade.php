@extends('errors.layout')

@section('code', '404')

@section('title', __('messages.error_404_title'))

@section('message')
    <p>{{ __('messages.error_404_message') }}</p>
    <p class="mt-4 italic">{{ __('messages.error_404_joke') }}</p>
@endsection
