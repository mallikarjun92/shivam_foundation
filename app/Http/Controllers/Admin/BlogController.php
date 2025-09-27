<?php
// app/Http/Controllers/Admin/BlogController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'boolean'
        ]);

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blogs', 'public');
            $validated['featured_image'] = $imagePath;
        }

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($request->title);
        $validated['published_at'] = $request->published ? now() : null;

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'boolean'
        ]);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('blogs', 'public');
            $validated['featured_image'] = $imagePath;
        }

        $validated['slug'] = Str::slug($request->title);
        $validated['published_at'] = $request->published ? now() : null;

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        // Delete associated image
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }

    public function listBlogs(Request $request, $page = 1)
    {
        $blogPosts = Blog::where('published', true)->latest()->paginate(5, ['*'], 'page', $page);

        $allBlogs = [];
        foreach ($blogPosts as $post) {
            $allBlogs[] = [
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'image' => $post->featured_image ? asset('storage/' . $post->featured_image) : asset('images/default_blog_image.jpg'),
                'date' => $post->created_at->format('M d, Y'),
                'author' => $post->author ?? 'Admin',
                // 'comments' => $post->comments()->count(),
                'link' => route('blog.showBlogDetail', $post->slug)
            ];
        }

        // Get current page from request, default to 1
        $currentPage = LengthAwarePaginator::resolveCurrentPage() ?: 1;
        
        // Define how many items we want per page
        $perPage = 6;
        
        // Slice the array to get the items for the current page
        $currentPageItems = array_slice($allBlogs, ($currentPage - 1) * $perPage, $perPage);
        
        // Create LengthAwarePaginator instance
        $blogs = new LengthAwarePaginator(
            $currentPageItems,
            count($allBlogs),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query()
            ]
        );

        return view('blog.index', compact('blogs'));
    }

    public function showBlogDetail($slug)
    {
        // recent posts
        $recentBlogs = Blog::where('published', true)->latest()->take(5)->get();

        foreach ($recentBlogs as $post) {
            $post['image'] = $post->featured_image ? asset('storage/' . $post->featured_image) : asset('images/default_blog_image.jpg');
            $post['date'] = $post->created_at->format('M d, Y');
            $post['link'] = route('blog.showBlogDetail', $post->slug);
        }

        $blog = Blog::where('slug', $slug)->where('published', true)->firstOrFail();

        if (!$blog) {
            abort(404);
        }

        $blog['image'] = $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('images/default_blog_image.jpg');
        
        return view('blog.show', compact('blog', 'recentBlogs'));
    }
}