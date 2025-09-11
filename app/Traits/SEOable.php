<?php

namespace App\Traits;

trait SEOable
{
    /**
     * Get SEO title for the model
     */
    public function getSeoTitle(): string
    {
        return $this->getAttribute('seo_title') ?? $this->getAttribute('title') ?? $this->getAttribute('name') ?? config('seo.defaults.title');
    }

    /**
     * Get SEO description for the model
     */
    public function getSeoDescription(): string
    {
        $description = $this->getAttribute('seo_description') ?? $this->getAttribute('description') ?? $this->getAttribute('excerpt') ?? '';

        if (empty($description) && $this->getAttribute('content')) {
            $description = strip_tags($this->getAttribute('content'));
        }

        return \Str::limit($description, 160) ?: config('seo.defaults.description');
    }

    /**
     * Get SEO keywords for the model
     */
    public function getSeoKeywords(): string
    {
        $keywords = $this->getAttribute('seo_keywords') ?? $this->getAttribute('keywords') ?? '';

        if (empty($keywords)) {
            // Tự động tạo keywords từ title, category, tags
            $autoKeywords = [];

            if ($this->getAttribute('title')) {
                $autoKeywords[] = $this->getAttribute('title');
            }

            if ($this->getAttribute('name')) {
                $autoKeywords[] = $this->getAttribute('name');
            }

            if ($this->getAttribute('category')) {
                $autoKeywords[] = $this->getAttribute('category');
            }

            if ($this->getAttribute('tags') && is_array($this->getAttribute('tags'))) {
                $autoKeywords = array_merge($autoKeywords, $this->getAttribute('tags'));
            }

            // Thêm keywords mặc định
            $autoKeywords[] = config('app.name');
            $autoKeywords[] = config('seo.company.name');

            $keywords = implode(', ', array_filter($autoKeywords));
        }

        return $keywords ?: config('seo.defaults.keywords');
    }

    /**
     * Get OG image for the model
     */
    public function getOgImage(): string
    {
        if ($this->getAttribute('featured_image') && !empty($this->getAttribute('featured_image'))) {
            return asset($this->getAttribute('featured_image'));
        }

        if ($this->getAttribute('image') && !empty($this->getAttribute('image'))) {
            return asset($this->getAttribute('image'));
        }

        return config('seo.company.logo');
    }

    /**
     * Get canonical URL for the model
     */
    public function getCanonicalUrl(): string
    {
        if ($this->getAttribute('slug')) {
            return url($this->getRoutePrefix() . '/' . $this->getAttribute('slug'));
        }

        return url($this->getRoutePrefix() . '/' . $this->getAttribute('id'));
    }

    /**
     * Get route prefix for the model
     */
    protected function getRoutePrefix(): string
    {
        $class = class_basename($this);

        return match($class) {
            'News' => 'tin-tuc',
            'Product', 'SimpleProduct' => 'san-pham',
            default => strtolower(str_replace('_', '-', \Str::snake($class)))
        };
    }

    /**
     * Generate structured data for the model
     */
    public function getStructuredData(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => $this->getSchemaType(),
            'name' => $this->getSeoTitle(),
            'description' => $this->getSeoDescription(),
            'url' => $this->getCanonicalUrl(),
            'image' => $this->getOgImage(),
            'dateCreated' => $this->created_at?->toISOString(),
            'dateModified' => $this->updated_at?->toISOString(),
            'author' => [
                '@type' => 'Organization',
                'name' => config('seo.company.name'),
            ],
        ];
    }

    /**
     * Get Schema.org type for the model
     */
    protected function getSchemaType(): string
    {
        $class = class_basename($this);

        return match($class) {
            'News' => 'Article',
            'Product', 'SimpleProduct' => 'Product',
            default => 'Thing'
        };
    }
}
