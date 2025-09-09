# 📘 Laravel Coding Conventions

Quy tắc code dành cho team dev (mid-level, ~2 năm kinh nghiệm).  
Mục tiêu: **Code gọn – sạch – dễ maintain – chuẩn SEO**.

---

## 1. Cấu trúc dự án
- Tuân thủ chuẩn Laravel.
- Models trong `App\Models`.
- Controllers trong `App\Http\Controllers`.
- Nếu logic phức tạp → tách ra `App\Services` hoặc `App\Repositories`.
- Controller chỉ gọi Service/Repository, không nhồi nhét logic.

---

## 2. Code Style
- Theo chuẩn **PSR-12**.
- Hàm không dài quá **30–40 dòng**.
- Tên biến/hàm/class rõ nghĩa, viết bằng tiếng Anh.
- Tránh dùng raw SQL → ưu tiên **Eloquent** hoặc **Query Builder**.

---

## 3. Blade & View
- Tách **layout chính** trong `resources/views/layouts/`.
- Dùng **Blade Components** (`resources/views/components/`) cho:
  - Navbar, Footer
  - Form input, button
  - Modal, Alert
- Dùng `@include` nếu chỉ tái sử dụng 1–2 lần.
- Xử lý logic trong Controller/Service, không nhúng trực tiếp vào Blade.

---

## 4. SEO Friendly
- **Meta tags**:
  ```blade
  <title>@yield('title')</title>
  <meta name="description" content="@yield('description')">
  <meta name="keywords" content="@yield('keywords')">
Heading tags: mỗi trang 1 <h1>, phân cấp <h2>, <h3>.

URL chuẩn SEO: dùng slug (/blog/lam-quen-laravel).

Sitemap: dùng spatie/laravel-sitemap.

Robots.txt: chặn /admin, /api.

OpenGraph & Twitter Card: để tối ưu share MXH.

Performance:

Lazy load hình (loading="lazy").

Dùng asset() hoặc Vite cho CSS/JS.

Cache query, paginate list.

5. Database & Eloquent

Thay đổi DB phải qua migration.

Seeder/Factory để fake data.

Định nghĩa đầy đủ quan hệ (hasOne, hasMany, belongsTo, ...).

Tránh N+1 query → dùng with().

Validate trước khi save/update.

6. Validation & Request

Tách FormRequest để validate input.

Rule rõ ràng, custom message khi cần.

7. API & Response

Response JSON chuẩn:

{
  "success": true,
  "data": {},
  "message": "..."
}


Dùng API Resources để format dữ liệu.

8. Error & Exception Handling

try/catch khi gọi API, Queue, Payment, File.

Log lỗi bằng Log::error() kèm context.

Không dd() trong production.

9. Security

CSRF token cho form.

Escape dữ liệu Blade bằng {{ $var }}.

Policy/Gate cho phân quyền.

Hash password bằng Hash::make().

10. Performance

Cache query nặng.

Dùng Queue cho job lớn (email, report).

Paginate khi lấy list.

Select đúng cột cần thiết.

11. Testing

Feature test cho API.

Unit test cho logic quan trọng.

Run php artisan test trước khi commit.

12. Git & Deployment

Commit theo chuẩn:

feat: thêm API login

fix: sửa validate email

refactor: tách service

Không commit:

.env

storage/

vendor/

Dùng .env.example làm template.