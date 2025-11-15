<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedDonor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FeaturedDonorController extends Controller
{
    //
    public function index()
    {
        $donors = FeaturedDonor::latest()->paginate(10);
        return view('admin.donors.index', compact('donors'));
    }

    public function create()
    {
        return view('admin.donors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'nullable|numeric',
            'donated_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('donors', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($request->name . '-' . uniqid());

        FeaturedDonor::create($validated);

        return redirect()->route('admin.donors.index')
            ->with('success', 'Featured Donor added successfully.');
    }

    public function edit(FeaturedDonor $donor)
    {
        return view('admin.donors.edit', compact('donor'));
    }

    public function update(Request $request, FeaturedDonor $donor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'nullable|numeric',
            'donated_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($donor->image) {
                Storage::disk('public')->delete($donor->image);
            }
            $validated['image'] = $request->file('image')->store('donors', 'public');
        }

        $validated['slug'] = Str::slug($request->name . '-' . uniqid());

        $donor->update($validated);

        return redirect()->route('admin.donors.index')
            ->with('success', 'Featured Donor updated successfully.');
    }

    public function destroy(FeaturedDonor $donor)
    {
        if ($donor->image) {
            Storage::disk('public')->delete($donor->image);
        }

        $donor->delete();

        return redirect()->route('admin.donors.index')
            ->with('success', 'Featured Donor deleted successfully.');
    }


    /** Frontend listing */
    // public function listDonors(Request $request)
    // {
    //     $donors = FeaturedDonor::where('published', true)->latest()->paginate(12);

    //     foreach ($donors as $donor) {
    //         $donor->image_url = $donor->image
    //             ? asset('storage/' . $donor->image)
    //             : asset('images/default_donor.jpg');
    //     }

    //     return view('donors.index', compact('donors'));
    // }


    /** Single donor detail */
    // public function show($slug)
    // {
    //     $donor = FeaturedDonor::where('slug', $slug)
    //                 ->where('published', true)
    //                 ->firstOrFail();

    //     $donor->image_url = $donor->image
    //         ? asset('storage/' . $donor->image)
    //         : asset('images/default_donor.jpg');

    //     return view('donors.show', compact('donor'));
    // }
}
