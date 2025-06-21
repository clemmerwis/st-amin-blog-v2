<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostIndexResource;
use App\Models\Category;
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

        // Load posts with categories relationship
        $posts = Post::with('categories')->get();
        
        // parent categories
        $parentCategories = Category::whereNull('parent_id')->pluck('name')->toArray();

        $posts = PostIndexResource::collection($posts);

        return view('dashboards.admin', [
            'active'     => $active,
            'posts'      => $posts,
            'categories' => $parentCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $active = 'PostCreate';

        // parent categories
        $parentCategories = Category::whereNull('parent_id')->pluck('name')->toArray();

        return view('dashboards.admin', [
            'active'     => $active,
            'categories' => $parentCategories,
        ]);
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

        $post->load('categories', 'detail');
        $post = new PostDetailResource($post);

        // parent categories
        $parentCategories = Category::whereNull('parent_id')->pluck('name')->toArray();

        return view('dashboards.admin', [
            'active'     => $active,
            'post'       => $post,
            'categories' => $parentCategories,
        ]);
    }
}