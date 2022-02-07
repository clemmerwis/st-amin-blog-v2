<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    protected $with = ['subcats'];

    public function subcats()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // One To Many / Has Many
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post')->withTimestamps();
    }
}
