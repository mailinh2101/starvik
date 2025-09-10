@extends('layouts.app')

{{-- SEO sẽ được tự động xử lý qua $seoData từ controller --}}

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

        <!-- Page Header -->
        <div class="breadcrumb-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Tin tức</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($news->title, 50) }}</li>
                            </ol>
                        </nav>
                        <h1 class="page-title">{{ $news->title }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Content -->
        <section class="flat-blog-detail themesFlat" style="padding: 60px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <article class="blog-detail">
                            <div class="entry-meta mb-4">
                                <span class="entry-date">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    {{ $news->formatted_date }}
                                </span>
                                @if($news->author)
                                    <span class="entry-author ms-3">
                                        <i class="fas fa-user me-2"></i>
                                        {{ $news->author }}
                                    </span>
                                @endif
                                @if($news->category)
                                    <span class="entry-category ms-3">
                                        <i class="fas fa-folder me-2"></i>
                                        {{ $news->category }}
                                    </span>
                                @endif
                            </div>

                            @if($news->featured_image)
                                <div class="entry-image mb-4">
                                    <img src="{{ $news->featured_image_url }}"
                                         class="img-fluid rounded"
                                         alt="{{ $news->title }}">
                                </div>
                            @endif

                            <div class="entry-content">
                                {!! $news->content !!}
                            </div>

                            @php
                                $tags = $news->tags;
                                if (is_string($tags)) {
                                    $tags = array_filter(array_map('trim', explode(',', $tags)));
                                } elseif (!is_array($tags)) {
                                    $tags = [];
                                }
                            @endphp

                            @if($tags && count($tags) > 0)
                            <div class="entry-tags mt-4 pt-3 border-top">
                                <h6 class="mb-3">Thẻ tag:</h6>
                                <div class="tags-list">
                                    @foreach($tags as $tag)
                                        <span class="tag-item">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </article>

                        <!-- Navigation -->
                        <div class="blog-navigation mt-5 pt-4 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('news.index') }}" class="tf-btn btn-style-2">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Quay lại tin tức
                                </a>

                                <div class="d-flex gap-2">
                                    <button class="tf-btn btn-style-3 btn-sm" onclick="window.print()">
                                        <i class="fas fa-print me-1"></i>
                                        In
                                    </button>
                                    <button class="tf-btn btn-style-3 btn-sm" onclick="shareArticle()">
                                        <i class="fas fa-share-alt me-1"></i>
                                        Chia sẻ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related News -->
                @if(isset($relatedNews) && $relatedNews->count() > 0)
                <div class="row mt-5">
                    <div class="col-12">
                        <h3 class="mb-4">Tin tức liên quan</h3>
                        <div class="row">
                            @foreach($relatedNews as $related)
                            <div class="col-md-4 mb-4">
                                <div class="related-news-item">
                                    @if($related->featured_image)
                                    <div class="related-image">
                                        <a href="{{ route('news.show', $related->slug) }}">
                                            <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}" class="img-fluid rounded">
                                        </a>
                                    </div>
                                    @endif
                                    <div class="related-content mt-3">
                                        <h5><a href="{{ route('news.show', $related->slug) }}" class="text-decoration-none">{{ $related->title }}</a></h5>
                                        <p class="text-muted small">{{ $related->formatted_date }}</p>
                                        <p class="text-muted">{{ Str::limit(strip_tags($related->content), 100) }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <x-footer />
    </div>
@endsection

@push('styles')
<style>
.breadcrumb-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0 40px;
    color: white;
}

.breadcrumb a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: white;
}

.page-title {
    color: white;
    margin-top: 20px;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.3;
}

.blog-detail {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.entry-meta {
    color: #666;
    font-size: 14px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}

.entry-content {
    font-size: 16px;
    line-height: 1.8;
    color: #333;
}

.entry-content p {
    margin-bottom: 20px;
}

.entry-image img {
    width: 100%;
    height: auto;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.entry-tags {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
}

.tags-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.tag-item {
    background: #667eea;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
}

.related-news-item {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.related-news-item:hover {
    transform: translateY(-5px);
}

.related-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.related-content h5 a {
    color: #333;
    font-weight: 600;
}

.related-content h5 a:hover {
    color: #667eea;
}

@media print {
    .tf-btn, .breadcrumb-header, .blog-navigation {
        display: none !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $news->title }}',
            text: '{{ $news->excerpt ?? Str::limit($news->content, 120) }}',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Đã sao chép liên kết vào clipboard!');
        });
    }
}
</script>
@endpush
