@extends('layouts.app')

@section('title', 'Tìm kiếm sản phẩm: ' . $query . ' - Star Vik')
@section('description', 'Kết quả tìm kiếm cho "' . $query . '" - Khám phá sản phẩm chất lượng tại Star Vik')
@section('keywords', $query . ', tìm kiếm sản phẩm, star vik, đồ gia dụng, thực phẩm chức năng')

@push('head')
<!-- Products Search Page Styles -->
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
<link rel="stylesheet" href="{{ asset('css/products-search.css') }}">
<!-- Add search term for JavaScript -->
<meta name="search-term" content="{{ $query }}">
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
                        <span class="text">Tìm kiếm</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Breadcrumb -->

        <!-- Search Header -->
        <section class="search-header">
            <div class="container">
                <div class="text-center">
                    <h1 class="mb-3">Kết quả tìm kiếm</h1>
                    <p class="mb-0">Từ khóa: <span class="search-query">"{{ $query }}"</span></p>
                </div>
            </div>
        </section>
        <!-- /Search Header -->

        <!-- Search Results -->
        <section class="tf-search-results">
            <div class="container">
                @if($products->count() > 0)
                <!-- Search Stats -->
                <div class="search-stats">
                    <div>
                        <strong>{{ $products->total() }}</strong> sản phẩm được tìm thấy
                    </div>
                    <div>
                        <span class="text-muted">Trang {{ $products->currentPage() }} / {{ $products->lastPage() }}</span>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="product-grid">
                    @foreach($products as $product)
                    <div class="product-card">
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
                                <a href="{{ route('products.show', $product->slug) }}" class="btn-view">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $products->appends(['q' => $query])->links() }}
                </div>
                @else
                <!-- No Results -->
                <div class="no-results">
                    <div class="no-results-icon">
                        <span class="icon icon-magnifying-glass"></span>
                    </div>
                    <h3>Không tìm thấy sản phẩm nào</h3>
                    <p>Không có sản phẩm nào phù hợp với từ khóa <strong>"{{ $query }}"</strong></p>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('products.search') }}" class="mb-4">
                        <div class="input-group justify-content-center">
                            <input type="text" name="q" class="form-control" placeholder="Thử từ khóa khác..." style="max-width: 300px;">
                            <button class="btn btn-primary" type="submit">
                                <span class="icon icon-magnifying-glass"></span> Tìm kiếm
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                        Xem tất cả sản phẩm
                    </a>
                </div>

                <!-- Search Suggestions -->
                <div class="search-suggestions">
                    <h4>Gợi ý tìm kiếm</h4>
                    <p class="text-muted">Thử tìm kiếm với các từ khóa phổ biến:</p>
                    <div class="suggestion-tags">
                        <a href="{{ route('products.search', ['q' => 'máy xay']) }}" class="suggestion-tag">Máy xay</a>
                        <a href="{{ route('products.search', ['q' => 'sinh tố']) }}" class="suggestion-tag">Sinh tố</a>
                        <a href="{{ route('products.search', ['q' => 'đồ gia dụng']) }}" class="suggestion-tag">Đồ gia dụng</a>
                        <a href="{{ route('products.search', ['q' => 'thực phẩm chức năng']) }}" class="suggestion-tag">Thực phẩm chức năng</a>
                        <a href="{{ route('products.search', ['q' => 'máy đo huyết áp']) }}" class="suggestion-tag">Máy đo huyết áp</a>
                        <a href="{{ route('products.search', ['q' => 'massage']) }}" class="suggestion-tag">Massage</a>
                    </div>
                </div>
                @endif
            </div>
        </section>
        <!-- /Search Results -->

        <x-footer />
    </div>
@endsection

@push('scripts')
<!-- Products Search Page JavaScript -->
<script src="{{ asset('js/products-search.js') }}"></script>
@endpush
