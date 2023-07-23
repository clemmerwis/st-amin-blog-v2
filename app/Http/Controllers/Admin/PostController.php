<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostIndexResource;
use App\Http\Resources\PostDetailResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource records.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'Posts';

        // all records
        $posts = Post::all();

        $posts = PostIndexResource::collection($posts);

        return view('dashboards.admin', [
            'active' => $active,
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $active = 'PostEdit';

        // $post = new AdminPostShowResource($post);
        $post = new PostDetailResource($post);
        
        return view('dashboards.admin', [
            'active' => $active,
            'post' => $post,
        ]);
    }
}