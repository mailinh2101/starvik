@extends('layouts.app')

@section('title', 'Liên hệ - ' . config('seo.company.name'))
@section('description', config('seo.company.description'))
@section('keywords', config('seo.defaults.keywords'))

@section('body')
    <!-- Scroll Top -->
    <x-button id="goTop" class="tf-btn" type="button">
        <span class="border-progress"></span>
        <span class="icon icon-caret-up"></span>
    </x-button>
    <!-- preload -->
    <div class="preload preload-container" id="preload">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
        <x-navbar />
        @include('sections.page-title')
        @include('sections.information')
        @include('sections.map')
        @include('sections.contact-form')

        <x-footer />
    </div>
@endsection
