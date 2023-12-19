<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch posts where category slug is 'stories-of-mirrors'
        $posts = Post::where('active', '1')
            ->whereHas('categories', function ($query) {
                $query->where('slug', 'stories-of-mirrors');
            })
            ->with('media')  // eager load media !!this is not the images collection name e.g., 'featured-image'
            ->orderBy('published_at', 'Asc')
            ->get();
        
        return view('index', compact('posts'));
    }
}