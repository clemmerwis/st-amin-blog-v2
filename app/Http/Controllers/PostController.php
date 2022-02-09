<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('active', '1')->orderBy('published_at', 'desc')->paginate(10);
        return view('blog.index', compact('posts'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $template = $post->detail->template_name;
        $template = 'blog.single-'.$template;
        return view($template, compact('post'));
    }
}
