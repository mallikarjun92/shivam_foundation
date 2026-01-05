<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::latest()->paginate(10);
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'title'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
            'contact_email'  => 'nullable|email',
            'contact_phone'  => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('teams', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        Team::create($data);

        return redirect()->route('admin.teams.index')->with('success', 'Team created successfully');
    }

    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'title'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
            'contact_email'  => 'nullable|email',
            'contact_phone'  => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('image')) {
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }
            $data['image'] = $request->file('image')->store('teams', 'public');
        }

        $team->update($data);

        return redirect()->route('admin.teams.index')->with('success', 'Team updated successfully');
    }

    public function destroy(Team $team)
    {
        if ($team->image) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();

        return redirect()->route('admin.teams.index')->with('success', 'Team deleted successfully');
    }
}
