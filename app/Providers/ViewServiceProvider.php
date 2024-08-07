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
        if (!$this->isAdminRoute()) {
            View::composer('*', function ($view) {
                $subcats = Category::where('name', 'Magazine')->first()->subcats;
                $latest = Post::where('active', '1')
                    ->whereDoesntHave('categories', function ($query) {
                        $query->where('slug', 'stories-of-mirrors'); // add boolean to reduce query calls
                    })
                    ->with('media')
                    ->orderBy('published_at', 'desc')
                    ->take(5)
                    ->get();

                $view->with('subcats', $subcats)
                    ->with('latest', $latest);
            });
        }
    }
    
    private function isAdminRoute()
    {
        return request()->is('admin/*') || request()->is('admin');
    }
}