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
    
        // Fetch posts with required relationships and select only necessary columns
        $posts = Post::with([
            'categories' => function ($query) {
                $query->select('id', 'name', 'slug', 'parent_id'); // Only load necessary columns
            },
            'categories.parent', // Eager load parent categories
            'media' // Eager load media for featured images
        ])
        ->select('id', 'title', 'slug', 'published_at') // Only fetch required columns
        ->where('active', true)
        ->whereHas('categories', function ($query) {
            $query->where('slug', 'stories-of-mirrors'); // Filter posts by category slug
        })
        ->orderBy('published_at', 'asc')
        ->get();
    
        return view('index', compact('posts', 'active'));
    }
    
}