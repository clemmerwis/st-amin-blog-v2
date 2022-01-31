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
        'category_id',
    ];

    protected $dates = ['published_at'];

    protected $with = ['author', 'category'];

    // One To Many (Inverse) / Belongs To
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // One To Many (Inverse) / Belongs To
    public function category()
    {
        return $this->belongsTo(Category::class);
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
