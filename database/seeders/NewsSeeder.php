<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'iPhone 15 Pro Max chính thức ra mắt với nhiều cải tiến đột phá',
                'slug' => 'iphone-15-pro-max-chinh-thuc-ra-mat',
                'excerpt' => 'Apple vừa công bố iPhone 15 Pro Max với chip A17 Pro, camera cải tiến và thiết kế titanium sang trọng.',
                'content' => '<p>Apple đã chính thức giới thiệu iPhone 15 Pro Max tại sự kiện Wonderlust 2023, đánh dấu một bước tiến quan trọng trong công nghệ smartphone. Sản phẩm mới này không chỉ mang lại hiệu năng vượt trội mà còn có những cải tiến đáng kể về thiết kế và tính năng.</p>

<h3>Thiết kế titanium cao cấp</h3>
<p>iPhone 15 Pro Max sử dụng chất liệu titanium Grade 5 - loại titanium tương tự được sử dụng trong ngành hàng không vũ trụ. Điều này giúp máy nhẹ hơn 19g so với thế hệ trước, đồng thời tăng cường độ bền và khả năng chống trầy xước.</p>

<h3>Chip A17 Pro mạnh mẽ</h3>
<p>Được sản xuất trên tiến trình 3nm tiên tiến nhất hiện tại, chip A17 Pro mang lại hiệu năng CPU nhanh hơn 10% và GPU nhanh hơn 20% so với A16 Bionic. Điều này cho phép iPhone 15 Pro Max xử lý các tác vụ nặng như chỉnh sửa video 4K ProRes một cách mượt mà.</p>

<h3>Hệ thống camera chuyên nghiệp</h3>
<p>Camera chính 48MP với cảm biến lớn hơn, hỗ trợ zoom quang học 5x lần đầu tiên trên iPhone. Tính năng Action Button thay thế nút gạt âm thanh truyền thống, cho phép người dùng tùy chỉnh các shortcut nhanh.</p>

<p>iPhone 15 Pro Max sẽ có mặt tại thị trường Việt Nam từ ngày 22/9/2023 với giá khởi điểm 34.999.000 VND cho phiên bản 256GB.</p>',
                'featured_image' => 'images/news/news-1.jpg',
                'gallery' => ['images/news/news-1.jpg', 'images/news/news-2.jpg'],
                'category' => 'Smartphone',
                'tags' => ['iPhone', 'Apple', 'iOS', 'Smartphone'],
                'author' => 'Tech Editor',
                'published_at' => now()->subDays(2),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'seo_title' => 'iPhone 15 Pro Max ra mắt - Tất cả thông tin chi tiết',
                'seo_description' => 'iPhone 15 Pro Max chính thức ra mắt với chip A17 Pro, camera 48MP và thiết kế titanium. Xem ngay thông tin chi tiết và giá bán.',
                'seo_keywords' => 'iPhone 15 Pro Max, Apple, smartphone mới, công nghệ'
            ],
            [
                'title' => 'Samsung Galaxy S24 Ultra: Cuộc cách mạng AI trong smartphone',
                'slug' => 'samsung-galaxy-s24-ultra-cuoc-cach-mang-ai',
                'excerpt' => 'Galaxy S24 Ultra đánh dấu kỷ nguyên mới với tính năng Galaxy AI, camera 200MP và S Pen thế hệ mới.',
                'content' => '<p>Samsung đã chính thức ra mắt Galaxy S24 Ultra, chiếc flagship đầu tiên tích hợp đầy đủ các tính năng AI tiên tiến. Đây là bước tiến quan trọng trong việc đưa trí tuệ nhân tạo vào cuộc sống hàng ngày của người dùng.</p>

<h3>Galaxy AI - Trí tuệ nhân tạo toàn diện</h3>
<p>Galaxy AI bao gồm nhiều tính năng thông minh như Circle to Search, Live Translate, Note Assist và Photo Assist. Người dùng có thể dễ dàng tìm kiếm bằng cách khoanh tròn đối tượng trên màn hình, dịch cuộc gọi real-time và chỉnh sửa ảnh bằng AI.</p>

<h3>Camera 200MP đỉnh cao</h3>
<p>Hệ thống camera quad với cảm biến chính 200MP, telephoto 50MP zoom 5x và ultra-wide 12MP. Tính năng ProVisual Engine được nâng cấp giúp chụp ảnh đêm sắc nét hơn và video 8K mượt mà.</p>

<h3>S Pen thế hệ mới</h3>
<p>S Pen được cải tiến với độ trễ thấp hơn và tính năng Air Actions mở rộng. Việc ghi chú và vẽ trên Galaxy S24 Ultra trở nên tự nhiên hơn bao giờ hết.</p>

<p>Galaxy S24 Ultra sẽ lên kệ từ 26/1/2024 với giá 33.990.000 VND cho bản 256GB.</p>',
                'featured_image' => 'images/news/news-2.jpg',
                'gallery' => ['images/news/news-2.jpg', 'images/news/news-3.jpg'],
                'category' => 'Smartphone',
                'tags' => ['Samsung', 'Galaxy S24', 'Android', 'AI'],
                'author' => 'Mobile Expert',
                'published_at' => now()->subDays(5),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'seo_title' => 'Samsung Galaxy S24 Ultra với AI - Đánh giá chi tiết',
                'seo_description' => 'Galaxy S24 Ultra tích hợp AI toàn diện, camera 200MP và S Pen cải tiến. Xem đánh giá chi tiết và so sánh giá tốt nhất.',
                'seo_keywords' => 'Galaxy S24 Ultra, Samsung AI, smartphone Android, S Pen'
            ],
            [
                'title' => 'MacBook Air M3: Hiệu năng vượt trội trong thiết kế mỏng nhẹ',
                'slug' => 'macbook-air-m3-hieu-nang-vuot-troi',
                'excerpt' => 'Apple giới thiệu MacBook Air M3 với chip mới mạnh mẽ, hỗ trợ hai màn hình ngoài và thời lượng pin 18 giờ.',
                'content' => '<p>Apple đã chính thức công bố MacBook Air với chip M3, mang lại hiệu năng vượt trội cho segment laptop mỏng nhẹ. Đây là bản nâng cấp đáng kể so với thế hệ M2, đặc biệt về khả năng xử lý đồ họa và AI.</p>

<h3>Chip M3 thế hệ mới</h3>
<p>Chip M3 được sản xuất trên tiến trình 3nm, mang lại hiệu năng CPU nhanh hơn 20% và GPU nhanh hơn 65% so với M1. Neural Engine 16-core giúp xử lý các tác vụ machine learning nhanh hơn gấp đôi.</p>

<h3>Hỗ trợ hai màn hình ngoài</h3>
<p>Lần đầu tiên MacBook Air có thể hỗ trợ đồng thời hai màn hình ngoài khi đóng laptop. Điều này mở ra khả năng làm việc đa nhiệm tốt hơn cho các professional.</p>

<h3>Thiết kế không đổi, chất lượng cao</h3>
<p>MacBook Air M3 vẫn giữ nguyên thiết kế mỏng 11.3mm và trọng lượng 1.24kg. Thời lượng pin lên đến 18 giờ duyệt web và 15 giờ phát video.</p>

<p>MacBook Air M3 có giá từ 32.999.000 VND cho bản 13-inch và 35.999.000 VND cho bản 15-inch.</p>',
                'featured_image' => 'images/news/news-3.jpg',
                'gallery' => ['images/news/news-3.jpg', 'images/news/news-4.jpg'],
                'category' => 'Laptop',
                'tags' => ['MacBook', 'Apple M3', 'Laptop', 'macOS'],
                'author' => 'Laptop Reviewer',
                'published_at' => now()->subWeek(),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
                'seo_title' => 'MacBook Air M3 2024 - Đánh giá chi tiết và giá bán',
                'seo_description' => 'MacBook Air M3 với hiệu năng mạnh mẽ, hỗ trợ 2 màn hình ngoài và pin 18h. Xem đánh giá chi tiết và giá tốt nhất.',
                'seo_keywords' => 'MacBook Air M3, Apple laptop, chip M3, laptop mỏng nhẹ'
            ],
            [
                'title' => 'Xu hướng công nghệ 2024: AI, VR và Web3 dẫn dắt thị trường',
                'slug' => 'xu-huong-cong-nghe-2024-ai-vr-web3',
                'excerpt' => 'Năm 2024 đánh dấu sự bùng nổ của AI generative, thực tế ảo và công nghệ blockchain trong cuộc sống hàng ngày.',
                'content' => '<p>Năm 2024 được dự báo sẽ là năm đột phá của nhiều công nghệ mới, với AI, VR/AR và Web3 dẫn dắt các xu hướng chính. Các công ty công nghệ lớn đang đầu tư mạnh mẽ vào những lĩnh vực này.</p>

<h3>AI Generative thống trị</h3>
<p>ChatGPT, Claude và Gemini đang thay đổi cách chúng ta làm việc và học tập. Các tính năng AI được tích hợp vào mọi ứng dụng từ productivity đến creative tools.</p>

<h3>VR/AR bước vào mainstream</h3>
<p>Apple Vision Pro và Meta Quest 3 đang làm cho công nghệ mixed reality trở nên phổ biến hơn. Các ứng dụng trong giáo dục, y tế và entertainment đang phát triển mạnh mẽ.</p>

<h3>Web3 và Blockchain thực tế hóa</h3>
<p>Sau giai đoạn hype, Web3 đang tập trung vào các ứng dụng thực tế như DeFi, NFT utility và decentralized identity. Các dự án có tính ứng dụng cao đang được ưu tiên.</p>

<p>Những xu hướng này sẽ tạo ra nhiều cơ hội nghề nghiệp mới và thay đổi cách chúng ta tương tác với công nghệ.</p>',
                'featured_image' => 'images/news/news-4.jpg',
                'gallery' => ['images/news/news-4.jpg', 'images/news/news-5.jpg', 'images/news/news-1.jpg'],
                'category' => 'Công nghệ',
                'tags' => ['AI', 'VR', 'Web3', 'Xu hướng'],
                'author' => 'Tech Analyst',
                'published_at' => now()->subDays(10),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
                'seo_title' => 'Xu hướng công nghệ 2024 - AI, VR và Web3 bùng nổ',
                'seo_description' => 'Tìm hiểu những xu hướng công nghệ hot nhất 2024: AI generative, thực tế ảo VR/AR và Web3 blockchain.',
                'seo_keywords' => 'xu hướng công nghệ 2024, AI, VR, Web3, blockchain'
            ]
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}
