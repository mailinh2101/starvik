  <!-- Blog -->
  <section class="themesFlat">
      <div class="container">
          <div class="sect-title text-center wow fadeInUp">
              <h1 class="s-title mb-8">Tin tức</h1>
          </div>
          <div dir="ltr" class="swiper tf-swiper" data-preview="3" data-tablet="3" data-mobile-sm="2" data-mobile="1"
              data-space-lg="48" data-space-md="32" data-space="12" data-pagination="1" data-pagination-sm="2"
              data-pagination-md="3" data-pagination-lg="3">
              <div class="swiper-wrapper">
                  @forelse($latestNews as $index => $article)
                  <div class="swiper-slide">
                      <div class="article-blog type-space-2 hover-img4 position-relative wow fadeInLeft" @if($index > 0) data-wow-delay="{{ $index * 0.1 }}s" @endif>
                          <a href="{{ route('news.show', $article->slug) }}" class="entry_image img-style4">
                              <img src="{{ $article->featured_image ? asset($article->featured_image) : asset('images/blog/blog-5.jpg') }}"
                                  data-src="{{ $article->featured_image ? asset($article->featured_image) : asset('images/blog/blog-5.jpg') }}"
                                  alt="{{ $article->title }}"
                                  class="lazyload aspect-ratio-0">
                          </a>
                          <div class="entry_tag">
                              <a href="{{ route('news.show', $article->slug) }}" class="name-tag h6 link">{{ $article->formatted_date }}</a>
                          </div>

                          <div class="blog-content">
                              <a href="{{ route('news.show', $article->slug) }}" class="entry_name link h4">
                                  {{ $article->title }}
                              </a>
                              <p class="text h6">
                                  {{ $article->excerpt ?? Str::limit($article->content, 120) }}
                              </p>
                              <a href="{{ route('news.show', $article->slug) }}" class="tf-btn-line">
                                  Đọc thêm
                              </a>
                          </div>
                      </div>
                  </div>
                  @empty
                  <!-- Default content if no news -->
                  <div class="swiper-slide">
                      <div class="article-blog type-space-2 hover-img4 wow fadeInLeft">
                          <a href="#" class="entry_image img-style4">
                              <img src="{{ asset('images/blog/blog-5.jpg') }}"
                                  data-src="{{ asset('images/blog/blog-5.jpg') }}" alt="Blog"
                                  class="lazyload aspect-ratio-0">
                          </a>
                          <div class="entry_tag">
                              <a href="#" class="name-tag h6 link">{{ date('d/m/Y') }}</a>
                          </div>

                          <div class="blog-content">
                              <a href="#" class="entry_name link h4">
                                  Chưa có tin tức
                              </a>
                              <p class="text h6">
                                  Hiện tại chưa có tin tức nào được đăng. Vui lòng quay lại sau để xem những tin tức mới nhất.
                              </p>
                              <a href="{{ route('news.index') }}" class="tf-btn-line">
                                  Xem tất cả
                              </a>
                          </div>
                      </div>
                  </div>
                  @endforelse
              </div>
              <div class="sw-dot-default tf-sw-pagination mb-30"></div>

              @if(isset($latestNews) && $latestNews->count() > 0)
              <div class="text-center mt-4">
                  <a href="{{ route('news.index') }}" class="tf-btn btn-style-2 radius-60">
                      Xem tất cả tin tức
                  </a>
              </div>
              @endif
          </div>
      </div>
  </section>
  <!-- /Blog -->
