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
        $existingTags = Blog::pluck('tags')
            ->filter()
            ->flatMap(fn($tags) => explode(',', $tags))
            ->map(fn($tag) => trim($tag))
            ->unique()
            ->values();

        return view('admin.blogs.create', compact('existingTags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,avif,webp,*|max:2048',
            'published' => 'boolean',
            'tags' => 'nullable|string|max:255'
        ]);

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blogs', 'public');
            $validated['featured_image'] = $imagePath;
        }

        // Handle multiple images
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('blogs', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = $imagePaths;
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
        $existingTags = Blog::pluck('tags')
            ->filter()
            ->flatMap(fn($tags) => explode(',', $tags))
            ->map(fn($tag) => trim($tag))
            ->unique()
            ->values();

        return view('admin.blogs.edit', compact('blog', 'existingTags'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|mimes:jpeg,png,jpg,gif,avif,webp,*|max:2048',
            'published' => 'boolean',
            'tags' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('blogs', 'public');
            $validated['featured_image'] = $imagePath;
        }

        // 1. Handle deletion of selected old images
        $existingImages = $blog->images ?? [];
        $deleteImages = $request->delete_images ?? [];

        $keptImages = [];

        foreach ($existingImages as $index => $imgPath) {

            // If marked for deletion
            if (isset($deleteImages[$index]) && $deleteImages[$index] == "1") {
                Storage::disk('public')->delete($imgPath);
            } else {
                // keep image
                $keptImages[] = $imgPath;
            }
        }

        // Handle multiple images upload
        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('blogs', 'public');
                $keptImages[] = $path;
            }
        }

        // Finally set images JSON
        $validated['images'] = $keptImages;


        $validated['slug'] = Str::slug($request->title);
        $validated['published_at'] = $request->published ? now() : null;
        $validated['tags'] = $request->tags;

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

        if ($blog->images && is_array($blog->images)) {
            foreach ($blog->images as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }

    public function listBlogs(Request $request)
    {
        // Show 6 blogs per page
        $blogs = Blog::where('published', true)
                    ->latest()
                    ->paginate(6);

        // Transform for frontend
        $blogs->getCollection()->transform(function($post) {
            return [
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'image' => $post->featured_image 
                    ? asset('storage/' . $post->featured_image) 
                    : asset('images/default_blog_image.jpg'),
                'date' => $post->created_at->format('M d, Y'),
                'author' => $post->author ?? 'Admin',
                'slug' => $post->slug,
                'link' => route('blog.showBlogDetail', $post->slug),
            ];
        });

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

    public function uploadImage(Request $request)
    {
        // CKEditor usually sends the file in "upload"
        if ($request->hasFile('upload')) {
            $request->validate([
                'upload' => 'image|mimes:jpeg,png,jpg,gif,webp,avif|max:4096',
            ]);

            $file     = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store in storage/app/public/blogs/content
            $path = $file->storeAs('blogs/content', $filename, 'public');

            $url = asset('storage/' . $path); // public URL

            // Response format expected by CKEditor (ckfinder adapter)
            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url'      => $url,
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error'    => ['message' => 'No file uploaded.'],
        ], 400);
    }
}