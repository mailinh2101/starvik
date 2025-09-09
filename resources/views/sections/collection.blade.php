<!-- Collection Section -->
<!-- Collection -->
<section class="themesFlat">
    <div class="container">
        <div class="sect-title text-center wow fadeInUp">
            <h1 class="title mb-8">Sản phẩm nổi bật</h1>
        </div>

        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        <div dir="ltr" class="swiper tf-swiper wow fadeInUp" data-preview="5" data-tablet="4" data-mobile-sm="3"
            data-mobile="2" data-space-lg="40" data-space-md="32" data-space="12" data-pagination="2"
            data-pagination-sm="3" data-pagination-md="4" data-pagination-lg="5">
            <div class="swiper-wrapper">
                @foreach($featuredProducts as $product)
                <div class="swiper-slide">
                    <a href="{{ route('products.show', $product) }}" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ $product->image_url }}"
                                data-src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </div>
                        @if($product->brand)
                            <div class="collection_brand">{{ $product->brand }}</div>
                        @endif
                        <h5 class="collection_name fw-semibold link">{{ $product->name }}</h5>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="sw-dot-default tf-sw-pagination"></div>
        </div>
        @else
        <!-- Fallback to static content if no products -->
        <div dir="ltr" class="swiper tf-swiper wow fadeInUp" data-preview="5" data-tablet="4" data-mobile-sm="3"
            data-mobile="2" data-space-lg="40" data-space-md="32" data-space="12" data-pagination="2"
            data-pagination-sm="3" data-pagination-md="4" data-pagination-lg="5">
            <div class="swiper-wrapper">
                <!-- item 1 -->
                <div class="swiper-slide">
                    <a href="{{ route('products.index') }}" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-10.jpg') }}"
                                data-src="{{ asset('images/collections/cls-10.jpg') }}" alt="CLS">
                        </div>
                        <h5 class="collection_name fw-semibold link">Máy Đo Huyết Áp</h5>
                    </a>
                </div>
                <!-- item 2 -->
                <div class="swiper-slide">
                    <a href="{{ route('products.index') }}" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-11.jpg') }}"
                                data-src="{{ asset('images/collections/cls-11.jpg') }}" alt="CLS">
                        </div>
                        <h5 class="collection_name fw-semibold link">Máy xay thịt Perfekt</h5>
                    </a>
                </div>
                <!-- item 3 -->
                <div class="swiper-slide">
                    <a href="{{ route('products.index') }}" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-12.jpg') }}"
                                data-src="{{ asset('images/collections/cls-12.jpg') }}" alt="CLS">
                        </div>
                        <h5 class="collection_name fw-semibold link">Máy xay sinh tố Perfekt</h5>
                    </a>
                </div>
                <!-- item 4 -->
                <div class="swiper-slide">
                    <a href="{{ route('products.index') }}" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-13.jpg') }}"
                                data-src="{{ asset('images/collections/cls-13.jpg') }}" alt="CLS">
                        </div>
                        <h5 class="collection_name fw-semibold link">Máy massage trị liệu toàn thân</h5>
                    </a>
                </div>
                <!-- item 5 -->
                <div class="swiper-slide">
                    <a href="{{ route('products.index') }}" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-14.jpg') }}"
                                data-src="{{ asset('images/collections/cls-14.jpg') }}" alt="CLS">
                        </div>
                        <h5 class="collection_name fw-semibold link">Dù đi mưa Perfekt <span>(Quà Tặng)</span></h5>
                    </a>
                </div>
            </div>
            <div class="sw-dot-default tf-sw-pagination"></div>
        </div>
        @endif

        <!-- Link to all products -->
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="tf-btn btn-outline-primary">
                Xem tất cả sản phẩm
            </a>
        </div>
    </div>
</section>
<!-- /Collection -->
