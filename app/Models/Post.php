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

    // how to use: $post->featured_image_url
    public function getFeaturedImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('featured-images') ? 
            asset($this->getFirstMediaUrl('featured-images')) : asset('img/categories-list/cl-1.jpg');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post')->withTimestamps();
    }

    public function detail()
    {
        return $this->hasOne(Detail::class);
    }

    // public function likes()
    // {
    //     return $this->hasMany(Like::class);
    // }

    // public function likedBy(User $user)
    // {
    //     return $this->likes->contains('user_id', $user->id);
    // }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}