<?php

namespace App\Helpers;

class SEOHelper
{
    /**
     * Get company information from config
     */
    public static function getCompanyInfo(): array
    {
        return [
            'name' => config('seo.company.name'),
            'description' => config('seo.company.description'),
            'address' => config('seo.company.address'),
            'phone' => config('seo.company.phone'),
            'email' => config('seo.company.email'),
            'logo' => config('seo.company.logo'),
        ];
    }

    /**
     * Generate structured data schema
     */
    public static function generateSchema(array $data): array
    {
        $company = self::getCompanyInfo();
        $type = $data['type'] ?? 'website';

        $schema = [
            '@context' => 'https://schema.org',
            'name' => $company['name'],
            'description' => $data['description'],
            'url' => $data['url'],
            'image' => $data['image'] ?? $company['logo'],
        ];

        switch ($type) {
            case 'article':
                $schema['@type'] = 'Article';
                $schema['headline'] = $data['title'] ?? $company['name'];
                $schema['author'] = [
                    '@type' => 'Person',
                    'name' => $data['author'] ?? $company['name']
                ];
                $schema['publisher'] = [
                    '@type' => 'Organization',
                    'name' => $company['name'],
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => $company['logo']
                    ]
                ];
                if (!empty($data['published_time'])) {
                    $schema['datePublished'] = $data['published_time'];
                }
                if (!empty($data['modified_time'])) {
                    $schema['dateModified'] = $data['modified_time'];
                }
                break;

            case 'product':
                $schema['@type'] = 'Product';
                $schema['name'] = $data['title'] ?? $data['name'] ?? '';
                $schema['brand'] = [
                    '@type' => 'Brand',
                    'name' => $data['brand'] ?? $company['name']
                ];
                if (!empty($data['price'])) {
                    $schema['offers'] = [
                        '@type' => 'Offer',
                        'price' => $data['price'],
                        'priceCurrency' => 'VND',
                        'availability' => 'https://schema.org/' . ($data['availability'] ?? 'InStock'),
                        'seller' => [
                            '@type' => 'Organization',
                            'name' => $company['name']
                        ]
                    ];
                }
                break;

            default: // LocalBusiness
                $schema['@type'] = 'LocalBusiness';
                $schema['address'] = [
                    '@type' => 'PostalAddress',
                    'addressCountry' => 'VN',
                    'addressLocality' => $company['address']
                ];

                if (!empty($company['phone'])) {
                    $schema['telephone'] = $company['phone'];
                }

                if (!empty($company['email'])) {
                    $schema['email'] = $company['email'];
                }
                break;
        }

        // Remove null or empty values
        return array_filter($schema, function($value) {
            if (is_array($value)) {
                return !empty(array_filter($value));
            }
            return !is_null($value) && $value !== '';
        });
    }

    /**
     * Generate meta tags
     */
    public static function generateMetaTags(array $data): array
    {
        $company = self::getCompanyInfo();

        return [
            'title' => $data['title'] ?? $company['name'],
            'description' => self::limitText($data['description'] ?? $company['description'], 160),
            'keywords' => $data['keywords'] ?? config('seo.defaults.keywords'),
            'author' => $company['name'],
            'canonical' => $data['canonical'] ?? request()->url(),
            'og_title' => $data['title'] ?? $company['name'],
            'og_description' => self::limitText($data['description'] ?? $company['description'], 160),
            'og_image' => $data['og_image'] ?? $company['logo'],
            'og_url' => $data['og_url'] ?? request()->url(),
            'og_type' => $data['type'] ?? 'website',
        ];
    }

    /**
     * Limit text length
     */
    private static function limitText(string $text, int $limit): string
    {
        return \Str::limit(strip_tags($text), $limit);
    }
}
