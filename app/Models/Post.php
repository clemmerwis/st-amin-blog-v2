<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
        'active' => 'boolean'
    ];

    //protected $with = ['author', 'categories', 'detail'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400);

        $this->addMediaConversion('social')
            ->width(1200)
            ->height(630)
            ->fit('crop', 1200, 630);
    }

    // how to use accessors example: $post->featured_image_url
    public function getFeaturedImageUrlAttribute()
    {
        if (!$this->relationLoaded('media')) {
            $this->load('media');
        }

        return $this->getFirstMedia('featured-images')
            ? $this->getFirstMedia('featured-images')->getUrl('thumb')
            : asset('img/categories-list/cl-1.jpg');
    }

    public function getSocialImageUrlAttribute()
    {
        if (!$this->relationLoaded('media')) {
            $this->load('media');
        }

        $media = $this->getFirstMedia('featured-images');
        if (!$media) {
            return asset('img/stories-of-mirrors/ssGirlHouseLogo.jpg');
        }

        // Use the social conversion if it exists, otherwise fall back to the original
        return $media->hasGeneratedConversion('social')
            ? $media->getUrl('social')
            : $media->getUrl();
    }

    public function getFeaturedImageThumbUrlAttribute()
    {
        return $this->getFirstMedia('featured-images')
            ? $this->getFirstMedia('featured-images')->getUrl('thumb') 
            : asset('img/categories-list/cl-1.jpg');
    }

    public function getFeaturedGifUrlAttribute()
    {
        return $this->getFirstMediaUrl('featured-gifs') ? 
            asset($this->getFirstMediaUrl('featured-gifs')) : asset('img/hero/red.gif');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post')->withTimestamps();
    }

    public function getParentcatAttribute()
    {
        return $this->categories->firstWhere('parent_id', null);
    }

    public function getIsPurchasableAttribute()
    {
        return $this->featured && $this->product_name && $this->product_price;
    }

    public function detail()
    {
        return $this->hasOne(Detail::class);
    }
}