<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Blog;

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
        // fetch the blogs from the database
        $blogs = \App\Models\Blog::latest()->take(3)->get();

        $blogsArray = [];
        foreach ($blogs as $blog) {
            $blogsArray[] = [
                'image' => $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('images/default_blog_image.jpg'),
                'date' => $blog->created_at->format('M d, Y'),
                'author' => $blog->author,
                'comments' => $blog->comments_count ?? 0,
                'title' => $blog->title,
                'excerpt' => \Illuminate\Support\Str::limit($blog->content, 100),
                'slug' => $blog->slug,
                // 'link' => route('blog.showBlogDetail', $blog->slug)
                'link' => url('/blog/' . $blog->slug)
            ];
        }

        View::share('recentBlogs', $blogsArray ?? []); // Share with all views
    }
}
