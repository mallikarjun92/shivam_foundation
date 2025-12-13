@extends('admin.layout.app')

@section('title', 'Create Blog')
@section('header', 'Create New Blog')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags (comma-separated)</label>

                <!-- Suggested tags -->
                @if(count($existingTags) > 0)
                    <p class="small mb-1">Suggestions:</p>
                    <div class="mb-2">
                        @foreach($existingTags as $tag)
                            <span 
                                class="badge bg-secondary me-1 mb-1" 
                                style="cursor:pointer"
                                onclick="addTag('{{ $tag }}')">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <input type="text" 
                    class="form-control @error('tags') is-invalid @enderror"
                    id="tags" 
                    name="tags" 
                    value="{{ old('tags') }}"
                    placeholder="e.g. charity, donation, ngo">

                @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            
            <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt (Brief Description)</label>
                <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                          id="excerpt" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="editor" name="content" rows="10">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image</label>
                <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                       id="featured_image" name="featured_image" accept="image/*">
                @error('featured_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Images</label>

                <div id="image-upload-wrapper">

                    <!-- Default one upload button -->
                    <div class="input-group mb-2 image-row">
                        <input type="file" name="images[]" class="form-control" accept="image/*">
                        <button type="button" class="btn btn-danger remove-image-btn">X</button>
                    </div>

                </div>

                <button type="button" class="btn btn-secondary mt-2" id="add-image-btn">
                    + Add Another Image
                </button>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control @error('author') is-invalid @enderror" 
                       id="author" name="author" value="{{ old('author') }}" required>
                @error('author')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="published" name="published" value="1" 
                       {{ old('published') ? 'checked' : '' }}>
                <label class="form-check-label" for="published">Publish this blog</label>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Blog</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function addTag(tag) {
        let tagsInput = document.getElementById('tags');
        let existing = tagsInput.value ? tagsInput.value.split(',') : [];

        // Trim existing tags
        existing = existing.map(t => t.trim()).filter(t => t.length > 0);

        // Add only if not already present
        if (!existing.includes(tag)) {
            existing.push(tag);
        }

        tagsInput.value = existing.join(', ');
    }
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                // Pass CSRF token in query so Laravel doesn’t block it
                uploadUrl: "{{ route('admin.blogs.upload-image') }}?_token={{ csrf_token() }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush

@push('scripts')
<script>
document.getElementById('add-image-btn').addEventListener('click', function () {
    const wrapper = document.getElementById('image-upload-wrapper');

    const row = document.createElement('div');
    row.classList.add('input-group', 'mb-2', 'image-row');

    row.innerHTML = `
        <input type="file" name="images[]" class="form-control" accept="image/*">
        <button type="button" class="btn btn-danger remove-image-btn">X</button>
    `;

    wrapper.appendChild(row);
});

// Remove image input row
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-image-btn')) {
        e.target.parentElement.remove();
    }
});
</script>
@endpush