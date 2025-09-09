<!-- Product Details Section -->
<section class="flat-spacing-4 pt_0">
    <div class="tf-main-product section-image-zoom">
        <div class="container">
            <div class="row">
                <!-- Product Image Column -->
                <div class="col-lg-6 col-md-6">
                    <div class="tf-product-media-wrap sticky-top">
                        <!-- Main Product Image -->
                        <div class="tf-product-media-main">
                            @if(isset($product))
                                <img id="mainProductImage" src="{{ $product->main_image }}" alt="{{ $product->name }}" class="img-fluid main-product-image">

                                @if($product->is_featured)
                                    <div class="product-badge featured-badge">
                                        <span class="badge-text">Nổi bật</span>
                                    </div>
                                @endif
                            @else
                                <img id="mainProductImage" src="{{ asset('images/product-1.jpg') }}" alt="Sản phẩm" class="img-fluid main-product-image">
                            @endif

                            <!-- Image Zoom Overlay -->
                            <div class="image-zoom-overlay" id="imageZoomOverlay">
                                <i class="icon icon-zoom-in"></i>
                                <span>Xem ảnh lớn</span>
                            </div>
                        </div>

                        <!-- Product Gallery Thumbnails -->
                        @if(isset($product) && ($product->gallery_images || $product->gallery))
                            <div class="tf-product-media-thumbs">
                                <div class="thumbs-wrapper">
                                    <!-- Main image as first thumbnail -->
                                    <div class="thumb-item active" data-image="{{ $product->main_image }}">
                                        <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="img-fluid">
                                    </div>

                                    <!-- Gallery images -->
                                    @php
                                        $galleryImages = $product->gallery_images ?? [];
                                        if (empty($galleryImages) && $product->gallery) {
                                            $galleryImages = is_array($product->gallery)
                                                ? $product->gallery
                                                : json_decode($product->gallery, true);
                                        }
                                    @endphp

                                    @if($galleryImages && is_array($galleryImages))
                                        @foreach($galleryImages as $index => $image)
                                            <div class="thumb-item" data-image="{{ is_string($image) && str_starts_with($image, 'http') ? $image : asset($image) }}">
                                                <img src="{{ is_string($image) && str_starts_with($image, 'http') ? $image : asset($image) }}" alt="{{ $product->name }} {{ $index + 2 }}" class="img-fluid">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Information Column -->
                <div class="col-lg-6 col-md-6">
                    <div class="tf-product-info-wrap">
                        <!-- Breadcrumb -->
                        <div class="product-breadcrumb mb-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                                    @if(isset($product) && $product->category)
                                        <li class="breadcrumb-item"><a href="{{ route('products.category', $product->category) }}">{{ $product->category }}</a></li>
                                    @endif
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ isset($product) ? Str::limit($product->name, 30) : 'Chi tiết sản phẩm' }}
                                    </li>
                                </ol>
                            </nav>
                        </div>

                        <!-- Product Title & Meta -->
                        <div class="tf-product-info-heading">
                            <h1 class="tf-product-info-title">
                                @if(isset($product))
                                    {{ $product->name }}
                                @else
                                    Tên sản phẩm mẫu
                                @endif
                            </h1>

                            <!-- Product Meta Info -->
                            @if(isset($product))
                                <div class="product-meta-info">
                                    @if($product->brand)
                                        <div class="meta-item">
                                            <span class="meta-label">Thương hiệu:</span>
                                            <span class="meta-value brand-name">{{ $product->brand }}</span>
                                        </div>
                                    @endif

                                    @if($product->category)
                                        <div class="meta-item">
                                            <span class="meta-label">Danh mục:</span>
                                            <a href="{{ route('products.category', $product->category) }}" class="meta-value category-link">{{ $product->category }}</a>
                                        </div>
                                    @endif

                                    <div class="meta-item">
                                        <span class="meta-label">Mã sản phẩm:</span>
                                        <span class="meta-value product-sku">#SP{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Product Description -->
                        <div class="tf-product-info-description">
                            <h5 class="section-title">Mô tả sản phẩm</h5>
                            <div class="description-content">
                                <p>
                                    @if(isset($product) && $product->description)
                                        {{ $product->description }}
                                    @else
                                        Đây là mô tả chi tiết về sản phẩm. Sản phẩm được thiết kế với chất lượng cao,
                                        công nghệ hiện đại và phù hợp với nhu cầu sử dụng hàng ngày của mọi gia đình.
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Product Specifications -->
                        @if(isset($product) && $product->specifications)
                            <div class="tf-product-info-specs">
                                <h5 class="section-title">Thông số kỹ thuật</h5>
                                <div class="specs-table">
                                    @php
                                        $specs = is_array($product->specifications) ? $product->specifications : json_decode($product->specifications, true);
                                    @endphp
                                    @if($specs && is_array($specs))
                                        @foreach($specs as $key => $value)
                                            <div class="spec-row">
                                                <div class="spec-label">{{ $key }}</div>
                                                <div class="spec-value">{{ $value }}</div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Product Features -->
                        <div class="product-features">
                            <h5 class="section-title">Ưu điểm nổi bật</h5>
                            <div class="features-list">
                                <div class="feature-item">
                                    <i class="icon icon-check-circle"></i>
                                    <span>Chất lượng cao, bền bỉ</span>
                                </div>
                                <div class="feature-item">
                                    <i class="icon icon-check-circle"></i>
                                    <span>Thiết kế hiện đại, tiện dụng</span>
                                </div>
                                <div class="feature-item">
                                    <i class="icon icon-check-circle"></i>
                                    <span>Bảo hành chính hãng</span>
                                </div>
                                <div class="feature-item">
                                    <i class="icon icon-check-circle"></i>
                                    <span>Hỗ trợ kỹ thuật 24/7</span>
                                </div>
                            </div>
                        </div>

                        <!-- Contact & Action Section -->
                        <div class="product-action-section">
                            <div class="contact-info-card">
                                <h5 class="card-title">
                                    <i class="icon icon-headphone"></i>
                                    Liên hệ tư vấn
                                </h5>
                                <div class="contact-details">
                                    <div class="contact-item">
                                        <i class="icon icon-phone"></i>
                                        <div class="contact-content">
                                            <span class="contact-label">Hotline</span>
                                            <a href="tel:0916976795" class="contact-value">091 697 6795</a>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <i class="icon icon-mail"></i>
                                        <div class="contact-content">
                                            <span class="contact-label">Email</span>
                                            <a href="mailto:info@starvik.com" class="contact-value">info@starvik.com</a>
                                        </div>
                                    </div>
                                    <div class="contact-item">
                                        <i class="icon icon-location"></i>
                                        <div class="contact-content">
                                            <span class="contact-label">Địa chỉ</span>
                                            <span class="contact-value">Tp. Hồ Chí Minh</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <button type="button" class="tf-btn btn-primary btn-lg" onclick="contactForAdvice()">
                                    <i class="icon icon-phone"></i>
                                    Gọi ngay để tư vấn
                                </button>
                                <button type="button" class="tf-btn btn-outline-primary btn-lg" onclick="contactForAdvice()">
                                    <i class="icon icon-mail"></i>
                                    Gửi yêu cầu tư vấn
                                </button>
                                <button type="button" class="tf-btn btn-outline-secondary btn-lg" onclick="shareProduct()">
                                    <i class="icon icon-share"></i>
                                    Chia sẻ sản phẩm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<section class="flat-spacing-2 pt_0">
    <div class="container">
        <div class="flat-title text-center">
            <span class="title wow fadeInUp" data-wow-delay="0s">Sản phẩm liên quan</span>
            <p class="sub-title wow fadeInUp" data-wow-delay="0.1s">Khám phá thêm các sản phẩm tương tự</p>
        </div>
        <div class="hover-sw-nav hover-sw-2 wow fadeInUp" data-wow-delay="0.2s">
            <div class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="20" data-space="15">
                <div class="swiper-wrapper">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="swiper-slide">
                            <div class="card-product style-8">
                                <div class="card-product-wrapper">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}" class="product-img">
                                        <img class="lazyload img-product" src="{{ $relatedProduct->main_image }}" alt="{{ $relatedProduct->name }}">
                                        <img class="lazyload img-hover" src="{{ $relatedProduct->main_image }}" alt="{{ $relatedProduct->name }}">
                                    </a>

                                    @if($relatedProduct->is_featured)
                                        <div class="list-product-btn absolute-2">
                                            <div class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="tooltip">Nổi bật</span>
                                                <span class="icon icon-star"></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-product-info text-center">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}" class="title link fw-6">{{ $relatedProduct->name }}</a>
                                    @if($relatedProduct->category)
                                        <span class="price text-primary fw-5">{{ $relatedProduct->category }}</span>
                                    @endif
                                    @if($relatedProduct->brand)
                                        <p class="brand-name text-secondary">{{ $relatedProduct->brand }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round">
                <span class="icon icon-arrow-left"></span>
            </div>
            <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round">
                <span class="icon icon-arrow-right"></span>
            </div>
            <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
        </div>
    </div>
</section>
@endif

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ isset($product) ? $product->name : 'Hình ảnh sản phẩm' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<style>
/* Product Media Styles */
.tf-product-media-wrap {
    position: relative;
}

.tf-product-media-main {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.main-product-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.main-product-image:hover {
    transform: scale(1.05);
}

.product-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 3;
}

.featured-badge .badge-text {
    background: linear-gradient(135deg, #ff6b6b, #ffd93d);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 3px 10px rgba(255, 107, 107, 0.3);
}

.image-zoom-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    cursor: pointer;
    color: white;
}

.tf-product-media-main:hover .image-zoom-overlay {
    opacity: 1;
}

.image-zoom-overlay i {
    font-size: 2rem;
    margin-bottom: 8px;
}

/* Thumbnails */
.tf-product-media-thumbs {
    margin-top: 15px;
}

.thumbs-wrapper {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.thumb-item {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
}

.thumb-item.active {
    border-color: #007bff;
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
}

.thumb-item:hover {
    border-color: #007bff;
}

.thumb-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Product Info Styles */
.tf-product-info-wrap {
    padding: 0 20px;
}

.product-breadcrumb .breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
    font-size: 14px;
}

.product-breadcrumb .breadcrumb-item a {
    color: #6c757d;
    text-decoration: none;
}

.product-breadcrumb .breadcrumb-item a:hover {
    color: #007bff;
}

.tf-product-info-title {
    font-size: 2.25rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #333;
    line-height: 1.3;
}

.product-meta-info {
    margin-bottom: 2rem;
}

.meta-item {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
}

.meta-label {
    font-weight: 600;
    color: #666;
    min-width: 120px;
}

.meta-value {
    color: #333;
}

.brand-name {
    font-weight: 600;
    color: #007bff;
}

.category-link {
    color: #28a745;
    text-decoration: none;
}

.category-link:hover {
    color: #1e7e34;
    text-decoration: underline;
}

.product-sku {
    font-family: 'Courier New', monospace;
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 13px;
}

/* Section Titles */
.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    border-bottom: 2px solid #007bff;
    padding-bottom: 8px;
    display: inline-block;
}

/* Description */
.tf-product-info-description {
    margin-bottom: 2rem;
}

.description-content p {
    line-height: 1.7;
    color: #555;
    font-size: 16px;
}

/* Specifications */
.tf-product-info-specs {
    margin-bottom: 2rem;
}

.specs-table {
    background: #f8f9fa;
    border-radius: 8px;
    overflow: hidden;
}

.spec-row {
    display: flex;
    padding: 12px 16px;
    border-bottom: 1px solid #e9ecef;
}

.spec-row:last-child {
    border-bottom: none;
}

.spec-label {
    font-weight: 600;
    color: #495057;
    min-width: 140px;
    flex-shrink: 0;
}

.spec-value {
    color: #333;
    flex: 1;
}

/* Features */
.product-features {
    margin-bottom: 2rem;
}

.features-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
}

.feature-item {
    display: flex;
    align-items: center;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #28a745;
}

.feature-item i {
    color: #28a745;
    margin-right: 10px;
    font-size: 18px;
}

.feature-item span {
    color: #333;
    font-weight: 500;
}

/* Contact & Action Section */
.product-action-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 2rem;
    border-radius: 12px;
    margin-top: 2rem;
}

.contact-info-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
}

.contact-info-card .card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

.contact-info-card .card-title i {
    margin-right: 8px;
    color: #007bff;
}

.contact-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}

.contact-item:last-child {
    border-bottom: none;
}

.contact-item i {
    width: 20px;
    color: #007bff;
    margin-right: 12px;
}

.contact-content {
    flex: 1;
}

.contact-label {
    display: block;
    font-size: 12px;
    color: #666;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.contact-value {
    display: block;
    color: #333;
    font-weight: 600;
    text-decoration: none;
    margin-top: 2px;
}

.contact-value:hover {
    color: #007bff;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.tf-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 14px 20px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    cursor: pointer;
}

.tf-btn i {
    margin-right: 8px;
    font-size: 16px;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
}

.btn-outline-primary {
    background: transparent;
    color: #007bff;
    border-color: #007bff;
}

.btn-outline-primary:hover {
    background: #007bff;
    color: white;
}

.btn-outline-secondary {
    background: transparent;
    color: #6c757d;
    border-color: #6c757d;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    color: white;
}

/* Related Products */
.card-product.style-8 {
    border: 1px solid #e9ecef;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: white;
}

.card-product.style-8:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

/* Responsive Design */
@media (max-width: 992px) {
    .tf-product-info-wrap {
        padding: 20px 0;
    }

    .tf-product-info-title {
        font-size: 1.75rem;
    }

    .main-product-image {
        height: 350px;
    }
}

@media (max-width: 768px) {
    .tf-product-info-title {
        font-size: 1.5rem;
    }

    .main-product-image {
        height: 300px;
    }

    .features-list {
        grid-template-columns: 1fr;
    }

    .action-buttons {
        margin-top: 1rem;
    }

    .meta-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .meta-label {
        min-width: auto;
        margin-bottom: 4px;
    }
}

@media (max-width: 576px) {
    .thumbs-wrapper {
        justify-content: center;
    }

    .thumb-item {
        width: 60px;
        height: 60px;
    }

    .product-action-section {
        padding: 1.5rem;
    }
}

/* Contact Modal Styles */
.contact-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.3s ease;
}

.contact-modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 0;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    animation: slideIn 0.3s ease;
}

.contact-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    border-bottom: 1px solid #eee;
    background-color: #f8f9fa;
    border-radius: 8px 8px 0 0;
}

.contact-modal-header h4 {
    margin: 0;
    color: #333;
    font-weight: 600;
}

.contact-modal-close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease;
}

.contact-modal-close:hover,
.contact-modal-close:focus {
    color: #333;
}

.contact-modal-body {
    padding: 25px;
}

.contact-modal-body p {
    margin-bottom: 15px;
    color: #555;
}

.contact-options {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 20px;
}

.contact-options .btn {
    padding: 12px 20px;
    border-radius: 6px;
    font-weight: 500;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.contact-options .btn-success {
    background-color: #28a745;
    color: white;
}

.contact-options .btn-success:hover {
    background-color: #218838;
    transform: translateY(-2px);
}

.contact-options .btn-primary {
    background-color: #25D366;
    color: white;
}

.contact-options .btn-primary:hover {
    background-color: #128C7E;
    transform: translateY(-2px);
}

.contact-options .btn-info {
    background-color: #17a2b8;
    color: white;
}

.contact-options .btn-info:hover {
    background-color: #138496;
    transform: translateY(-2px);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { 
        opacity: 0;
        transform: translateY(-30px);
    }
    to { 
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .contact-modal-content {
        margin: 20% auto;
        width: 95%;
    }
    
    .contact-modal-header {
        padding: 15px 20px;
    }
    
    .contact-modal-body {
        padding: 20px;
    }
    
    .contact-options {
        gap: 12px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail click handler
    const thumbnails = document.querySelectorAll('.thumb-item');
    const mainImage = document.getElementById('mainProductImage');
    const modalImage = document.getElementById('modalImage');

    thumbnails.forEach(function(thumb) {
        thumb.addEventListener('click', function() {
            const newImageSrc = this.getAttribute('data-image');
            if (mainImage && newImageSrc) {
                mainImage.src = newImageSrc;

                // Update active thumbnail
                thumbnails.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });

    // Initialize modal image
    if (mainImage && modalImage) {
        modalImage.src = mainImage.src;
        modalImage.alt = mainImage.alt;
    }

    // Add click handler for zoom overlay
    const zoomOverlay = document.getElementById('imageZoomOverlay');
    if (zoomOverlay) {
        zoomOverlay.addEventListener('click', function() {
            window.openImageModal();
        });
    }

    // Global function for image modal - attach to window
    window.openImageModal = function() {
        const mainImage = document.getElementById('mainProductImage');
        const modalImage = document.getElementById('modalImage');

        if (mainImage && modalImage) {
            modalImage.src = mainImage.src;
            modalImage.alt = mainImage.alt;

            // Check if Bootstrap is available
            if (typeof bootstrap !== 'undefined') {
                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                modal.show();
            } else {
                // Fallback: Create simple modal
                showSimpleModal(mainImage.src, mainImage.alt);
            }
        }
    };

    // Simple modal fallback function
    function showSimpleModal(imageSrc, imageAlt) {
        // Create overlay
        const overlay = document.createElement('div');
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        `;

        // Create image
        const img = document.createElement('img');
        img.src = imageSrc;
        img.alt = imageAlt;
        img.style.cssText = `
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 8px;
        `;

        // Create close button
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = '×';
        closeBtn.style.cssText = `
            position: absolute;
            top: 20px;
            right: 30px;
            background: white;
            border: none;
            font-size: 30px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10000;
        `;

        overlay.appendChild(img);
        overlay.appendChild(closeBtn);
        document.body.appendChild(overlay);

        // Close modal handlers
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay || e.target === closeBtn) {
                document.body.removeChild(overlay);
            }
        });

        // ESC key handler
        const escHandler = function(e) {
            if (e.key === 'Escape') {
                document.body.removeChild(overlay);
                document.removeEventListener('keydown', escHandler);
            }
        };
        document.addEventListener('keydown', escHandler);
    }
});

// Action functions - attach to window for global access
window.contactForAdvice = function() {
    const productName = document.querySelector('.tf-product-info-title')?.textContent || 'Sản phẩm';
    const modal = createAdviceModal(productName);
    document.body.appendChild(modal);
    modal.style.display = 'block';
};

function createAdviceModal(productName) {
    const modal = document.createElement('div');
    modal.className = 'contact-modal';
    modal.innerHTML = `
        <div class="contact-modal-content">
            <div class="contact-modal-header">
                <h4>Liên hệ tư vấn sản phẩm</h4>
                <span class="contact-modal-close">&times;</span>
            </div>
            <div class="contact-modal-body">
                <p><strong>Sản phẩm:</strong> ${productName}</p>
                <p>Chọn cách liên hệ:</p>
                <div class="contact-options">
                    <button class="btn btn-success" onclick="callDirectAdvice()">
                        <i class="fas fa-phone"></i> Gọi ngay: 091 697 6795
                    </button>
                    <button class="btn btn-primary" onclick="contactWhatsAppAdvice('${productName}')">
                        <i class="fab fa-whatsapp"></i> Chat WhatsApp
                    </button>
                    <button class="btn btn-info" onclick="sendEmailAdvice('${productName}')">
                        <i class="fas fa-envelope"></i> Gửi Email
                    </button>
                </div>
            </div>
        </div>
    `;

    // Add event listener for close button
    modal.querySelector('.contact-modal-close').addEventListener('click', function() {
        modal.remove();
    });

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.remove();
        }
    });

    return modal;
}

window.callDirectAdvice = function() {
    window.location.href = 'tel:0916976795';
    const modal = document.querySelector('.contact-modal');
    if (modal) modal.remove();
};

window.contactWhatsAppAdvice = function(productName) {
    const message = `Tôi muốn tư vấn về sản phẩm: ${productName}`;
    const phone = "84916976795";
    const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
    const modal = document.querySelector('.contact-modal');
    if (modal) modal.remove();
};

window.sendEmailAdvice = function(productName) {
    const subject = encodeURIComponent('Yêu cầu tư vấn sản phẩm: ' + productName);
    const body = encodeURIComponent('Xin chào StarVik,\n\nTôi muốn được tư vấn về sản phẩm: ' + productName + '\n\nVui lòng liên hệ lại với tôi.\n\nCảm ơn!');
    window.location.href = `mailto:info@starvik.com?subject=${subject}&body=${body}`;
    const modal = document.querySelector('.contact-modal');
    if (modal) modal.remove();
};

// Keep old functions for backward compatibility
window.callNow = function() {
    window.location.href = 'tel:0916976795';
};

window.sendEmail = function() {
    const subject = encodeURIComponent('Yêu cầu tư vấn sản phẩm: ' + (document.querySelector('.tf-product-info-title')?.textContent || 'Sản phẩm'));
    const body = encodeURIComponent('Xin chào StarVik,\n\nTôi muốn được tư vấn về sản phẩm này. Vui lòng liên hệ lại với tôi.\n\nCảm ơn!');
    window.location.href = `mailto:info@starvik.com?subject=${subject}&body=${body}`;
};

window.shareProduct = function() {
    if (navigator.share) {
        navigator.share({
            title: document.querySelector('.tf-product-info-title')?.textContent || 'Sản phẩm StarVik',
            text: 'Xem sản phẩm này từ StarVik',
            url: window.location.href
        }).catch(function(error) {
            console.log('Error sharing:', error);
            // Fallback to copy URL
            copyToClipboard();
        });
    } else {
        // Fallback: copy URL to clipboard
        copyToClipboard();
    }
};

function copyToClipboard() {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(window.location.href).then(function() {
            showNotification('Đã sao chép link sản phẩm vào clipboard!');
        }).catch(function(error) {
            console.log('Error copying to clipboard:', error);
            fallbackCopyText(window.location.href);
        });
    } else {
        fallbackCopyText(window.location.href);
    }
}

function fallbackCopyText(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '-999999px';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        document.execCommand('copy');
        showNotification('Đã sao chép link sản phẩm!');
    } catch (error) {
        console.log('Error copying text:', error);
        showNotification('Không thể sao chép. Vui lòng copy thủ công: ' + text);
    }

    document.body.removeChild(textArea);
}

function showNotification(message) {
    // Create notification
    const notification = document.createElement('div');
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #28a745;
        color: white;
        padding: 12px 20px;
        border-radius: 6px;
        z-index: 10000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        font-size: 14px;
        max-width: 300px;
        word-wrap: break-word;
    `;

    document.body.appendChild(notification);

    // Auto remove after 3 seconds
    setTimeout(function() {
        if (document.body.contains(notification)) {
            document.body.removeChild(notification);
        }
    }, 3000);
}

// Sticky sidebar on scroll (desktop)
window.addEventListener('scroll', function() {
    if (window.innerWidth > 992) {
        const mediaWrap = document.querySelector('.tf-product-media-wrap');
        if (mediaWrap) {
            const scrollTop = window.pageYOffset;
            const offsetTop = mediaWrap.offsetTop;

            if (scrollTop > offsetTop - 20) {
                mediaWrap.style.position = 'sticky';
                mediaWrap.style.top = '20px';
            } else {
                mediaWrap.style.position = 'relative';
                mediaWrap.style.top = 'auto';
            }
        }
    }
});

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Add click handlers for action buttons if they exist
    const adviceButtons = document.querySelectorAll('[onclick="contactForAdvice()"]');
    adviceButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            window.contactForAdvice();
        });
    });

    // Keep backward compatibility
    const callButton = document.querySelector('[onclick="callNow()"]');
    if (callButton) {
        callButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.callNow();
        });
    }

    const emailButton = document.querySelector('[onclick="sendEmail()"]');
    if (emailButton) {
        emailButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.sendEmail();
        });
    }

    const shareButton = document.querySelector('[onclick="shareProduct()"]');
    if (shareButton) {
        shareButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.shareProduct();
        });
    }
});
</script>

<!-- Related Products Section -->
@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<section class="flat-spacing-1 pt_0">
    <div class="container">
        <div class="flat-title">
            <span class="title">Sản phẩm liên quan</span>
        </div>
        <div class="hover-sw-nav hover-sw-2">
            <div class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                <div class="swiper-wrapper">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="swiper-slide">
                            <div class="card-product">
                                <div class="card-product-wrapper">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}" class="product-img">
                                        <img class="lazyload img-product" src="{{ $relatedProduct->main_image }}" alt="{{ $relatedProduct->name }}">
                                    </a>
                                </div>
                                <div class="card-product-info">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}" class="title link">{{ $relatedProduct->name }}</a>
                                    @if($relatedProduct->category)
                                        <span class="badge bg-light text-dark">{{ $relatedProduct->category }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
            <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
            <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
        </div>
    </div>
</section>
@endif

<style>
.tf-product-media-main img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.thumbnail {
    border: 2px solid transparent;
    border-radius: 4px;
    transition: border-color 0.3s ease;
}

.thumbnail:hover {
    border-color: #007bff;
}

.tf-product-info-wrap {
    padding: 20px;
}

.tf-product-info-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1rem;
    color: #333;
}

.tf-product-info-meta .badge {
    font-size: 0.85rem;
    padding: 0.5rem 1rem;
}

.tf-product-info-description p {
    line-height: 1.6;
    color: #666;
}

.tf-product-info-specs .row > div {
    padding: 0.25rem 0;
    border-bottom: 1px solid #eee;
}

.tf-product-info-contact {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.tf-product-info-actions .tf-btn {
    padding: 12px 24px;
    border-radius: 6px;
    font-weight: 500;
}

.tf-btn.btn-fill {
    background-color: #007bff;
    color: white;
    border: none;
}

.tf-btn.btn-fill:hover {
    background-color: #0056b3;
}

.tf-btn.btn-outline {
    background-color: transparent;
    color: #007bff;
    border: 2px solid #007bff;
}

.tf-btn.btn-outline:hover {
    background-color: #007bff;
    color: white;
}

@media (max-width: 768px) {
    .tf-product-info-title {
        font-size: 1.5rem;
    }

    .tf-product-info-wrap {
        padding: 15px;
        margin-top: 20px;
    }
}
</style>

<script>
// Gallery thumbnail click handler
document.querySelectorAll('.thumbnail').forEach(function(thumb) {
    thumb.addEventListener('click', function() {
        const mainImage = document.querySelector('.tf-product-media-main img');
        if (mainImage) {
            mainImage.src = this.src;
            mainImage.alt = this.alt;
        }

        // Update active thumbnail
        document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>