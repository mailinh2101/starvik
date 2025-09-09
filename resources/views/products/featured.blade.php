@extends('layouts.app')

@section('title', 'Sản phẩm nổi bật - Star Vik')
@section('description', 'Khám phá những sản phẩm nổi bật và được yêu thích nhất tại Star Vik')
@section('keywords', 'sản phẩm nổi bật, bestseller, star vik')

@push('head')
<!-- Products Featured Page Styles -->
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
<link rel="stylesheet" href="{{ asset('css/products-featured.css') }}">
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
        <section class="tf-breadcrumb">
            <div class="container">
                <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                    <div class="tf-breadcrumb-list">
                        <a href="{{ url('/') }}" class="text">Trang chủ</a>
                        <i class="icon icon-arrow-right"></i>
                        <a href="{{ route('products.index') }}" class="text">Sản phẩm</a>
                        <i class="icon icon-arrow-right"></i>
                        <span class="text">Sản phẩm nổi bật</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Breadcrumb -->

        <!-- Featured Hero -->
        <section class="featured-hero">
            <div class="container">
                <h1>Sản phẩm nổi bật</h1>
                <p>Khám phá những sản phẩm được yêu thích và đánh giá cao nhất tại Star Vik. Chất lượng đỉnh cao, công nghệ hiện đại.</p>
            </div>
        </section>
        <!-- /Featured Hero -->

        <!-- Featured Products -->
        <section class="tf-featured-products">
            <div class="container">
                @if($products->count() > 0)
                <div class="product-grid">
                    @foreach($products as $product)
                    <div class="featured-product-card">
                        <div class="featured-badge">Nổi bật</div>

                        <div class="product-image">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" loading="lazy">
                            </a>
                        </div>

                        <div class="product-content">
                            @if($product->category)
                            <div class="product-category">{{ $product->category }}</div>
                            @endif

                            <h3 class="product-title">
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>

                            @if($product->brand)
                            <div class="product-brand">{{ $product->brand }}</div>
                            @endif

                            <p class="product-description">{{ Str::limit($product->description, 120) }}</p>

                            <div class="product-actions">
                                <a href="{{ route('products.show', $product->slug) }}" class="btn-primary-gradient">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="text-center mt-5">
                    {{ $products->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <h3>Chưa có sản phẩm nổi bật nào</h3>
                    <p class="text-muted">Hãy quay lại sau hoặc <a href="{{ route('products.index') }}">xem tất cả sản phẩm</a></p>
                </div>
                @endif
            </div>
        </section>
        <!-- /Featured Products -->

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-item">
                            <div class="stat-number">{{ $products->total() }}+</div>
                            <div class="stat-label">Sản phẩm nổi bật</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-item">
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Chất lượng đảm bảo</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-item">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Hỗ trợ khách hàng</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-item">
                            <div class="stat-number">5⭐</div>
                            <div class="stat-label">Đánh giá trung bình</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Stats Section -->

        <x-footer />
    </div>
@endsection
