<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default SEO Configuration
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'title' => 'Star Vik - Công ty TNHH Star Vik',
        'description' => 'Công ty TNHH Star Vik - Chuyên cung cấp các sản phẩm và dịch vụ chất lượng cao',
        'keywords' => 'starvik, công ty, dịch vụ, sản phẩm, chất lượng',
        'author' => 'Star Vik - Công ty TNHH Star Vik',
        'robots' => 'index, follow',
        'og_type' => 'website',
        'og_locale' => 'vi_VN',
        'twitter_card' => 'summary_large_image',
    ],

    /*
    |--------------------------------------------------------------------------
    | Company Information
    |--------------------------------------------------------------------------
    */
    'company' => [
        'name' => 'Star Vik - Công ty TNHH Star Vik',
        'description' => 'Công ty TNHH Star Vik - Chuyên cung cấp các sản phẩm và dịch vụ chất lượng cao',
        'address' => 'Lầu 6, 195-197 Nguyễn Thị Nhung, Hiệp Bình Phước, Thủ Đức, Hồ Chí Minh, Việt Nam',
        'phone' => '0902.381.851',
        'email' => 'kd.starvik@gmail.com',
        'logo' => config('app.url') . '/images/logo/logo-starvik.png',
        'social' => [
            'facebook' => env('FACEBOOK_URL'),
            'twitter' => env('TWITTER_URL'),
            'instagram' => env('INSTAGRAM_URL'),
            'youtube' => env('YOUTUBE_URL'),
            'linkedin' => env('LINKEDIN_URL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Structured Data Configuration
    |--------------------------------------------------------------------------
    */
    'structured_data' => [
        'organization' => [
            'enabled' => true,
            'type' => 'LocalBusiness', // Organization, LocalBusiness, Corporation
            'same_as' => [
                env('FACEBOOK_URL'),
                env('TWITTER_URL'),
                env('INSTAGRAM_URL'),
            ],
        ],
        'website' => [
            'enabled' => true,
            'search_action' => [
                'enabled' => true,
                'target' => config('app.url') . '/search?q={search_term_string}',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Open Graph Configuration
    |--------------------------------------------------------------------------
    */
    'open_graph' => [
        'site_name' => 'Star Vik - Công ty TNHH Star Vik',
        'type' => 'website',
        'locale' => 'vi_VN',
        'image' => [
            'default' => config('app.url') . '/images/logo/logo-starvik.png',
            'width' => 1200,
            'height' => 630,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Twitter Card Configuration
    |--------------------------------------------------------------------------
    */
    'twitter' => [
        'card' => 'summary_large_image',
        'site' => env('TWITTER_HANDLE'),
        'creator' => env('TWITTER_HANDLE'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Sitemap Configuration
    |--------------------------------------------------------------------------
    */
    'sitemap' => [
        'static_pages' => [
            '/' => [
                'priority' => 1.0,
                'change_frequency' => 'daily',
            ],
            '/gioi-thieu' => [
                'priority' => 0.8,
                'change_frequency' => 'monthly',
            ],
            '/lien-he' => [
                'priority' => 0.7,
                'change_frequency' => 'monthly',
            ],
            '/san-pham' => [
                'priority' => 0.9,
                'change_frequency' => 'daily',
            ],
            '/tin-tuc' => [
                'priority' => 0.9,
                'change_frequency' => 'daily',
            ],
        ],
        'dynamic_models' => [
            'App\Models\News' => [
                'route_pattern' => '/tin-tuc/{id}',
                'priority' => 0.7,
                'change_frequency' => 'weekly',
            ],
            'App\Models\SimpleProduct' => [
                'route_pattern' => '/san-pham/{id}',
                'priority' => 0.8,
                'change_frequency' => 'weekly',
            ],
        ],
    ],
];
