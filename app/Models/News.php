<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SEOable;

class News extends Model
{
    use HasFactory, SEOable;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'gallery',
        'category',
        'tags',
        'author',
        'published_at',
        'is_featured',
        'is_active',
        'is_published',
        'sort_order',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_image'
    ];

    protected $casts = [
        'gallery' => 'array',
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_published' => 'boolean',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('published_at', 'desc')->limit($limit);
    }

    // Mutators
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $value ?: \Str::slug($this->title);
    }

    // Accessors
    public function getImageAttribute()
    {
        return $this->featured_image;
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image ? asset('storage/' . $this->featured_image) : asset('images/no-image.jpg');
    }

    public function getGalleryUrlsAttribute()
    {
        if (!$this->gallery) {
            return [];
        }

        return collect($this->gallery)->map(function ($image) {
            return asset('storage/' . $image);
        })->toArray();
    }

    public function getExcerptAttribute($value)
    {
        return $value ?: \Str::limit(strip_tags($this->content), 160);
    }

    // Route key name for URL generation
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Get news URL
    public function getUrlAttribute()
    {
        return route('news.show', $this->slug);
    }

    // Check if news has gallery
    public function hasGallery()
    {
        return !empty($this->gallery);
    }

    // Get formatted published date
    public function getFormattedDateAttribute()
    {
        return $this->published_at->format('d/m/Y');
    }

    // Get reading time estimate
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $readingTime = ceil($wordCount / 200); // Average reading speed: 200 words per minute
        return $readingTime;
    }

    // Check if published
    public function isPublished()
    {
        return $this->published_at && $this->published_at <= now() && $this->is_active;
    }
}
