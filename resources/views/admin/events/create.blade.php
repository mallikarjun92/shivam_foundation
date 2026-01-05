@extends('admin.layout.app')

@section('title', 'Add Event')
@section('header', 'Add New Event')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Event Title *</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="description" class="form-label">Event Description *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="5" >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Event Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Upload an image (JPEG, PNG, JPG, GIF, WEBP - max 2MB)</div>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="excerpt" class="form-label">Short Excerpt</label>
                <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                          id="excerpt" name="excerpt" rows="2">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Brief description for event listings (max 500 characters)</div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="event_date" class="form-label">Event Date & Time *</label>
                        <input type="datetime-local" class="form-control @error('event_date') is-invalid @enderror" 
                               id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                        @error('event_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="location" class="form-label">Location *</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                               id="location" name="location" value="{{ old('location') }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="organizer" class="form-label">Organizer</label>
                        <input type="text" class="form-control @error('organizer') is-invalid @enderror" 
                               id="organizer" name="organizer" value="{{ old('organizer') }}">
                        @error('organizer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="website" class="form-label">Website URL</label>
                        <input type="url" class="form-control @error('website') is-invalid @enderror" 
                               id="website" name="website" value="{{ old('website') }}">
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">Contact Email</label>
                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                               id="contact_email" name="contact_email" value="{{ old('contact_email') }}">
                        @error('contact_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contact_phone" class="form-label">Contact Phone</label>
                        <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" 
                               id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}">
                        @error('contact_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" 
                            {{ old('featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="featured">Feature this event</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="published" name="published" value="1" 
                            {{ old('published') ? 'checked' : '' }}>
                        <label class="form-check-label" for="published">Publish this event</label>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Event</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Simple character counter for excerpt
    document.getElementById('excerpt').addEventListener('input', function() {
        const charCount = this.value.length;
        const maxChars = 500;
        const counter = document.getElementById('excerpt-counter') || document.createElement('div');
        
        counter.id = 'excerpt-counter';
        counter.className = 'form-text';
        counter.textContent = `${charCount} / ${maxChars} characters`;
        
        if (!this.nextElementSibling || this.nextElementSibling.id !== 'excerpt-counter') {
            this.parentNode.appendChild(counter);
        }
        
        if (charCount > maxChars) {
            counter.style.color = 'red';
        } else {
            counter.style.color = '';
        }
    });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            ckfinder: {
                // Pass CSRF token in query so Laravel doesn’t block it
                uploadUrl: "{{ route('admin.blogs.upload-image') }}?_token={{ csrf_token() }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const editorData = ClassicEditor.instances
        ? ClassicEditor.instances.description.getData()
        : document.querySelector('#description').value;

    if (!editorData || editorData.trim() === '') {
        e.preventDefault();
        alert('Event description is required.');
    }
});
</script>
@endpush
@endsection