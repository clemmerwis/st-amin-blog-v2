<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function getFeaturedImage(Post $post)
    {
        $featuredImg = $post->getFirstMedia('featured-images')?->toArray() ?? [];
        $urlFeaturedImg = $post->getFirstMediaUrl('featured-images');


        return response()->json([
            'featuredImg'    => $featuredImg,
            'urlFeaturedImg' => $urlFeaturedImg
        ]);
    }
}