@extends('errors.layout')

@section('code', '503')

@section('title', __('messages.error_503_title'))

@section('message')
    <p>{{ __('messages.error_503_message') }}</p>
    <p class="mt-4 italic">{{ __('messages.error_503_joke') }}</p>
@endsection
