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

        // Fetch subcategories of 'Magazine'
        $subcats = Category::where('name', 'Magazine')->first()->subcats;

        // Fetch posts where category slug is 'stories-of-mirrors'
        $posts = Post::where('active', '1')
            ->whereHas('categories', function ($query) {
                $query->where('slug', 'stories-of-mirrors');
            })
            ->with('media')  // eager load media !!this is not the images collection name e.g., 'featured-image'
            ->orderBy('published_at', 'asc')
            ->get();
        
        // Fetch latest posts excluding 'stories-of-mirrors' category
        $latest = Post::where('active', '1')
            ->whereDoesntHave('categories', function ($query) {
                $query->where('slug', 'stories-of-mirrors');
            })
            ->with('media')
            ->orderBy('published_at', 'desc')
            ->take(5)  // Assuming you want to show the 5 latest posts
            ->get();
        
        return view('index', compact('posts', 'subcats', 'latest', 'active'));
    }
}