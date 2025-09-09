<!-- Navbar Component -->
<header class="tf-header style-4">
</header>
<!-- Navbar Component -->
<!-- Header -->
<header class="tf-header style-4">
    <div class="header-top">
        <div class="container-full-2">
            <div class="row align-items-center">
                <div class="col-md-4 col-3 d-xl-none">
                    <a href="#mobileMenu" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" class="btn-mobile-menu">
                        <span></span>
                    </a>
                </div>
                <div class="col-xl-4 d-none d-xl-block">
                    <div class="box-support-online">
                        <i class="icon icon-phone"></i>
                        <span class="br-line type-vertical"></span>
                        <div class="sp-wrap">
                            <span class="text-small">Hỗ trợ trực tuyến</span>
                            <a href="tel:0916976795" class="phone-number h4 fw-semibold link">(84) 91 697 6795</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-6">
                    <a href="{{ url('/') }}" class="logo-site justify-content-center">
                        <img src="{{ asset('images/logo/logo-starvik.png') }}" width="133px" alt="Logo">
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 col-3">
                    <ul class="nav-icon-list">
                        <li class="d-none d-lg-flex"></li>
                        <li class="d-none d-md-flex"></li>
                        <li class="d-none d-sm-flex"></li>
                        <li class="shop-cart" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-inner bg-black d-none d-xl-block">
        <div class="container">
            <nav class="box-navigation style-white">
                <ul class="box-nav-menu">
                    <li class="menu-item">
                        <a href="{{ url('/') }}" class="item-link">Trang Chủ</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('/gioi-thieu') }}" class="item-link">Giới thiệu</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('/san-pham') }}" class="item-link">Sản phẩm</a>
                    </li>
                    <li class="menu-item position-relative">
                        <a href="{{ route('news.index') }}" class="item-link">Tin tức</a>
                    </li>
                    <li class="menu-item position-relative">
                        <a href="{{ url('/lien-he') }}" class="item-link">Liên hệ</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<header class="tf-header header-fixed">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 col-3 d-xl-none">
                <a href="#mobileMenu" data-bs-toggle="offcanvas" class="btn-mobile-menu">
                    <span></span>
                </a>
            </div>
            <div class="col-xl-3 col-md-4 col-6 text-center text-xl-start">
                <a href="{{ url('/') }}" class="logo-site justify-content-center justify-content-xl-start">
                    <img src="{{ asset('images/logo/logo-starvik.png') }}" width="133px" alt="Logo">
                </a>
            </div>
            <div class="col-xl-6 d-none d-xl-block">
                <nav class="box-navigation">
                    <ul class="box-nav-menu">
                        <li class="menu-item">
                            <a href="{{ url('/') }}" class="item-link">Trang Chủ</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('/gioi-thieu') }}" class="item-link">Giới thiệu</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('/san-pham') }}" class="item-link">Sản phẩm</a>
                        </li>
                        <li class="menu-item position-relative">
                            <a href="{{ route('news.index') }}" class="item-link">Tin tức</a>
                        </li>
                        <li class="menu-item position-relative">
                            <a href="{{ url('/lien-he') }}" class="item-link">Liên hệ</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- /Header -->

<!-- Mobile Menu Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="mobile-navigation">
            <ul class="nav-mobile-menu">
                <li class="menu-item">
                    <a href="{{ url('/') }}" class="item-link">Trang Chủ</a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/gioi-thieu') }}" class="item-link">Giới thiệu</a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/san-pham') }}" class="item-link">Sản phẩm</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('news.index') }}" class="item-link">Tin tức</a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/lien-he') }}" class="item-link">Liên hệ</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
