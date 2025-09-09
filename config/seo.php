<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default SEO Configuration
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'title' => env('COMPANY_NAME', 'Star Vik'),
        'description' => env('COMPANY_DESCRIPTION', 'Công ty TNHH Star Vik'),
        'keywords' => env('SITE_KEYWORDS', 'starvik, công ty, dịch vụ'),
        'author' => env('COMPANY_NAME', 'Star Vik'),
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
        'name' => env('COMPANY_NAME', 'Star Vik'),
        'description' => env('COMPANY_DESCRIPTION'),
        'address' => env('COMPANY_ADDRESS'),
        'phone' => env('COMPANY_PHONE'),
        'email' => env('COMPANY_EMAIL'),
        'logo' => env('COMPANY_LOGO_URL', '/images/logo.png'),
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
        'site_name' => env('COMPANY_NAME', 'Star Vik'),
        'type' => 'website',
        'locale' => 'vi_VN',
        'image' => [
            'default' => env('COMPANY_LOGO_URL', '/images/logo.png'),
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
