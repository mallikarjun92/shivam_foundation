<?php
// app/Http/Controllers/GalleryController.php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Get all active gallery items, ordered by display order
        $galleries = Gallery::where('active', true)
                            ->orderBy('order')
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        // Group by category if needed
        // $categories = $galleries->groupBy('category');
        
        // return view('gallery.index', compact('galleries', 'categories'));
        return view('gallery.index', compact('galleries'));
    }
}