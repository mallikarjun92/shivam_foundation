@extends('admin.layout.app')

@section('title', 'Upload Impact Report')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.impact-reports.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Report Title</label>
                <input type="text" name="title"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                        class="form-control"
                        rows="3"
                        placeholder="Brief summary of the report (optional)">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">PDF File</label>
                <input type="file" name="file"
                       class="form-control" accept="application/pdf" required>
            </div>

            <button class="btn btn-primary">Upload</button>
            <a href="{{ route('admin.impact-reports.index') }}"
               class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection