@extends('admin.layout.app')

@section('title', 'Edit Impact Report')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.impact-reports.update', $impact_report) }}"
              enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Report Title</label>
                <input type="text" name="title"
                       class="form-control"
                       value="{{ $impact_report->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                        class="form-control"
                        rows="3">{{ old('description', $impact_report->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Replace PDF (optional)</label>
                <input type="file" name="file"
                       class="form-control" accept="application/pdf">
                <small class="text-muted">
                    Current file:
                    <a href="{{ $impact_report->file_url }}" target="_blank">View PDF</a>
                </small>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.impact-reports.index') }}"
               class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection