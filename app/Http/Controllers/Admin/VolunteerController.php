<?php
// app/Http\Controllers/Admin/VolunteerController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::latest()->paginate(10);
        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function create()
    {
        return view('admin.volunteers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'skills' => 'nullable|string',
            'interests' => 'nullable|string',
            'availability' => 'nullable|string|max:255',
            'previous_experience' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Photo validation
            'active' => 'boolean'
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('volunteers', 'public');
            $validated['photo'] = $photoPath;
        }

        if(isset($validated['active'])) {
            $validated['active'] = $request->input('active') ? true : false;
        } else {
            $validated['active'] = false;
        }

        Volunteer::create($validated);

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer created successfully.');
    }

    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function edit(Volunteer $volunteer)
    {
        return view('admin.volunteers.edit', compact('volunteer'));
    }

    public function update(Request $request, Volunteer $volunteer)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email,' . $volunteer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'skills' => 'nullable|string',
            'interests' => 'nullable|string',
            'availability' => 'nullable|string|max:255',
            'previous_experience' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Photo validation
            'active' => 'boolean'
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($volunteer->photo) {
                Storage::disk('public')->delete($volunteer->photo);
            }
            
            $photoPath = $request->file('photo')->store('volunteers', 'public');
            $validated['photo'] = $photoPath;
        }

        if(isset($validated['active'])) {
            $validated['active'] = $request->input('active') ? true : false;
        } else {
            $validated['active'] = false;
        }

        $volunteer->update($validated);

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer updated successfully.');
    }

    public function destroy(Volunteer $volunteer)
    {
        // Delete photo if exists
        if ($volunteer->photo) {
            Storage::disk('public')->delete($volunteer->photo);
        }

        $volunteer->delete();

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer deleted successfully.');
    }
}