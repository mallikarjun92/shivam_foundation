<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramsEnrollment;
use Illuminate\Http\Request;

class ProgramsEnrollmentController extends Controller
{
    /**
     * Display a listing of program enrollments.
     */
    public function index(Request $request)
    {
        $query = ProgramsEnrollment::query()->latest();

        // Filter by program type
        if ($request->program_type) {
            $query->where('program_type', $request->program_type);
        }

        // Filter by "new" or "read"
        if ($request->filter === 'new') {
            $query->where('is_new', true);
        } elseif ($request->filter === 'read') {
            $query->where('is_new', false);
        }

        $enrollments = $query->paginate(15)->appends($request->query());

        // Pass unique program types for filter UI
        $programTypes = ProgramsEnrollment::select('program_type')
                            ->distinct()
                            ->pluck('program_type');

        return view('admin.programs_enrollments.index', compact('enrollments', 'programTypes'));
    }

    /**
     * Display a single enrollment (marks as read).
     */
    public function show(ProgramsEnrollment $programs_enrollment)
    {
        // Mark as read
        if ($programs_enrollment->is_new) {
            $programs_enrollment->update(['is_new' => false]);
        }

        return view('admin.programs_enrollments.show', [
            'enrollment' => $programs_enrollment
        ]);
    }

    public function create()
    {
        return view('admin.programs_enrollments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'required|string|max:20',
            'dob'               => 'nullable|date',
            'country'           => 'nullable|string|max:100',
            'state'             => 'nullable|string|max:100',
            'gender'            => 'nullable|string|max:20',
            'payment_status'    => 'nullable|string|max:50',
            'payment_id'        => 'nullable|string|max:255',
            'payment_method'    => 'nullable|string|max:100',
            'payment_amount'    => 'nullable|numeric',
            'payment_currency'  => 'nullable|string|max:10',
            'remarks'           => 'nullable|string',
            'program_type'      => 'required|string|max:50',
        ]);

        // Newly created = unread
        $validated['is_new'] = true;

        ProgramsEnrollment::create($validated);

        return redirect()
            ->route('admin.programs-enrollments.index')
            ->with('success', 'Enrollment created successfully.');
    }

    /**
     * Show the form for editing an enrollment.
     */
    public function edit(ProgramsEnrollment $programs_enrollment)
    {
        return view('admin.programs_enrollments.edit', [
            'enrollment' => $programs_enrollment
        ]);
    }

    /**
     * Update the enrollment.
     */
    public function update(Request $request, ProgramsEnrollment $programs_enrollment)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'required|string|max:20',
            'dob'               => 'nullable|date',
            'country'           => 'nullable|string|max:100',
            'state'             => 'nullable|string|max:100',
            'gender'            => 'nullable|string|max:20',
            'payment_status'    => 'nullable|string|max:50',
            'payment_id'        => 'nullable|string|max:255',
            'payment_method'    => 'nullable|string|max:100',
            'payment_amount'    => 'nullable|numeric',
            'payment_currency'  => 'nullable|string|max:10',
            'remarks'           => 'nullable|string',
            'program_type'      => 'required|string|max:50',
        ]);

        $programs_enrollment->update($validated);

        return redirect()
                ->route('admin.programs-enrollments.index')
                ->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Delete an enrollment.
     */
    public function destroy(ProgramsEnrollment $programs_enrollment)
    {
        $programs_enrollment->delete();

        return redirect()
                ->route('admin.programs-enrollments.index')
                ->with('success', 'Enrollment deleted successfully.');
    }
}