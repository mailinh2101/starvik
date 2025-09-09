@php
    // Tự động tạo page title nếu không được truyền từ controller
    if (!isset($pageTitle)) {
        $currentRoute = Request::path();
        $pageTitles = [
            'lien-he' => 'Liên hệ',
            'gioi-thieu' => 'Giới thiệu',
            'tin-tuc' => 'Tin tức',
            'tin-tuc/*' => 'Chi tiết tin tức',
            'san-pham' => 'Sản phẩm',
            'san-pham/*' => 'Chi tiết sản phẩm',
        ];

        $pageTitle = $pageTitles[$currentRoute] ?? 'Trang';
    }
@endphp

        <!-- Page Title -->
        <section class="s-page-title">
            <div class="container">
                <div class="content">
                    <h1 class="title-page">{{ $pageTitle }}</h1>
                    <ul class="breadcrumbs-page">
                        <li><a href="{{ url('/') }}" class="h6 link">Trang chủ</a></li>
                        <li class="d-flex"><i class="icon icon-caret-right"></i></li>
                        <li>
                            <h6 class="current-page fw-normal">{{ $pageTitle }}</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- /Page Title -->
