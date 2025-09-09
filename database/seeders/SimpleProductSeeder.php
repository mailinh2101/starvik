<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SimpleProduct;

class SimpleProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Dell XPS 13',
                'slug' => 'laptop-dell-xps-13',
                'description' => 'Laptop Dell XPS 13 với thiết kế mỏng nhẹ, hiệu năng cao và màn hình InfinityEdge. Phù hợp cho công việc và giải trí.',
                'image' => 'images/product-1.jpg',
                'gallery' => ['images/product-1.jpg', 'images/product-2.jpg'],
                'category' => 'Laptop',
                'brand' => 'Dell',
                'specifications' => [
                    'CPU' => 'Intel Core i7-1185G7',
                    'RAM' => '16GB LPDDR4x',
                    'Storage' => '512GB SSD',
                    'Display' => '13.4" FHD+ InfinityEdge',
                    'Graphics' => 'Intel Iris Xe Graphics',
                    'OS' => 'Windows 11'
                ],
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'seo_title' => 'Laptop Dell XPS 13 - Thiết kế cao cấp, hiệu năng mạnh mẽ',
                'seo_description' => 'Mua laptop Dell XPS 13 chính hãng với giá tốt nhất. Thiết kế premium, hiệu năng Intel Core i7, màn hình InfinityEdge tuyệt đẹp.',
                'seo_keywords' => 'laptop dell, dell xps 13, laptop cao cấp, laptop mỏng nhẹ'
            ],
            [
                'name' => 'iPhone 15 Pro Max',
                'slug' => 'iphone-15-pro-max',
                'description' => 'iPhone 15 Pro Max với chip A17 Pro, camera Action Button và thiết kế titanium sang trọng. Trải nghiệm đỉnh cao từ Apple.',
                'image' => 'images/product-3.jpg',
                'gallery' => ['images/product-3.jpg', 'images/product-4.jpg'],
                'category' => 'Smartphone',
                'brand' => 'Apple',
                'specifications' => [
                    'CPU' => 'Apple A17 Pro',
                    'RAM' => '8GB',
                    'Storage' => '256GB',
                    'Display' => '6.7" Super Retina XDR OLED',
                    'Camera' => 'Triple 48MP + 12MP + 12MP',
                    'OS' => 'iOS 17'
                ],
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'seo_title' => 'iPhone 15 Pro Max - Smartphone cao cấp nhất từ Apple',
                'seo_description' => 'iPhone 15 Pro Max với chip A17 Pro, camera chuyên nghiệp và thiết kế titanium. Đặt hàng ngay với giá ưu đãi.',
                'seo_keywords' => 'iphone 15 pro max, apple iphone, smartphone cao cấp, điện thoại apple'
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'slug' => 'samsung-galaxy-s24-ultra',
                'description' => 'Samsung Galaxy S24 Ultra với bút S Pen tích hợp, camera zoom 100x và AI thông minh. Đỉnh cao công nghệ từ Samsung.',
                'image' => 'images/product-5.jpg',
                'gallery' => ['images/product-5.jpg', 'images/product-6.jpg'],
                'category' => 'Smartphone',
                'brand' => 'Samsung',
                'specifications' => [
                    'CPU' => 'Snapdragon 8 Gen 3',
                    'RAM' => '12GB',
                    'Storage' => '512GB',
                    'Display' => '6.8" Dynamic AMOLED 2X',
                    'Camera' => 'Quad 200MP + 50MP + 12MP + 10MP',
                    'OS' => 'Android 14'
                ],
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
                'seo_title' => 'Samsung Galaxy S24 Ultra - Smartphone Android hàng đầu',
                'seo_description' => 'Galaxy S24 Ultra với S Pen, camera 200MP và AI Galaxy. Smartphone Android cao cấp nhất từ Samsung.',
                'seo_keywords' => 'samsung galaxy s24 ultra, smartphone samsung, android cao cấp, s pen'
            ],
            [
                'name' => 'MacBook Pro 16" M3',
                'slug' => 'macbook-pro-16-m3',
                'description' => 'MacBook Pro 16 inch với chip M3 Pro, hiệu năng đột phá cho công việc chuyên nghiệp và sáng tạo nội dung.',
                'image' => 'images/product-7.jpg',
                'gallery' => ['images/product-7.jpg', 'images/product-8.jpg'],
                'category' => 'Laptop',
                'brand' => 'Apple',
                'specifications' => [
                    'CPU' => 'Apple M3 Pro',
                    'RAM' => '18GB Unified Memory',
                    'Storage' => '512GB SSD',
                    'Display' => '16.2" Liquid Retina XDR',
                    'Graphics' => 'Integrated Graphics',
                    'OS' => 'macOS Sonoma'
                ],
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
                'seo_title' => 'MacBook Pro 16" M3 - Laptop chuyên nghiệp cho creator',
                'seo_description' => 'MacBook Pro 16 inch M3 với hiệu năng vượt trội, màn hình Liquid Retina XDR và thời lượng pin dài.',
                'seo_keywords' => 'macbook pro 16, apple m3, laptop apple, macbook chuyên nghiệp'
            ],
            [
                'name' => 'iPad Air M2',
                'slug' => 'ipad-air-m2',
                'description' => 'iPad Air với chip M2 mạnh mẽ, hỗ trợ Apple Pencil và Magic Keyboard. Hoàn hảo cho học tập và làm việc.',
                'image' => 'images/product-9.jpg',
                'gallery' => ['images/product-9.jpg', 'images/product-10.jpg'],
                'category' => 'Tablet',
                'brand' => 'Apple',
                'specifications' => [
                    'CPU' => 'Apple M2',
                    'RAM' => '8GB',
                    'Storage' => '256GB',
                    'Display' => '10.9" Liquid Retina',
                    'Camera' => '12MP Wide, 12MP Ultra Wide',
                    'OS' => 'iPadOS 17'
                ],
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
                'seo_title' => 'iPad Air M2 - Tablet cao cấp cho mọi nhu cầu',
                'seo_description' => 'iPad Air M2 với chip mạnh mẽ, hỗ trợ Apple Pencil. Lý tưởng cho học tập, làm việc và giải trí.',
                'seo_keywords' => 'ipad air m2, tablet apple, ipad cao cấp, apple pencil'
            ]
        ];

        foreach ($products as $product) {
            SimpleProduct::create($product);
        }
    }
}
