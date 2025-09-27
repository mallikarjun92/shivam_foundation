@extends('admin.layout.app')

@section('title', 'View Gallery Image')
@section('header', 'Gallery Image Details')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <p class="form-control-static">{{ $gallery->title }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <p class="form-control-static">{{ $gallery->description ?? 'N/A' }}</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <p class="form-control-static">{{ $gallery->category ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Display Order</label>
                            <p class="form-control-static">{{ $gallery->order }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <p class="form-control-static">
                        <span class="badge {{ $gallery->active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $gallery->active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Uploaded</label>
                    <p class="form-control-static">{{ $gallery->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Back to Gallery</a>
            <div>
                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                        onclick="return confirm('Are you sure you want to delete this image?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection