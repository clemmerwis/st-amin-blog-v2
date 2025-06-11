<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

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
        View::composer(['partials.nav-magazine', 'partials.nav-mobile-magazine'], function ($view) 
        {
            $subcats = Cache::remember('navigation.subcats', now()->addHours(24), function () 
            {
                return Category::where('parent_id', function ($query) 
                {
                    $query->select('id')->from('categories')->where('name', 'Magazine')->limit(1);
                })->get(['id', 'name', 'slug']);
            });
            
            $latest = Cache::remember('navigation.latest_posts', now()->addHours(24), function () {
                return Post::where('active', '1')
                    ->whereDoesntHave('categories', function ($query) {
                        $query->where('slug', 'stories-of-mirrors');
                    })
                    ->with([
                        'media', 
                        'categories:id,name,slug,parent_id', 
                        'categories.parent:id,name'
                    ])
                    ->orderBy('published_at', 'desc')
                    ->take(5)
                    ->get();
            });
            
            $view->with('subcats', $subcats)->with('latest', $latest);
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