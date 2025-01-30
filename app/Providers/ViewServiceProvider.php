<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Post;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Restrict to specific views only
        View::composer(['partials.nav-magazine', 'partials.nav-mobile-magazine'], function ($view) {
            // Eager load subcategories for the 'Magazine' category
            $subcats = Category::where('parent_id', function ($query) {
                $query->select('id')->from('categories')->where('name', 'Magazine')->limit(1);
            })->get(['id', 'name', 'slug']);
            
            $latest = Post::where('active', '1')
                ->whereDoesntHave('categories', function ($query) {
                    $query->where('slug', 'stories-of-mirrors');
                })
                ->with([
                    'media', // Eager load meda for images
                    'categories' => function ($query) {
                        $query->select('id', 'name', 'slug', 'parent_id'); // Load only necessary fields
                    },
                    'categories.parent'
                ]) // Eager load media and parent categories
                ->orderBy('published_at', 'desc')
                ->take(5)
                ->get();

            $view->with('subcats', $subcats)
                 ->with('latest', $latest);
        });
        // if (!$this->isAdminRoute()) {
        //     View::composer('*', function ($view) {
        //         $subcats = Category::where('name', 'Magazine')->first()->subcats;
        //         $latest = Post::where('active', '1')
        //             ->whereDoesntHave('categories', function ($query) {
        //                 $query->where('slug', 'stories-of-mirrors'); // add boolean to reduce query calls
        //             })
        //             ->with('media')
        //             ->orderBy('published_at', 'desc')
        //             ->take(5)
        //             ->get();

        //         $view->with('subcats', $subcats)
        //             ->with('latest', $latest);
        //     });
        // }
    }
    
    private function isAdminRoute()
    {
        return request()->is('admin/*') || request()->is('admin');
    }
}