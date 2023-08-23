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
     * @param  string $category (optional)
     * @param  string $subcategory (optional)
     * @param  string $slug
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $slug)
    {
        $category = $request->query('category');
        $subcategory = $request->query('subcategory');
    
        $post = Post::where('slug', $slug)
            ->when($category, function ($query, $category) {
                return $query->whereHas('categories', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->when($subcategory, function ($query, $subcategory) {
                return $query->whereHas('categories.subcats', function ($q) use ($subcategory) {
                    $q->where('slug', $subcategory);
                });
            })
            ->first();
    
        $template = 'blog.single-' . $post->detail->template_name;
        return view($template, compact('post'));
    }
}