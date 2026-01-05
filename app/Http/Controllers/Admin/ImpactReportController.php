<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImpactReportController extends Controller
{
    public function index()
    {
        $reports = ImpactReport::latest()->paginate(10);
        return view('admin.impact_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.impact_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'  => 'required|mimes:pdf|max:5120', // 5MB
        ]);

        $path = $request->file('file')->store('impact-reports', 'public');

        ImpactReport::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $path,
        ]);

        return redirect()
            ->route('admin.impact-reports.index')
            ->with('success', 'Impact report uploaded successfully.');
    }

    public function edit(ImpactReport $impact_report)
    {
        return view('admin.impact_reports.edit', compact('impact_report'));
    }

    public function update(Request $request, ImpactReport $impact_report)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'  => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($impact_report->file_path);
            $impact_report->file_path = $request->file('file')
                ->store('impact-reports', 'public');
        }

        $impact_report->title = $validated['title'];
        $impact_report->description = $validated['description'];
        $impact_report->save();

        return redirect()
            ->route('admin.impact-reports.index')
            ->with('success', 'Impact report updated successfully.');
    }

    public function destroy(ImpactReport $impact_report)
    {
        Storage::disk('public')->delete($impact_report->file_path);
        $impact_report->delete();

        return redirect()
            ->route('admin.impact-reports.index')
            ->with('success', 'Impact report deleted successfully.');
    }
}