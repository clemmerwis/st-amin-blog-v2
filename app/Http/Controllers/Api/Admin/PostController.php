<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostIndexResource;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Option to paginate a specified number of rows
        $rowsPerPage = $request->query('limit', 10);

        return PostIndexResource::collection(
            Post::orderBy('id', 'desc')
                            ->paginate(request('page') ? $rowsPerPage : 10000)
        );
    }

    public function update(Request $request, post $post)
    {
        $request->validate([
            'active'   => 'required',
            'featured' => 'required',
            'title'    => 'required',
            'slug'     => 'required',
            'body'     => 'required'
        ]);

        // Log the values of fields in the request
        Log::info('Request Data:', [$request->input('image_featured')]);

        // limit payload (no image)
        $payload = $request->only([
            'active',
            'featured',
            'title',
            'slug',
            'excerpt',
            'body'
        ]);

        // update post
        $post->update($payload);

        if ($request->input('image_featured') === "clear") {
            $post->clearMediaCollection('featured-images');
        }
        else {
            // save image
            $file = $request->file('image_featured');
            // Log::info('File Details:', [$request->hasFile('image_featured')]);
            if($file) {
                // clear collection because each post can only have one featured image
                $post->clearMediaCollection('featured-images');
                $post->addMediaFromRequest('image_featured')->toMediaCollection('featured-images');
            }
        }

        return response()->json(['ok' => true], 201);
    }
}