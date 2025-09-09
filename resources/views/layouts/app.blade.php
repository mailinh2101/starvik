<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO Component - có thể override trong từng trang --}}
    @hasSection('seo')
        @yield('seo')
    @elseif(isset($seoData))
        <x-seo
            :title="$seoData['title']"
            :description="$seoData['description']"
            :keywords="$seoData['keywords']"
            :canonical="$seoData['canonical']"
            :og_image="$seoData['og_image']"
            :type="$seoData['type'] ?? 'website'"
            :robots="$seoData['robots'] ?? 'index, follow'"
            :published_time="$seoData['published_time'] ?? ''"
            :modified_time="$seoData['modified_time'] ?? ''"
            :author="$seoData['author'] ?? ''"
            :price="$seoData['price'] ?? ''"
            :availability="$seoData['availability'] ?? ''"
            :brand="$seoData['brand'] ?? ''"
        />
    @else
        <x-seo
            :title="$title ?? 'Star Vik - Công ty TNHH Star Vik'"
            :description="$description ?? env('COMPANY_DESCRIPTION')"
            :keywords="$keywords ?? env('SITE_KEYWORDS')"
            :og_image="$og_image ?? env('COMPANY_LOGO_URL')"
        />
    @endif

    {{-- Preload Critical Resources --}}
    <link rel="preload" href="{{ asset('css/style.css') }}" as="style">
    <link rel="preload" href="{{ asset('css/fonts.css') }}" as="style">
    <link rel="preload" href="{{ asset('js/main.js') }}" as="script">

    {{-- CSS Links --}}
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sib-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image-compare-viewer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo/logo-starvik.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo/logo-starvik.png') }}">

    {{-- Custom Styles Stack --}}
    @stack('styles')
    @stack('head')
</head>
<body>
    @yield('body')
    <!-- JS scripts -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/lazysize.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/infinityslide.js') }}"></script>
    <script src="{{ asset('js/image-compare-viewer.min.js') }}"></script>
    <script src="{{ asset('js/image-compare-viewer.js') }}"></script>
    <script src="{{ asset('js/parallaxie.js') }}"></script>
    <script src="{{ asset('js/count-down.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/sibforms.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
