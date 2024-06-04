<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $active = "home";

        // Fetch posts where category slug is 'stories-of-mirrors'
        $posts = Post::where('active', '1')
            ->whereHas('categories', function ($query) {
                $query->where('slug', 'stories-of-mirrors');
            })
            ->with('media')  // eager load media !!this is not the images collection name e.g., 'featured-image'
            ->orderBy('published_at', 'asc')
            ->get();
        
        return view('index', compact('posts', 'active'));
    }
}