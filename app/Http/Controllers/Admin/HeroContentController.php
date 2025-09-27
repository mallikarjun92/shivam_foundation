<?php
// app/Http\Controllers\Admin\HeroContentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HeroContentController extends Controller
{
    public function index()
    {
        $heroContents = HeroContent::ordered()->paginate(10);
        return view('admin.hero.index', compact('heroContents'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'video' => 'nullable|url|starts_with:https://www.youtube.com/,https://youtube.com/,https://youtu.be/',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            $this->ensureHeroDirectoryExists();

            $imagePath = $request->file('image')->store('hero', 'public');
            $validated['image'] = $imagePath;
        }

        HeroContent::create($validated);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero content created successfully.');
    }

    public function show(HeroContent $hero)
    {
        return view('admin.hero.show', compact('hero'));
    }

    public function edit(HeroContent $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, HeroContent $hero)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'video' => 'nullable|url|starts_with:https://www.youtube.com/,https://youtube.com/,https://youtu.be/',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'active' => 'boolean'
        ]);

        // dd($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $this->ensureHeroDirectoryExists();
            // Delete old image if exists
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            
            $imagePath = $request->file('image')->store('hero', 'public');
            $validated['image'] = $imagePath;
        } elseif ($request->has('remove_image')) {
            // Remove image if requested
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            $validated['image'] = null;
        }

        // dd($validated);

        // Handle video URL - if empty string, set to null
        if ($validated['video'] === '') {
            $validated['video'] = null;
        }

        $hero->update($validated);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero content updated successfully.');
    }

    public function destroy(HeroContent $hero)
    {
        // Delete image if exists
        if ($hero->image) {
            Storage::disk('public')->delete($hero->image);
        }

        $hero->delete();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero content deleted successfully.');
    }

    private function ensureHeroDirectoryExists()
    {
        $path = storage_path('app/public/hero');
        
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }
}