@extends('admin.layout.app')

@section('title', 'Add Hero Content')
@section('header', 'Add New Hero Content')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title *</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <textarea class="form-control @error('subtitle') is-invalid @enderror" 
                          id="subtitle" name="subtitle" rows="3">{{ old('subtitle') }}</textarea>
                @error('subtitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Hero Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Upload an image (JPEG, PNG, JPG, GIF, WEBP - max 2MB)</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="video" class="form-label">YouTube Video URL</label>
                        <input type="url" class="form-control @error('video') is-invalid @enderror" 
                               id="video" name="video" value="{{ old('video') }}" 
                               placeholder="https://www.youtube.com/watch?v=abc123 or https://youtu.be/abc123">
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Enter a YouTube URL (e.g., https://youtu.be/abc123)</div>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> You can use both image and YouTube video. The video will play as background with image as fallback.
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="button_text" class="form-label">Button Text</label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror" 
                               id="button_text" name="button_text" value="{{ old('button_text') }}">
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="button_link" class="form-label">Button Link</label>
                        <input type="url" class="form-control @error('button_link') is-invalid @enderror" 
                               id="button_link" name="button_link" value="{{ old('button_link') }}">
                        @error('button_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Display Order</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" 
                               id="order" name="order" value="{{ old('order', 0) }}">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror>
                        <div class="form-text">Lower numbers display first</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 form-check" style="padding-top: 2.5rem;">
                        <input type="checkbox" class="form-check-input" id="active" name="active" value="1" checked>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Hero Content</button>
            </div>
        </form>
    </div>
</div>
@endsection