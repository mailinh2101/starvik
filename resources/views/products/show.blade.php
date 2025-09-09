@extends('layouts.app')

@section('title', $product->name . ' - Star Vik')
@section('description', Str::limit($product->description, 160))
@section('keywords', $product->name . ', ' . $product->brand . ', ' . $product->category . ', star vik')

@push('head')
<!-- Products Show Page Styles -->
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
<link rel="stylesheet" href="{{ asset('css/products-show.css') }}">
@endpush

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

        <!-- Breadcrumb -->
        <section class="tf-breadcrumb pt-5 pb-5">
            <div class="container">
                <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                    <div class="tf-breadcrumb-list">
                        <a href="{{ url('/') }}" class="text">Trang chủ</a>
                        <i class="icon icon-arrow-right"></i>
                        <a href="{{ route('products.index') }}" class="text">Sản phẩm</a>
                        @if($product->category && trim($product->category) !== '')
                        <i class="icon icon-arrow-right"></i>
                        <a href="{{ route('products.category', $product->category) }}" class="text">{{ ucfirst($product->category) }}</a>
                        @endif
                        <i class="icon icon-arrow-right"></i>
                        <span class="text">{{ $product->name }}</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Breadcrumb -->

        <!-- Product Detail -->
        <section class="tf-product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product-gallery">
                            <!-- Main Image -->
                            <div class="main-image">
                                <img id="mainProductImage" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
                            </div>

                            <!-- Thumbnail Gallery -->
                            @if($product->gallery && count($product->gallery) > 0)
                            <div class="thumbnail-gallery">
                                <div class="thumbnail active" onclick="changeMainImage('{{ $product->image_url }}', this)">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                </div>
                                @foreach($product->gallery_urls as $image_url)
                                <div class="thumbnail" onclick="changeMainImage('{{ $image_url }}', this)">
                                    <img src="{{ $image_url }}" alt="{{ $product->name }}">
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="product-info">
                            @if($product->brand)
                            <div class="product-brand">{{ $product->brand }}</div>
                            @endif

                            <h1 class="product-title">{{ $product->name }}</h1>

                            @if($product->category)
                            <span class="product-category">{{ ucfirst($product->category) }}</span>
                            @endif

                            <div class="product-description">
                                {!! $product->description !!}
                            </div>

                            <div class="action-buttons">
                                <button class="btn btn-primary" onclick="contactForProduct()">
                                    <i class="icon icon-phone"></i> Liên hệ tư vấn
                                </button>
                                <button class="btn btn-outline-secondary" onclick="shareProduct()">
                                    <i class="icon icon-share"></i> Chia sẻ
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Product Detail -->

        <!-- Related Products -->
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="related-products">
            <div class="container">
                <div class="sect-title text-center mb-5">
                    <h2 class="title">Sản phẩm liên quan</h2>
                </div>

                <div class="row">
                    @foreach($relatedProducts as $related)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="product-item">
                            <div class="image">
                                <a href="{{ route('products.show', $related->slug) }}">
                                    <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="img-fluid">
                                </a>
                            </div>
                            <div class="content">
                                <h5><a href="{{ route('products.show', $related->slug) }}">{{ $related->name }}</a></h5>
                                @if($related->brand)
                                <small class="text-muted">{{ $related->brand }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <x-footer />
    </div>
@endsection

@push('scripts')
<!-- Products Show Page JavaScript -->
<script src="{{ asset('js/products-show.js') }}"></script>
@endpush
