@props([
    'title' => '',
    'description' => '',
    'keywords' => '',
    'og_image' => '',
    'og_url' => '',
    'canonical' => '',
    'type' => 'website',
    'locale' => 'vi_VN',
    'author' => '',
    'robots' => 'index, follow',
    'published_time' => '',
    'modified_time' => '',
    'price' => '',
    'availability' => '',
    'brand' => ''
])

@php
    use App\Helpers\SEOHelper;

    $seoData = SEOHelper::generateMetaTags([
        'title' => $title,
        'description' => $description,
        'keywords' => $keywords,
        'og_image' => $og_image,
        'og_url' => $og_url ?: request()->url(),
        'canonical' => $canonical ?: request()->url(),
        'type' => $type,
    ]);

    $schema = SEOHelper::generateSchema([
        'type' => $type,
        'title' => $title,
        'description' => $seoData['description'],
        'url' => $seoData['og_url'],
        'image' => $seoData['og_image'],
        'author' => $author,
        'published_time' => $published_time,
        'modified_time' => $modified_time,
        'price' => $price,
        'availability' => $availability,
        'brand' => $brand,
    ]);
@endphp

{{-- Basic Meta Tags --}}
<title>{{ $seoData['title'] }}</title>
<meta name="description" content="{{ $seoData['description'] }}">
<meta name="keywords" content="{{ $seoData['keywords'] }}">
<meta name="author" content="{{ $seoData['author'] }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $seoData['canonical'] }}">

{{-- Open Graph Meta Tags --}}
<meta property="og:type" content="{{ $seoData['og_type'] }}">
<meta property="og:title" content="{{ $seoData['og_title'] }}">
<meta property="og:description" content="{{ $seoData['og_description'] }}">
<meta property="og:image" content="{{ $seoData['og_image'] }}">
<meta property="og:url" content="{{ $seoData['og_url'] }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="{{ $locale }}">

@if($type === 'article' && $published_time)
<meta property="article:published_time" content="{{ $published_time }}">
@endif

@if($type === 'article' && $modified_time)
<meta property="article:modified_time" content="{{ $modified_time }}">
@endif

@if($type === 'article' && $author)
<meta property="article:author" content="{{ $author }}">
@endif

@if($type === 'product' && $price)
<meta property="product:price:amount" content="{{ $price }}">
<meta property="product:price:currency" content="VND">
@endif

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoData['og_title'] }}">
<meta name="twitter:description" content="{{ $seoData['og_description'] }}">
<meta name="twitter:image" content="{{ $seoData['og_image'] }}">
<meta name="twitter:url" content="{{ $seoData['og_url'] }}">

{{-- Additional Meta Tags --}}
<meta name="theme-color" content="#000000">
<meta name="msapplication-TileColor" content="#000000">
<meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
<meta name="application-name" content="{{ config('app.name') }}">

{{-- JSON-LD Schema --}}
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</script>
