<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $casts = [
        'seo_meta' => 'array',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}