<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('active', '1')->orderBy('published_at', 'desc')->paginate(10);
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