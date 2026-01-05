@extends('admin.layout.app')

@section('title', 'Manage Teams')
@section('header', 'Team Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Teams</h5>
        <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create New Team
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Contact</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teams as $team)
                        <tr>
                            <td>
                                @if($team->image)
                                    <img src="{{ asset('storage/'.$team->image) }}" 
                                         alt="{{ $team->name }}" 
                                         class="rounded-circle" width="40" height="40" 
                                         style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default_profile.png') }}" 
                                         alt="{{ $team->name }}" 
                                         class="rounded-circle" width="40" height="40" 
                                         style="object-fit: cover;">
                                @endif
                            </td>
                            <td>
                                <strong>{{ $team->name }}</strong>
                            </td>
                            <td>{{ $team->title ?? '-' }}</td>
                            <td>
                                <div>{{ $team->contact_email ?? '-' }}</div>
                                <small class="text-muted">{{ $team->contact_phone ?? '' }}</small>
                            </td>
                            <td>{{ $team->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.teams.edit', $team) }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.teams.destroy', $team) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this team?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No teams found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $teams->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection