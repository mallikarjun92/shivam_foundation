@extends('admin.layout.app')

@section('title', 'Manage Gallery')
@section('header', 'Gallery Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Gallery Images</h5>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Image
        </a>
    </div>
    <div class="card-body">
        @if($galleries->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-images" style="font-size: 3rem; color: #6c757d;"></i>
                <p class="mt-3">No gallery images found.</p>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle"></i> Add Your First Image
                </a>
            </div>
        @else
            <div class="row">
                @foreach($galleries as $gallery)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $gallery->image_url }}" class="card-img-top" alt="{{ $gallery->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($gallery->title, 30) }}</h5>
                            <p class="card-text">{{ Str::limit($gallery->description, 50) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge {{ $gallery->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $gallery->active ? 'Active' : 'Inactive' }}
                                </span>
                                @if($gallery->category)
                                    <span class="badge bg-info">{{ $gallery->category }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group w-100">
                                <a href="{{ route('admin.galleries.show', $gallery) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this image?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>
</div>
@endsection