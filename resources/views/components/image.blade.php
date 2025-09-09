@props([
    'src' => '',
    'alt' => '',
    'class' => '',
    'lazy' => true,
    'webp' => true,
    'width' => null,
    'height' => null,
    'sizes' => null
])

@php
    $imageSrc = $src;
    $webpSrc = null;

    // Tạo WebP version nếu được yêu cầu
    if ($webp && !str_contains($src, '.webp')) {
        $webpSrc = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $src);
    }

    // Thiết lập lazy loading
    $loadingAttr = $lazy ? 'lazy' : 'eager';

    // Class mặc định cho responsive
    $classes = $class . ' img-fluid';
@endphp

@if($webpSrc)
    <picture>
        <source srcset="{{ $webpSrc }}" type="image/webp">
        <img
            src="{{ $imageSrc }}"
            alt="{{ $alt }}"
            class="{{ $classes }}"
            loading="{{ $loadingAttr }}"
            @if($width) width="{{ $width }}" @endif
            @if($height) height="{{ $height }}" @endif
            @if($sizes) sizes="{{ $sizes }}" @endif
        >
    </picture>
@else
    <img
        src="{{ $imageSrc }}"
        alt="{{ $alt }}"
        class="{{ $classes }}"
        loading="{{ $loadingAttr }}"
        @if($width) width="{{ $width }}" @endif
        @if($height) height="{{ $height }}" @endif
        @if($sizes) sizes="{{ $sizes }}" @endif
    >
@endif
