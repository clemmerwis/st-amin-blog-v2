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
            })
            ->orderBy('published_at', 'desc')
            ->paginate(10);
            
        return view('blog.index', compact('posts'));
    }

    /**
     * Display a listing of the resource based on category.
     *
     * @param string $category
     * @return \Illuminate\View\View
     */
    public function byCcategory($category)
    {
        $posts = Post::where('active', '1')
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('slug', $category);
            })
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        
        return view('blog.index', compact('posts'));
    }


    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->get()[0];
        $template = 'blog.single-'.$post->detail->template_name;
        return view($template, compact('post'));
    }
}