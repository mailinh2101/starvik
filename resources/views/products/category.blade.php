@extends('layouts.app')

@section('title', 'Danh mục ' . ucfirst($category) . ' - Star Vik')
@section('description', 'Khám phá sản phẩm trong danh mục ' . $category . ' tại Star Vik - Chất lượng cao, giá cả hợp lý')
@section('keywords', $category . ', sản phẩm ' . $category . ', star vik, đồ gia dụng, thực phẩm chức năng')

@push('head')
<!-- Category Page Styles -->
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
<link rel="stylesheet" href="{{ asset('css/products-category.css') }}">
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
                        <span class="text">{{ ucfirst($category) }}</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Breadcrumb -->

        <!-- Category Header -->
        <section class="category-header">
            <div class="container">
                <div class="category-content text-center">
                    <h1 class="category-title">{{ ucfirst($category) }}</h1>
                    <p class="category-description">Khám phá bộ sưu tập {{ $category }} chất lượng cao tại Star Vik</p>
                </div>
            </div>
        </section>
        <!-- /Category Header -->

        <!-- Category Stats -->
        <section class="tf-category-stats">
            <div class="container">
                <div class="category-stats">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">{{ $products->total() }}</span>
                            <span class="stat-label">Sản phẩm</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $products->unique('brand')->count() }}</span>
                            <span class="stat-label">Thương hiệu</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Chất lượng</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Hỗ trợ</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Category Stats -->

        <!-- Category Products -->
        <section class="tf-category-products" data-category="{{ $category }}">
            <div class="container">
                @if($products->count() > 0)
                <!-- Filter Bar -->
                <div class="filter-bar">
                    <div class="filter-left">
                        <strong>{{ $products->total() }} sản phẩm</strong>
                        <select class="sort-select">
                            <option value="default">Sắp xếp mặc định</option>
                            <option value="name_asc">Tên A-Z</option>
                            <option value="name_desc">Tên Z-A</option>
                            <option value="newest">Mới nhất</option>
                            <option value="oldest">Cũ nhất</option>
                        </select>
                    </div>
                    <div class="view-toggle">
                        <button class="view-btn active" data-view="grid">
                            <span class="icon icon-grid"></span>
                        </button>
                        <button class="view-btn" data-view="list">
                            <span class="icon icon-list"></span>
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="product-grid" id="productGrid">
                    @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
                            </a>
                        </div>

                        <div class="product-content">
                            <div class="product-info">
                                <span class="product-category-badge">{{ ucfirst($category) }}</span>

                                @if($product->brand)
                                <div class="product-brand">{{ $product->brand }}</div>
                                @endif

                                <h3 class="product-title">
                                    <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h3>

                                <p class="product-description">{!! Str::limit($product->seo_title, 120) !!}</p>
                            </div>

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
                <!-- No Products -->
                <div class="no-products">
                    <div class="no-products-icon">
                        <span class="icon icon-box"></span>
                    </div>
                    <h3>Chưa có sản phẩm nào trong danh mục này</h3>
                    <p>Danh mục <strong>{{ $category }}</strong> hiện tại chưa có sản phẩm nào. Hãy quay lại sau hoặc khám phá các danh mục khác.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        Xem tất cả sản phẩm
                    </a>
                </div>

                <!-- Related Categories -->
                <div class="related-categories">
                    <h4>Danh mục khác</h4>
                    <p class="text-muted">Khám phá các danh mục sản phẩm khác tại Star Vik:</p>
                    <div class="category-tags" id="relatedCategories">
                        <!-- Categories will be loaded via JavaScript -->
                    </div>
                </div>
                @endif
            </div>
        </section>
        <!-- /Category Products -->

        <x-footer />
    </div>
@endsection

@push('scripts')
<!-- Category Page JavaScript -->
<script src="{{ asset('js/products-category.js') }}"></script>
@endpush
