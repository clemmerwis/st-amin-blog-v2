<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'image_path',
        'active',
        'featured',
    ];

    protected $dates = ['published_at'];

    protected $with = ['author', 'categories', 'detail'];


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
        return $this->hasOne(Detail::class, 'detail_id');
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
