<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
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
        
        $active = $category === 'stories-of-mirrors' ? 'SoM' : 'magazine';
        
        $posts = Post::where('active', '1')
            ->when($category, function ($query, $category) {
                return $query->whereHas('categories', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            }, function ($query) {
                // when category is null, return all posts EXCEPT stories-of-mirrors
                // in future also make it avoid other specific post types
                return $query->whereDoesntHave('categories', function ($query) {
                    $query->where('slug', 'stories-of-mirrors');
                });
            })
            ->orderBy('published_at', 'asc')
            ->paginate(10);
        
        // Get the category name if a category is provided
        $categoryName = $category ? Category::where('slug', $category)->value('name') : null;
            
        return view('blog.index', compact('posts', 'active', 'category', 'categoryName'));
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
        // Find the current post
        $post = Post::whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        })->where('slug', $slug)->firstOrFail();

        // Find the category
        $category = Category::where('slug', $category)->firstOrFail();

        // Get all posts in the same category, ordered by published_at
        $posts = $category->posts()
            ->where('active', true)
            ->orderBy('published_at')
            ->get(['id', 'slug', 'title', 'published_at', 'author_id']);
    
        // Find the index of the current post
        $currentIndex = $posts->search(function ($item) use ($post) {
            return $item->id === $post->id;
        });

        // Get previous and next posts
        $prevPost = $currentIndex > 0 ? $posts[$currentIndex - 1] : null;
        $nextPost = $currentIndex < $posts->count() - 1 ? $posts[$currentIndex + 1] : null;
    
        // Prepare the prevNext array
        $prevNext = [
            'prev' => ['url' => null, 'title' => null, 'author' => null],
            'next' => ['url' => null, 'title' => null, 'author' => null]
        ];
    
        // Prepare the prevNext array
        $prevNext = [
            'prev' => $prevPost ? [
                'url' => route('posts.show', ['category' => $category->slug, 'slug' => $prevPost->slug]),
                'title' => $prevPost->title,
                'author' => $prevPost->author->name
            ] : ['url' => null, 'title' => null, 'author' => null],
            'next' => $nextPost ? [
                'url' => route('posts.show', ['category' => $category->slug, 'slug' => $nextPost->slug]),
                'title' => $nextPost->title,
                'author' => $nextPost->author->name
            ] : ['url' => null, 'title' => null, 'author' => null]
        ];

        // Get SEO meta information for sharing
        $seoMeta = $post->detail->seo_meta;

        // Generate share URLs
        $shareUrls = [
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($seoMeta['ogUrl']),
            'twitter' => 'https://twitter.com/intent/tweet?text=' . urlencode($seoMeta['twitterTitle']) . '&url=' . urlencode($seoMeta['ogUrl']),
            'email' => 'mailto:?subject=' . urlencode($seoMeta['title']) . '&body=' . urlencode($seoMeta['description'] . ' ' . $seoMeta['ogUrl'])
        ];
    
        // Determine the template
        $template = 'blog.single-' . $post->detail->template_name;
    
        return view($template, compact('post', 'prevNext', 'shareUrls'));
    }
}