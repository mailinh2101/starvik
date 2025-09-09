<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\SEOable;

class SimpleProduct extends Model
{
    use HasFactory, SEOable;

    protected $table = 'simple_products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'gallery',
        'category',
        'brand',
        'specifications',
        'is_featured',
        'is_active',
        'sort_order',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_image'
    ];

    protected $casts = [
        'gallery' => 'array',
        'specifications' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByBrand($query, $brand)
    {
        return $query->where('brand', $brand);
    }

    // Mutators
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $value ?: \Str::slug($this->name);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/no-image.jpg');
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

    // Relationships (if needed in future)
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    // Route key name for URL generation
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Get product URL
    public function getUrlAttribute()
    {
        return route('products.show', $this->slug);
    }

    // Check if product has gallery
    public function hasGallery()
    {
        return !empty($this->gallery);
    }

    // Get first gallery image
    public function getFirstGalleryImageAttribute()
    {
        if ($this->hasGallery()) {
            return asset('storage/' . $this->gallery[0]);
        }
        return $this->image_url;
    }
}
