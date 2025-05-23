@extends('errors.layout')

@section('code', '403')

@section('title', __('messages.error_403_title'))

@section('message')
    <p>{{ __('messages.error_403_message') }}</p>
    <p class="mt-4 italic">{{ __('messages.error_403_joke') }}</p>
@endsection
