@extends('layouts.app')

@section('title', 'Tin Tức - Star Vik')
@section('description', 'Tin tức mới nhất từ Star Vik')
@section('keywords', 'tin tức, starvik, đồ gia dụng, thực phẩm chức năng')

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
                                <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
                            </ol>
                        </nav>
                        <h1 class="page-title">Tin Tức</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- News Content -->
        <section class="flat-blog themesFlat" style="padding: 60px 0;">
            <div class="container">
                <div class="row">
                    @forelse($news as $article)
                        <div class="col-md-6 col-lg-4 mb-20">
                            <div class="article-blog type-space-2 hover-img4 h-100 position-relative">
                                <a href="{{ route('news.show', $article->slug) }}" class="entry_image img-style4">
                                    <img src="{{ $article->featured_image ? asset($article->featured_image) : asset('images/blog/blog-5.jpg') }}"
                                         alt="{{ $article->title }}"
                                         class="lazyload">
                                </a>
                                <div class="entry_tag">
                                    <span class="name-tag h6">{{ $article->formatted_date }}</span>
                                    @if($article->author)
                                        <span class="name-tag h6">{{ $article->author }}</span>
                                    @endif
                                </div>

                                <div class="blog-content p-3 d-flex flex-column">
                                    <a href="{{ route('news.show', $article->slug) }}" class="entry_name link h4">
                                        {{ $article->title }}
                                    </a>
                                    <p class="text h6">
                                        {{ $article->excerpt ?? Str::limit($article->content, 120) }}
                                    </p>
                                    <a href="{{ route('news.show', $article->slug) }}" class="mt-auto tf-btn-line align-self-start">
                                        Đọc thêm
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <h3 class="text-muted">Chưa có tin tức nào</h3>
                                <p class="text-muted">Vui lòng quay lại sau để xem tin tức mới nhất.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if($news->hasPages())
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                {{ $news->links() }}
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
}

.article-blog {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.article-blog:hover {
    transform: translateY(-5px);
}

.blog-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.blog-content .text {
    flex-grow: 1;
}

.entry_tag {
    padding: 10px 20px;
    background: rgba(0,0,0,0.05);
}
</style>
@endpush
