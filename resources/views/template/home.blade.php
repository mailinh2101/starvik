@extends('layouts.app')

{{-- SEO Section --}}
@section('seo')
    <x-seo
        title="Star Vik - Công ty TNHH Star Vik | Trang chủ"
        description="Star Vik - CÔNG TY TNHH STAR VIK chuyên cung cấp đồ gia dụng, thực phẩm chức năng, máy xay sinh tố chất lượng cao"
        keywords="starvik, đồ gia dụng, thực phẩm chức năng, máy xay sinh tố, công ty star vik"
        :og_image="asset('images/logo/logo-starvik.png')"
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
