@extends('layouts.app')

@section('title', 'Tin tức - Star Vik')
@section('description', 'Star Vik  - CÔNG TY TNHH STAR VIK')
@section('keywords', 'starvik, đồ gia dụng, thực phẩm chức năng, máy xay sinh tố')

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
        @include('sections.blog-detail')

        <x-footer />
    </div>
@endsection
