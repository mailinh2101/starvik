# SEO Optimization Documentation - Star Vik Laravel Project

## Tổng quan
Hệ thống SEO đã được tối ưu hoàn toàn cho dự án Laravel Star Vik với các tính năng tự động:

## 1. SEO Tự Động cho Tin Tức và Sản Phẩm

### Cách hoạt động
Controllers tự động tạo SEO data và truyền cho views:

```php
// NewsController
$seoData = [
    'title' => $news->getSeoTitle() . ' - ' . config('app.name'),
    'description' => $news->getSeoDescription(),
    'keywords' => $news->getSeoKeywords(),
    'canonical' => $news->getCanonicalUrl(),
    'og_image' => $news->getOgImage(),
    'type' => 'article',
    'published_time' => $news->published_at?->toISOString(),
    'modified_time' => $news->updated_at?->toISOString(),
    'author' => $news->author?->name ?? env('COMPANY_NAME'),
];
```

### View Templates
Không cần khai báo SEO trong view nữa, chỉ cần:
```blade
@extends('layouts.app')
{{-- SEO sẽ được tự động xử lý qua $seoData từ controller --}}
```

### SEOable Trait cho Models
Models News và SimpleProduct đã có trait SEOable với các methods:

```php
$news = News::find(1);
$title = $news->getSeoTitle();        // Tự động từ title hoặc seo_title
$description = $news->getSeoDescription(); // Tự động từ excerpt, description hoặc content
$keywords = $news->getSeoKeywords();   // Tự động từ title, category, tags
$ogImage = $news->getOgImage();       // Tự động từ featured_image hoặc image
$canonicalUrl = $news->getCanonicalUrl(); // Tự động từ slug hoặc id
$structuredData = $news->getStructuredData(); // Schema.org JSON-LD
```

## 2. Schema.org Structured Data

### Tự động tạo schema theo loại content:

#### Article Schema (Tin tức)
```json
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "Tiêu đề bài viết",
    "author": {
        "@type": "Person",
        "name": "Tác giả"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Star Vik",
        "logo": {...}
    },
    "datePublished": "2025-01-01T00:00:00Z",
    "dateModified": "2025-01-02T00:00:00Z"
}
```

#### Product Schema (Sản phẩm)
```json
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Tên sản phẩm",
    "brand": {
        "@type": "Brand",
        "name": "Star Vik"
    },
    "offers": {
        "@type": "Offer",
        "price": "100000",
        "priceCurrency": "VND",
        "availability": "https://schema.org/InStock"
    }
}
```

## 3. Meta Tags Tự Động

### Open Graph cho từng loại content:
- **Articles**: `og:type="article"` + `article:published_time`, `article:author`
- **Products**: `og:type="product"` + `product:price:amount`, `product:price:currency`
- **Website**: `og:type="website"` cho các trang khác

### Twitter Cards
Tự động tạo Twitter Card với:
- `summary_large_image` cho tất cả content
- Tự động lấy image từ content hoặc fallback to company logo

## 4. Sitemap Tự Động

### Dynamic Sitemap Generator
Route `/sitemap.xml` tự động tạo sitemap từ:
- Trang tĩnh (cấu hình trong `config/seo.php`)
- Content động từ database (News, Products)

### Command để generate static sitemap
```bash
php artisan sitemap:generate
```

### Cấu hình sitemap trong config/seo.php:
```php
'sitemap' => [
    'static_pages' => [
        '/' => ['priority' => 1.0, 'change_frequency' => 'daily'],
        '/tin-tuc' => ['priority' => 0.9, 'change_frequency' => 'daily'],
    ],
    'dynamic_models' => [
        'App\Models\News' => [
            'route_pattern' => '/tin-tuc/{id}',
            'priority' => 0.7,
            'change_frequency' => 'weekly',
        ],
    ],
],
```

## 5. SEO Helper Class

### App\Helpers\SEOHelper
Tập trung xử lý SEO logic:

```php
// Lấy thông tin công ty
$company = SEOHelper::getCompanyInfo();

// Tạo meta tags
$metaTags = SEOHelper::generateMetaTags([
    'title' => 'Tiêu đề',
    'description' => 'Mô tả',
    'type' => 'article'
]);

// Tạo structured data
$schema = SEOHelper::generateSchema([
    'type' => 'article',
    'title' => 'Tiêu đề',
    'author' => 'Tác giả'
]);
```

## 6. Tối Ưu Performance

### Preload Resources
```blade
{{-- Layout tự động preload --}}
<link rel="preload" href="{{ asset('css/style.css') }}" as="style">
<link rel="preload" href="{{ asset('js/main.js') }}" as="script">
```

### Lazy Loading Images
```blade
<x-image 
    src="{{ asset('images/product.jpg') }}"
    alt="Tự động tạo alt text"
    :lazy="true"
    :webp="true"
/>
```

### SEO Middleware
Tự động:
- Thêm alt text cho images thiếu
- Thêm lazy loading
- Optimize HTML output

## 7. Monitoring & Analytics

### Page Views Tracking
Middleware `TrackPageViews` để:
- Track popular pages
- Monitor SEO performance
- Analyze user behavior

### Log Channel
```php
// config/logging.php
'pageviews' => [
    'driver' => 'single',
    'path' => storage_path('logs/pageviews.log'),
],
```

## 8. Commands Hữu Ích

```bash
# Generate sitemap
php artisan sitemap:generate

# Clear SEO cache
php artisan view:clear
php artisan config:clear

# Test SEO data
php artisan tinker
>>> $news = App\Models\News::first()
>>> $news->getSeoTitle()
>>> $news->getStructuredData()
```

## 9. Configuration Files

### .env - SEO Variables
```env
COMPANY_NAME="Star Vik - Công ty TNHH Star Vik"
COMPANY_DESCRIPTION="Công ty TNHH Star Vik"
COMPANY_ADDRESS="Việt Nam"
COMPANY_PHONE="+84 91 697 6795"
COMPANY_EMAIL="hr03.gr@gmail.com"
COMPANY_LOGO_URL="${APP_URL}/images/logo/logo-starvik.png"
SITE_KEYWORDS="starvik, công ty, dịch vụ"
```

### config/seo.php - SEO Configuration
Chứa tất cả cấu hình SEO:
- Default meta tags
- Company information
- Structured data settings
- Sitemap configuration

## 10. Best Practices được tự động áp dụng

### Content SEO
- ✅ Title: 50-60 ký tự
- ✅ Description: 150-160 ký tự (tự động cắt)
- ✅ Keywords: Tự động từ content
- ✅ Alt text: Tự động cho images
- ✅ Canonical URLs: Tự động tạo

### Technical SEO
- ✅ Schema.org markup
- ✅ Open Graph tags
- ✅ Twitter Cards
- ✅ XML Sitemap
- ✅ Robots.txt
- ✅ Mobile viewport
- ✅ Performance optimization

### Structured Data
- ✅ LocalBusiness schema
- ✅ Article schema cho tin tức
- ✅ Product schema cho sản phẩm
- ✅ Breadcrumb navigation

## Files được tạo/cập nhật:

### Controllers
- ✅ `NewsController.php` - SEO tự động cho tin tức
- ✅ `ProductController.php` - SEO tự động cho sản phẩm

### Helpers & Traits
- ✅ `app/Helpers/SEOHelper.php` - Xử lý SEO logic
- ✅ `app/Traits/SEOable.php` - Trait SEO cho models

### Views & Components
- ✅ `resources/views/components/seo.blade.php` - SEO component
- ✅ `resources/views/layouts/app.blade.php` - Layout with auto SEO

### Commands & Middleware
- ✅ `app/Console/Commands/GenerateSitemap.php` - Generate sitemap
- ✅ `app/Http/Middleware/TrackPageViews.php` - Analytics tracking

### Configuration
- ✅ `config/seo.php` - SEO configuration
- ✅ `.env` - SEO environment variables

Hệ thống SEO tự động đã hoàn thiện và sẵn sàng sử dụng!
