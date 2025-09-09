# Products CSS & JavaScript Architecture

## Tổng quan

Đã tách các CSS inline và JavaScript ra thành các file riêng biệt để dễ bảo trì và tái sử dụng.

## Cấu trúc file

### CSS Files

```
public/css/
├── products-common.css     # CSS chung cho tất cả trang sản phẩm
└── products-category.css   # CSS riêng cho trang danh mục
```

### JavaScript Files

```
public/js/
└── products-category.js    # JavaScript cho trang danh mục
```

## Cách sử dụng

### 1. Products Common CSS (`products-common.css`)

**Mục đích:** CSS dùng chung cho tất cả các trang sản phẩm

**Bao gồm:**
- Product card styles cơ bản
- Header gradients
- Button styles
- Form controls
- Grid layouts
- Loading states
- Empty states
- Pagination
- Badges và tags
- Responsive design

**Cách include:**
```blade
@push('head')
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
@endpush
```

### 2. Products Category CSS (`products-category.css`)

**Mục đích:** CSS đặc biệt cho trang danh mục sản phẩm

**Bao gồm:**
- Category header với gradient xanh
- Stats grid
- Filter bar
- View toggle (grid/list)
- Product grid và list view
- Related categories section
- Responsive design cho category page

**Cách include:**
```blade
@push('head')
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
<link rel="stylesheet" href="{{ asset('css/products-category.css') }}">
@endpush
```

### 3. Products Category JavaScript (`products-category.js`)

**Mục đích:** JavaScript cho trang danh mục

**Features:**
- Class-based architecture
- Load related categories từ API
- View toggle (grid/list view)
- Sort functionality
- User preferences (localStorage)
- Analytics tracking
- Infinite scroll ready
- Error handling

**Cách include:**
```blade
@push('scripts')
<script src="{{ asset('js/products-category.js') }}"></script>
@endpush
```

**Cách sử dụng:**
```html
<!-- Thêm data attribute cho category -->
<section class="tf-category-products" data-category="{{ $category }}">
    <!-- Nội dung -->
</section>
```

## Classes và Utilities có sẵn

### Product Cards
```css
.product-card-base          /* Card cơ bản */
.product-image-base         /* Image container */
.product-content-base       /* Content wrapper */
.product-title-base         /* Title styling */
.product-brand-base         /* Brand styling */
.product-description-base   /* Description styling */
```

### Buttons
```css
.btn-primary-custom         /* Button xanh dương */
.btn-success-custom         /* Button xanh lá */
```

### Headers
```css
.page-header-gradient       /* Header với gradient */
.page-header-content        /* Content trong header */
.page-title                 /* Title chính */
.page-subtitle              /* Subtitle */
```

### Stats
```css
.stats-card                 /* Card thống kê */
.stats-grid-base           /* Grid layout stats */
.stat-item-base            /* Item thống kê */
.stat-number-base          /* Số liệu */
.stat-label-base           /* Nhãn */
```

### Controls
```css
.control-bar               /* Bar điều khiển */
.control-left              /* Phần trái */
.control-right             /* Phần phải */
.form-select-custom        /* Select dropdown */
.form-input-custom         /* Input field */
```

### Grids
```css
.product-grid-base         /* Grid cơ bản */
.grid-2                    /* 2 cột */
.grid-3                    /* 3 cột */
.grid-4                    /* 4 cột */
```

### States
```css
.loading-spinner           /* Loading animation */
.empty-state              /* Trạng thái trống */
.empty-state-icon         /* Icon trống */
```

### Tags & Badges
```css
.badge-primary            /* Badge xanh dương */
.badge-success            /* Badge xanh lá */
.badge-warning            /* Badge vàng */
.tag-list                 /* Danh sách tag */
.tag-item                 /* Tag item */
```

## JavaScript API

### CategoryPage Class

```javascript
// Khởi tạo tự động
window.categoryPage = new CategoryPage();

// Methods có sẵn
categoryPage.toggleView('grid' | 'list')
categoryPage.sortProducts(sortType)
categoryPage.loadRelatedCategories()
categoryPage.trackProductClick(productName)
```

### Events

```javascript
// Listen to view changes
window.addEventListener('viewChanged', (e) => {
    console.log('View changed to:', e.detail.viewType);
});

// Custom filter events
document.addEventListener('filterChanged', (e) => {
    console.log('Filter changed:', e.detail);
});
```

## Tích hợp với trang khác

### Search Page
```blade
@push('head')
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
<!-- Có thể tạo products-search.css riêng -->
@endpush
```

### Product Index
```blade
@push('head')
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
<!-- Có thể tạo products-index.css riêng -->
@endpush
```

### Featured Products
```blade
@push('head')
<link rel="stylesheet" href="{{ asset('css/products-common.css') }}">
<!-- Có thể tạo products-featured.css riêng -->
@endpush
```

## Performance Tips

1. **CSS Loading:** Load common CSS trước, specific CSS sau
2. **JavaScript:** Chỉ load JS cần thiết cho từng trang
3. **Caching:** Đặt cache headers cho CSS/JS files
4. **Minification:** Nén CSS/JS trong production

## Maintenance

1. **CSS Organization:** Giữ common styles trong `products-common.css`
2. **Component Reuse:** Sử dụng base classes để tái sử dụng
3. **Responsive:** Test trên nhiều màn hình
4. **Browser Support:** Test trên các trình duyệt chính

## Future Enhancements

1. Tạo `products-search.css` cho search page
2. Tạo `products-index.css` cho index page
3. Tạo `products-show.css` cho product detail
4. Thêm JavaScript modules cho các features khác
5. Implement CSS custom properties cho theming
6. Thêm dark mode support
