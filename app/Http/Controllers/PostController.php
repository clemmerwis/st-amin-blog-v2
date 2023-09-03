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
                // This part is executed when $category is null or false
                return $query->whereDoesntHave('categories', function ($query) {
                    $query->where('slug', 'stories-of-mirrors');
                });
            })
            ->orderBy('published_at', 'desc')
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

        $template = 'blog.single-' . $post->detail->template_name;
        return view($template, compact('post'));
    }
}