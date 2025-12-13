<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statistic;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stat = Statistic::first();

        return view('admin.statistics.index', compact('stat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statistics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'children_served' => 'required|integer|min:0',
            'volunteers' => 'required|integer|min:0',
            'meals_distributed' => 'required|integer|min:0',
            'countries_active' => 'required|integer|min:0',
            'country_list' => 'nullable|string',
        ]);

        $validated['country_list'] =
            $request->country_list ? array_map('trim', explode(',', $request->country_list)) : [];

        Statistic::create($validated);

        return redirect()
            ->route('admin.statistics.index')
            ->with('success', 'Statistics created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Statistic $statistic)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Statistic $statistic)
    {
        //
        return view('admin.statistics.edit', compact('statistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Statistic $statistic)
    {
        //
        $validated = $request->validate([
            'children_served' => 'required|integer|min:0',
            'volunteers' => 'required|integer|min:0',
            'meals_distributed' => 'required|integer|min:0',
            'countries_active' => 'required|integer|min:0',
            'country_list' => 'nullable|string',
        ]);

        $validated['country_list'] =
            $request->country_list ? array_map('trim', explode(',', $request->country_list)) : [];

        $statistic->update($validated);

        return redirect()
            ->route('admin.statistics.index')
            ->with('success', 'Statistics updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statistic $statistic)
    {
        //
        $statistic->delete();

        return back()->with('success', 'Statistics removed.');
    }
}
