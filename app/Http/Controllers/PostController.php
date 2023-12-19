<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        
        $posts = Post::where('active', '1')
            ->when($category, function ($query, $category) {
                return $query->whereHas('categories', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            }, function ($query) {
                // When no category parameter is provided, return all posts except stories-of-mirrors
                return $query->whereDoesntHave('categories', function ($query) {
                    $query->where('slug', 'stories-of-mirrors');
                });
            })
            ->orderBy('published_at', 'Asc')
            ->paginate(10);
        
            
        return view('blog.index', compact('posts'));
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
        $post = Post::where('slug', $slug)
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('slug', $category);
            })
            ->firstOrFail();
        
        // Find the next post (published after the current post)
        $nextPost = Post::where('published_at', '>', $post->published_at)
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('slug', $category);
            })
            ->orderBy('published_at', 'asc')
            ->first();
        
        // Find the previous post (published before the current post)
        $prevPost = Post::where('published_at', '<', $post->published_at)
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('slug', $category);
            })
            ->orderBy('published_at', 'desc')
            ->first();

        // Prepare the prevNext array
        $prevNext = [
            'prev' => [
                'url' => $prevPost ? route('posts.show', ['category' => $category, 'slug' => $prevPost->slug]) : null,
                'title' => $prevPost ? $prevPost->title : null,
            ],
            'next' => [
                'url' => $nextPost ? route('posts.show', ['category' => $category, 'slug' => $nextPost->slug]) : null,
                'title' => $nextPost ? $nextPost->title : null,
            ],
        ];
        
        // blog.single-default 
        $template = 'blog.single-' . $post->detail->template_name;
        
        return view($template, compact('post', 'prevNext'));
    }
}