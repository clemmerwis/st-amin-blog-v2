<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{

    public function getFeaturedImage(Post $post)
    {
        $featuredImg    = $post->getFirstMedia('featured-images')?->toArray() ?? [];
        $urlFeaturedImg = $post->getFirstMediaUrl('featured-images');

        return response()->json([
            'featuredImg'    => $featuredImg,
            'urlFeaturedImg' => $urlFeaturedImg,
        ]);
    }

    public function getFeaturedGif(Post $post)
    {
        $featuredGif    = $post->getFirstMedia('featured-gifs')?->toArray() ?? [];
        $urlFeaturedGif = $post->getFirstMediaUrl('featured-gifs');

        return response()->json([
            'featuredGif'    => $featuredGif,
            'urlFeaturedGif' => $urlFeaturedGif,
        ]);
    }
}
