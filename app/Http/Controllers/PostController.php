<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        
        $active = $category === 'stories-of-mirrors' ? 'SoM' : 'magazine';
        
        $posts = Post::where('active', '1')
            ->when($category, function ($query, $category) {
                return $query->whereHas('categories', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            }, function ($query) {
                // when category is null, return all posts EXCEPT stories-of-mirrors
                // in future also make it avoid other specific post types
                return $query->whereDoesntHave('categories', function ($query) {
                    $query->where('slug', 'stories-of-mirrors');
                });
            })
            ->orderBy('published_at', 'asc')
            ->paginate(10);
        
        // Get the category name if a category is provided
        $categoryName = $category ? Category::where('slug', $category)->value('name') : null;
            
        return view('blog.index', compact('posts', 'active', 'category', 'categoryName'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string $category
     * @param  string $slug
     * @return \Illuminate\View\View
     */
    public function show($category, $slug)
    {
        // Fetch the main post with all necessary relationships in a single query
        $post = Post::with([
            'media', 
            'detail', 
            'author', 
            'categories' => function($query) {
                $query->with('subcats');
            }
        ])
        ->where('slug', $slug)
        ->whereHas('categories', function ($q) use ($category) {
            $q->where('slug', $category);
        })
        ->firstOrFail();
    
        // Fetch adjacent posts in a single query
        $adjacentPosts = Post::select('id', 'slug', 'title', 'published_at', 'author_id')
            ->with('author:id,name')
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('slug', $category);
            })
            ->where('published_at', '!=', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->when($post->published_at, function ($query, $publishedAt) {
                return $query->where(function ($q) use ($publishedAt) {
                    $q->where('published_at', '>', $publishedAt)
                      ->orWhere('published_at', '<', $publishedAt);
                });
            })
            ->limit(2)
            ->get();
    
        // Prepare the prevNext array
        $prevNext = [
            'prev' => ['url' => null, 'title' => null, 'author' => null],
            'next' => ['url' => null, 'title' => null, 'author' => null]
        ];
    
        foreach ($adjacentPosts as $adjacentPost) {
            $key = $adjacentPost->published_at < $post->published_at ? 'prev' : 'next';
            $prevNext[$key] = [
                'url' => route('posts.show', ['category' => $category, 'slug' => $adjacentPost->slug]),
                'title' => $adjacentPost->title,
                'author' => $adjacentPost->author->name
            ];
        }
    
        // Determine the template
        $template = 'blog.single-' . $post->detail->template_name;
    
        return view($template, compact('post', 'prevNext'));
    }
}