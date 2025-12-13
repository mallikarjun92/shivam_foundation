<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    //
    public function index()
    {
        $volunteers = \App\Models\Volunteer::where('active', true)
                    ->orderBy('first_name')
                    ->paginate(9); // 9 per page grid

        return view('volunteers.index', compact('volunteers'));
    }

    public function show($id)
    {
        $volunteer = \App\Models\Volunteer::findOrFail($id);

        return view('volunteers.show', compact('volunteer'));
    }
}
