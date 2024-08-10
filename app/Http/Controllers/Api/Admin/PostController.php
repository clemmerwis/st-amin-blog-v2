<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Post;
use App\Models\Detail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostIndexResource;

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

    public function store(Request $request)
    {
        $request->validate([
            'active'     => 'required',
            'featured'   => 'required',
            'title'      => 'required',
            'slug'       => 'required',
            'body'       => 'required',
            'categories' => 'required|array',
        ]);

        // Extract categories from the request and ensure they're in an array format
        $categoryNames = $request->input('categories');
        if (!is_array($categoryNames)) {
            $categoryNames = json_decode($categoryNames, true);
        }

        // Convert category names to their corresponding IDs
        $categoryIds = Category::whereIn('name', $categoryNames)
            ->pluck('id')
            ->toArray();

        // Create new post
        $post = new Post($request->only([
            'active',
            'featured',
            'title',
            'slug',
            'excerpt',
            'body',
        ]));
        $post->author_id = auth()->user()->id;
        $post->published_at = now();
        $post->save();

        $detail = new Detail();
        $post->detail()->save($detail);

        // Sync categories to the new post
        $post->categories()->sync($categoryIds);

        if ($request->input('image_featured') === "clear") {
            $post->clearMediaCollection('featured-images');
        } else {
            // save image
            $file = $request->file('image_featured');
            // Log::info('File Details:', [$request->hasFile('image_featured')]);
            if ($file) {
                // clear collection because each post can only have one featured image
                $post->clearMediaCollection('featured-images');
                $post->addMediaFromRequest('image_featured')->toMediaCollection('featured-images');
            }
        }

        if ($request->input('gif_featured') === "clear") {
            $post->clearMediaCollection('featured-gifs');
        } else {
            // save gif
            $file = $request->file('gif_featured');
            // Log::info('File Details:', [$request->hasFile('image_featured')]);
            if ($file) {
                // clear collection because each post can only have one featured gif
                $post->clearMediaCollection('featured-gifs');
                $post->addMediaFromRequest('gif_featured')->toMediaCollection('featured-gifs');
            }
        }

        // Return response with the ID of the newly created post
        return response()->json(['ok' => true, 'id' => $post->id], 201);
    }

    public function update(Request $request, post $post)
    {
        $request->validate([
            'active'     => 'required',
            'featured'   => 'required',
            'title'      => 'required',
            'slug'       => 'required',
            'body'       => 'required',
            'categories' => 'required|array',
            'published_at' => 'nullable|date',
            // seo
            'seo_title'     => 'nullable|string',
            'seo_description' => 'nullable|string',
            'seo_keywords'  => 'nullable|string',
            'seo_author'    => 'nullable|string'
        ]);

        // Extract categories from the request and ensure they're in an array format
        $categoryNames = $request->input('categories');
        if (!is_array($categoryNames)) {
            $categoryNames = json_decode($categoryNames, true);
        }

        // Convert category names to their corresponding IDs
        $categoryIds = Category::whereIn('name', $categoryNames)
            ->pluck('id')
            ->toArray();

        // Sync categories to the post
        $post->categories()->sync($categoryIds);

        // Convert 'published_at' to actual null if it's an empty string or 'null'
        if (empty($request->input('published_at')) || $request->input('published_at') === 'null') {
            $request->merge(['published_at' => null]);
        }

        // // Log the values of fields in the request
        // Log::info('Request Data Image:', [$request->input('image_featured')]);

        // // Log the values of fields in the request
        // Log::info('Request Data GIF:', [$request->input('gif_featured')]);

        // limit payload
        $payload = $request->only([
            'active',
            'featured',
            'title',
            'slug',
            'excerpt',
            'body',
            'published_at',
        ]);

        $seoData = $request->only([
            'seo_title',
            'seo_description',
            'seo_keywords',
            'seo_author',
        ]);
        $seoMeta = [
            'title' => $seoData["seo_title"] ?? '',
            'keywords' => $seoData["seo_keywords"] ?? '',
            'description' => $seoData["seo_description"] ?? '',
            'author' => $seoData["seo_author"] ?? '',

            'ogTitle' => $seoData["seo_title"] ?? '',
            'ogDescription' => $seoData["seo_description"] ?? '',
            'ogUrl' => "https://storiesofmirrors.com/posts/stories-of-mirrors/" . ($payload['slug']),
            
            'twitterTitle' => $seoData["seo_title"] ?? '',
            'twitterDescription' => $seoData["seo_description"] ?? '',
        ];

        $post->detail->seo_meta = $seoMeta;
        $post->detail->save();
        $post->update($payload);

        if ($request->input('image_featured') === "clear") {
            $post->clearMediaCollection('featured-images');
        } else {
            // save image
            $file = $request->file('image_featured');
            // Log::info('File Details:', [$request->hasFile('image_featured')]);
            if ($file) {
                // clear collection because each post can only have one featured image
                $post->clearMediaCollection('featured-images');
                $post->addMediaFromRequest('image_featured')->toMediaCollection('featured-images');
            }
        }

        if ($request->input('gif_featured') === "clear") {
            $post->clearMediaCollection('featured-gifs');
        } else {
            // save gif
            $file = $request->file('gif_featured');
            // Log::info('File Details:', [$request->hasFile('image_featured')]);
            if ($file) {
                // clear collection because each post can only have one featured gif
                $post->clearMediaCollection('featured-gifs');
                $post->addMediaFromRequest('gif_featured')->toMediaCollection('featured-gifs');
            }
        }

        return response()->json(['ok' => true], 201);
    }
}