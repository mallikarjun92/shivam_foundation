@extends('admin.layout.app')

@section('title', 'Edit Blog')
@section('header', 'Edit Blog')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $blog->title) }}" required>
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
                    value="{{ old('tags', $blog->tags) }}"
                    placeholder="e.g. charity, donation, ngo">

                @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt (Brief Description)</label>
                <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                          id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>
                @error('excerpt')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="editor" name="content" rows="10">{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image</label>
                @if($blog->featured_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Featured Image" 
                             class="img-thumbnail" style="max-height: 200px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                       id="featured_image" name="featured_image" accept="image/*">
                @error('featured_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Existing Images</label>

                <div class="d-flex flex-wrap gap-3">

                    @if($blog->images)
                        @foreach($blog->images as $index => $img)
                            <div class="position-relative" style="display:inline-block;">
                                
                                <!-- Image -->
                                <img src="{{ asset('storage/' . $img) }}"
                                    style="width:120px;height:120px;border-radius:4px;object-fit:cover;"
                                    class="img-thumbnail">

                                <!-- Delete button -->
                                <button type="button"
                                    class="btn btn-sm btn-danger delete-existing-image"
                                    data-index="{{ $index }}"
                                    style="
                                        position:absolute;
                                        top:5px;
                                        right:5px;
                                        padding:2px 6px;
                                        font-size:12px;
                                    ">
                                    <i class="bi bi-x-lg"></i>
                                </button>

                                <!-- Hidden checkbox -->
                                <input type="hidden"
                                    name="delete_images[]"
                                    value=""
                                    id="delete-image-{{ $index }}">
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Images</label>

                <div id="edit-image-upload-wrapper">
                    <div class="input-group mb-2 image-row">
                        <input type="file" name="images[]" class="form-control" accept="image/*">
                        <button type="button" class="btn btn-danger remove-image-btn">X</button>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary mt-2" id="edit-add-image-btn">
                    + Add Another Image
                </button>

                <p class="text-muted small mt-2">
                    * Uploading new images will replace existing ones.
                </p>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="published" name="published" value="1" 
                       {{ old('published', $blog->published) ? 'checked' : '' }}>
                <label class="form-check-label" for="published">Publish this blog</label>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Blog</button>
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
// Add new upload field
document.getElementById('edit-add-image-btn').addEventListener('click', function () {
    const wrapper = document.getElementById('edit-image-upload-wrapper');

    const row = document.createElement('div');
    row.classList.add('input-group', 'mb-2', 'image-row');

    row.innerHTML = `
        <input type="file" name="images[]" class="form-control" accept="image/*">
        <button type="button" class="btn btn-danger remove-image-btn">X</button>
    `;

    wrapper.appendChild(row);
});

// Remove row
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-image-btn')) {
        e.target.parentElement.remove();
    }
});

document.addEventListener("click", function (e) {
    if (e.target.closest(".delete-existing-image")) {
        let btn = e.target.closest(".delete-existing-image");
        let index = btn.getAttribute("data-index");

        // mark the hidden input
        document.getElementById("delete-image-" + index).value = "1";

        // visually fade out image
        btn.parentElement.style.opacity = "0.4";
        btn.parentElement.style.border = "2px solid red";
    }
});

</script>
@endpush
