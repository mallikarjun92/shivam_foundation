@extends('admin.layout.app')

@section('title', 'Manage Featured Donors')
@section('header', 'Featured Donors')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Featured Donors</h5>
        <a href="{{ route('admin.donors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Donor
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Donor</th>
                        <th>Amount</th>
                        <th>Donated At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($donors as $donor)
                    <tr>
                        <td>
                            <strong>{{ $donor->name }}</strong>
                        </td>

                        <td>
                            {{ $donor->amount ? '₹' . number_format($donor->amount, 2) : '-' }}
                        </td>

                        <td>{{ $donor->donated_at ? $donor->donated_at->format('M d, Y') : '-' }}</td>

                        <td>
                            <span class="badge {{ $donor->published ? 'bg-success' : 'bg-secondary' }}">
                                {{ $donor->published ? 'Published' : 'Draft' }}
                            </span>
                        </td>

                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.donors.edit', $donor) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('admin.donors.destroy', $donor) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this donor?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No donors found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $donors->links() }}
        </div>
    </div>
</div>
@endsection
