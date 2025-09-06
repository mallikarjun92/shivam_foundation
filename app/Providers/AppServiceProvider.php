<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::share('recentBlogs', [
            [
                'image' => 'images/image_1.jpg',
                'title' => 'Even the all-powerful Pointing has no control about',
                'date' => 'July 12, 2018',
                'author' => 'Admin',
                'comments' => 19
            ],
            [
                'image' => 'images/image_2.jpg',
                'title' => 'Even the all-powerful Pointing has no control about',
                'date' => 'July 12, 2018',
                'author' => 'Admin',
                'comments' => 19
            ]
        ]);
    }
}
