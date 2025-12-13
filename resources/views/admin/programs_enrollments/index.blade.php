@extends('admin.layout.app')

@section('title', 'Program Enrollments')
@section('header', 'Programs Enrollment Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Program Enrollments</h5>

        <div class="d-flex align-items-center gap-2">

            {{-- FILTER BY NEW / READ --}}
            <div class="btn-group me-2">
                <a href="{{ route('admin.programs-enrollments.index') }}"
                   class="btn btn-outline-secondary {{ request('filter')==null ? 'active' : '' }}">
                    All
                </a>
                <a href="{{ route('admin.programs-enrollments.index', ['filter' => 'new']) }}"
                   class="btn btn-outline-success {{ request('filter')=='new' ? 'active' : '' }}">
                    New
                    @php
                        $newCount = \App\Models\ProgramsEnrollment::where('is_new', true)->count();
                    @endphp
                    @if($newCount > 0)
                        <span class="badge bg-success ms-1">{{ $newCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.programs-enrollments.index', ['filter' => 'read']) }}"
                   class="btn btn-outline-secondary {{ request('filter')=='read' ? 'active' : '' }}">
                    Read
                </a>
            </div>

            {{-- PROGRAM TYPE FILTER --}}
            <form action="{{ route('admin.programs-enrollments.index') }}" method="GET" class="d-flex align-items-center">

                <select name="program_type" class="form-select me-2" style="min-width: 180px;">
                    <option value="">All Programs</option>
                    @foreach($programTypes as $ptype)
                        <option value="{{ $ptype }}"
                            {{ request('program_type') == $ptype ? 'selected' : '' }}>
                            {{ ucfirst($ptype) }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-primary d-flex align-items-center">
                    <span class="d-flex"><i class="bi bi-funnel"></i><span> Filter</span></span>
                </button>
            </form>

            <a href="{{ route('admin.programs-enrollments.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> New Enrollment
            </a>

        </div>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Program</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Enrolled At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $enrollment)
                    <tr class="{{ $enrollment->is_new ? 'table-success' : '' }}">
                        {{-- NAME --}}
                        <td class="{{ $enrollment->is_new ? 'fw-bold' : '' }}">
                            @if($enrollment->is_new)
                                <span class="text-success me-1" style="font-size: 14px;">●</span>
                                <strong>
                                    {{ $enrollment->name }}
                                </strong>
                            @else
                                <span class="text-muted me-1" style="font-size: 14px;">○</span>
                                {{ $enrollment->name }}
                            @endif
                        </td>
                        {{-- PROGRAM TYPE --}}
                        <td>
                            <span class="badge bg-info text-dark text-uppercase">
                                {{ $enrollment->program_type }}
                            </span>
                        </td>
                        {{-- EMAIL, PHONE, DOB, ENROLLED AT --}}
                        <td>{{ $enrollment->email }}</td>
                        <td>{{ $enrollment->phone }}</td>
                        <td>{{ $enrollment->dob?->format('M d, Y') ?? '-' }}</td>
                        <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                        {{-- ACTION BUTTONS --}}
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.programs-enrollments.show', $enrollment) }}"
                                   class="btn btn-sm btn-secondary">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('admin.programs-enrollments.edit', $enrollment) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.programs-enrollments.destroy', $enrollment) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-people" style="font-size: 2rem;"></i>
                            <p>No enrollments found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $enrollments->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection