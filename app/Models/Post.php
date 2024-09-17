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

    protected $with = ['author', 'categories', 'detail'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400);
    }

    // how to use accessors example: $post->featured_image_url
    public function getFeaturedImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('featured-images') ? 
            asset($this->getFirstMediaUrl('featured-images')) : asset('img/categories-list/cl-1.jpg');
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

    public function detail()
    {
        return $this->hasOne(Detail::class);
    }
}