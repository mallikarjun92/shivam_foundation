@extends('admin.layout.app')

@section('title', 'Impact Reports')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Reports</h5>
        <a href="{{ route('admin.impact-reports.create') }}" class="btn btn-primary">
            <i class="bi bi-upload"></i> Upload Report
        </a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Uploaded On</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                <tr>
                    <td>{{ $report->title }}</td>
                    <td>{{ $report->created_at->format('d M Y') }}</td>
                    <td>
                        <strong>{{ $report->title }}</strong>
                        @if($report->description)
                            <div class="text-muted small">
                                {{ Str::limit($report->description, 80) }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <a href="{{ $report->file_url }}" target="_blank"
                           class="btn btn-sm btn-secondary">
                            <i class="bi bi-file-earmark-pdf"></i> View
                        </a>

                        <a href="{{ route('admin.impact-reports.edit', $report) }}"
                           class="btn btn-sm btn-primary">
                            Edit
                        </a>

                        <form action="{{ route('admin.impact-reports.destroy', $report) }}"
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this report?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">No reports found.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $reports->links() }}
    </div>
</div>
@endsection