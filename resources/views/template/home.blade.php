@extends('layouts.app')

{{-- SEO Section --}}
@section('seo')
    <x-seo
        :title="config('seo.defaults.title') . ' | Trang chủ'"
        :description="config('seo.defaults.description')"
        :keywords="config('seo.defaults.keywords')"
        :og_image="config('seo.company.logo')"
        type="website"
    />
@endsection

@section('body')
    <!-- Scroll Top -->
    <button id="goTop" class="tf-btn" type="button">
        <span class="border-progress"></span>
        <span class="icon icon-caret-up"></span>
    </button>
    <!-- preload -->
    <div class="preload preload-container" id="preload">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
        <x-navbar />
        @include('sections.banner-slider')
        @include('sections.marquee')
        @include('sections.banner-image')
        @include('sections.collection')
        @include('sections.customer-reviews')
        @include('sections.our-blog')
        @include('sections.box-icon')
        <x-footer />
    </div>
@endsection
