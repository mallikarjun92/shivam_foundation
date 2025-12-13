@extends('admin.layout.app')

@section('title', 'Manage Volunteers')
@section('header', 'Volunteer Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Volunteers</h5>
        <a href="{{ route('admin.volunteers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Volunteer
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Skills</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($volunteers as $volunteer)
                    <tr>
                        <td>
                            <img src="{{ $volunteer->photo_url }}" alt="{{ $volunteer->full_name }}" 
                                 class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                        </td>
                        <td>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</td>
                        <td>{{ $volunteer->email }}</td>
                        <td>{{ $volunteer->phone ?? 'N/A' }}</td>
                        <td>
                            @if($volunteer->skills)
                                {{ Str::limit($volunteer->skills, 30) }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $volunteer->active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $volunteer->active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.volunteers.show', $volunteer) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('admin.volunteers.edit', $volunteer) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.volunteers.destroy', $volunteer) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this volunteer?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No volunteers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $volunteers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection