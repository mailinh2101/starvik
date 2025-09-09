@extends('layouts.app')

@section('title', 'Tất cả sản phẩm - Star Vik')
@section('description', 'Khám phá bộ sưu tập sản phẩm đa dạng của Star Vik - từ đồ gia dụng đến thực phẩm chức năng')
@section('keywords', 'sản phẩm, đồ gia dụng, thực phẩm chức năng, star vik')

@push('head')
<!-- Products Index Page Styles -->
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
<link rel="stylesheet" href="{{ asset('css/products-index.css') }}">
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
                        <span class="text">Sản phẩm</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Breadcrumb -->

        <!-- Products Section -->
        <section class="tf-products">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <!-- Filters -->
                        <div class="product-filters">
                            <h4 class="mb-3">Bộ lọc sản phẩm</h4>

                            <!-- Search -->
                            <form action="{{ route('products.search') }}" method="GET" class="filter-group">
                                <label class="filter-label">Tìm kiếm</label>
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Nhập từ khóa..." value="{{ request('q') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="icon-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>

                            <!-- Category Filter -->
                            <div class="filter-group">
                                <label class="filter-label">Danh mục</label>
                                <select class="form-select" onchange="filterByCategory(this.value)">
                                    <option value="">Tất cả danh mục</option>
                                    <!-- Categories will be populated by JavaScript -->
                                </select>
                            </div>

                            <!-- Featured Filter -->
                            <div class="filter-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="featuredOnly" onchange="filterFeatured(this.checked)">
                                    <label class="form-check-label" for="featuredOnly">
                                        Chỉ sản phẩm nổi bật
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8">
                        <!-- Products Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="page-title">Tất cả sản phẩm</h1>
                            <div class="products-count">
                                <span class="text-muted">{{ $products->total() }} sản phẩm</span>
                            </div>
                        </div>

                        @if($products->count() > 0)
                        <!-- Products Grid -->
                        <div class="product-grid">
                            @foreach($products as $product)
                            <div class="product-card">
                                @if($product->is_featured)
                                <div class="product-featured">Nổi bật</div>
                                @endif

                                <div class="product-image">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
                                    </a>
                                </div>

                                <div class="product-content">
                                    @if($product->category)
                                    <div class="product-category">{{ ucfirst($product->category) }}</div>
                                    @endif

                                    @if($product->brand)
                                    <div class="product-brand">{{ $product->brand }}</div>
                                    @endif

                                    <h3 class="product-title">
                                        <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>

                                    <p class="product-description">{!! Str::limit($product->seo_title, 100, ' (...)') !!}</p>

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
                            {{ $products->links() }}
                        </div>
                        @else
                        <div class="no-products">
                            <h3>Không có sản phẩm nào</h3>
                            <p>Hãy thử lại với bộ lọc khác hoặc liên hệ với chúng tôi để được tư vấn.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- /Products Section -->

        <x-footer />
    </div>
@endsection

@push('scripts')
<!-- Products Index Page JavaScript -->
<script src="{{ asset('js/products-index.js') }}"></script>
@endpush
