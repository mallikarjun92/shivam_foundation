@extends('admin.layout.app')

@section('title', 'Edit Hero Content')
@section('header', 'Edit Hero Content')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.hero.update', $hero) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Title *</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $hero->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <textarea class="form-control @error('subtitle') is-invalid @enderror" 
                          id="subtitle" name="subtitle" rows="3">{{ old('subtitle', $hero->subtitle) }}</textarea>
                @error('subtitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Hero Image</label>
                        @if($hero->image)
                            <div class="mb-2">
                                <img src="{{ $hero->image_url }}" alt="Current Image" 
                                     class="img-thumbnail" style="max-height: 150px;">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                    <label class="form-check-label" for="remove_image">
                                        Remove current image
                                    </label>
                                </div>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Upload a new image (JPEG, PNG, JPG, GIF, WEBP - max 2MB)</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="video" class="form-label">YouTube Video URL</label>
                        <input type="url" class="form-control @error('video') is-invalid @enderror" 
                               id="video" name="video" value="{{ old('video', $hero->video) }}" 
                               placeholder="https://www.youtube.com/watch?v=abc123 or https://youtu.be/abc123">
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Enter a YouTube URL (e.g., https://youtu.be/abc123)</div>
                        
                        @if($hero->video)
                            <div class="mt-2">
                                <div class="alert alert-info">
                                    <i class="bi bi-youtube"></i> Current YouTube video: {{ $hero->video }}
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remove_video" name="remove_video" value="1">
                                    <label class="form-check-label" for="remove_video">
                                        Remove YouTube video
                                    </label>
                                </div>
                            </div>
                        @endif
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
                               id="button_text" name="button_text" value="{{ old('button_text', $hero->button_text) }}">
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="button_link" class="form-label">Button Link</label>
                        <input type="url" class="form-control @error('button_link') is-invalid @enderror" 
                               id="button_link" name="button_link" value="{{ old('button_link', $hero->button_link) }}">
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
                               id="order" name="order" value="{{ old('order', $hero->order) }}">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 form-check" style="padding-top: 2.5rem;">
                        <input type="checkbox" class="form-check-input" id="active" name="active" value="1" 
                            {{ old('active', $hero->active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Hero Content</button>
            </div>
        </form>
    </div>
</div>

@if($hero->video)
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">YouTube Video Preview</h5>
    </div>
    <div class="card-body">
        <div class="ratio ratio-16x9">
            <iframe src="{{ $hero->youtube_embed_url }}" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
            </iframe>
        </div>
        <div class="mt-2">
            <small class="text-muted">Preview of the embedded YouTube video</small>
        </div>
    </div>
</div>
@endif
@endsection