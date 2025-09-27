@extends('admin.layout.app')

@section('title', 'View Hero Content')
@section('header', 'Hero Content Details')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                @if($hero->image)
                    <img src="{{ $hero->image_url }}" alt="{{ $hero->title }}" class="img-fluid rounded">
                @elseif($hero->video)
                    <div class="text-center py-5 bg-light rounded">
                        <i class="bi bi-play-btn-fill" style="font-size: 3rem;"></i>
                        <p class="mt-2">Video: {{ basename($hero->video) }}</p>
                    </div>
                @else
                    <div class="text-center py-5 bg-light rounded">
                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                        <p class="mt-2">No media uploaded</p>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <p class="form-control-static">{{ $hero->title }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <p class="form-control-static">{{ $hero->subtitle ?? 'N/A' }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Media Type</label>
                    <p class="form-control-static">
                        @if($hero->image)
                            <span class="badge bg-info">Image</span>
                        @elseif($hero->video)
                            <span class="badge bg-success">Video</span>
                        @else
                            <span class="badge bg-secondary">None</span>
                        @endif
                    </p>
                </div>
                
                @if($hero->button_text && $hero->button_link)
                <div class="mb-3">
                    <label class="form-label">Button</label>
                    <p class="form-control-static">
                        <a href="{{ $hero->button_link }}" target="_blank" class="btn btn-sm btn-primary">
                            {{ $hero->button_text }}
                        </a>
                    </p>
                </div>
                @endif
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Display Order</label>
                            <p class="form-control-static">{{ $hero->order }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <p class="form-control-static">
                                <span class="badge {{ $hero->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $hero->active ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Created</label>
                    <p class="form-control-static">{{ $hero->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">Back to List</a>
            <div>
                <a href="{{ route('admin.hero.edit', $hero) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.hero.destroy', $hero) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                        onclick="return confirm('Are you sure you want to delete this hero content?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection