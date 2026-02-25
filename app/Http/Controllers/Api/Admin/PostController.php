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
            // product
            'product_name' => 'nullable|string',
            'product_price' => 'nullable|integer',
            'product_type' => 'nullable|in:digital,physical',
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
            'product_name',
            'product_price',
            'product_type',
        ]));
        $post->author_id = auth()->user()->id;
        $post->published_at = now();
        $post->save();

        $parentCategory = Category::whereIn('id', $categoryIds)
            ->whereNull('parent_id')
            ->first();
        $categorySlug = $parentCategory ? $parentCategory->slug : 'uncategorized';

        $detail = new Detail();
        $detail->seo_meta = [
            'title' => $request->input('title', ''),
            'keywords' => '',
            'description' => $request->input('excerpt', ''),
            'author' => auth()->user()->name,
            'ogTitle' => $request->input('title', ''),
            'ogDescription' => $request->input('excerpt', ''),
            'ogUrl' => "https://storiesofmirrors.com/posts/{$categorySlug}/" . $request->input('slug'),
            'twitterTitle' => $request->input('title', ''),
            'twitterDescription' => $request->input('excerpt', ''),
        ];
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
            // product
            'product_name' => 'nullable|string',
            'product_price' => 'nullable|integer',
            'product_type' => 'nullable|in:digital,physical',
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
            'product_name',
            'product_price',
            'product_type',
        ]);

        $seoData = $request->only([
            'seo_title',
            'seo_description',
            'seo_keywords',
            'seo_author',
        ]);
        $parentCategory = $post->categories->firstWhere('parent_id', null);
        $categorySlug = $parentCategory ? $parentCategory->slug : 'uncategorized';

        $seoMeta = [
            'title' => $seoData["seo_title"] ?? '',
            'keywords' => $seoData["seo_keywords"] ?? '',
            'description' => $seoData["seo_description"] ?? '',
            'author' => $seoData["seo_author"] ?? '',

            'ogTitle' => $seoData["seo_title"] ?? '',
            'ogDescription' => $seoData["seo_description"] ?? '',
            'ogUrl' => "https://storiesofmirrors.com/posts/{$categorySlug}/" . ($payload['slug']),

            'twitterTitle' => $seoData["seo_title"] ?? '',
            'twitterDescription' => $seoData["seo_description"] ?? '',
        ];

        if ($post->detail) {
            $post->detail->seo_meta = $seoMeta;
            $post->detail->save();
        }
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

    public function destroy(Post $post)
    {
        // Detach all categories before deleting
        $post->categories()->detach();

        // Clear all media collections
        $post->clearMediaCollection('featured-images');
        $post->clearMediaCollection('featured-gifs');

        // Delete associated detail record if exists
        if ($post->detail) {
            $post->detail->delete();
        }

        $post->delete();

        return response()->json(['ok' => true]);
    }
}