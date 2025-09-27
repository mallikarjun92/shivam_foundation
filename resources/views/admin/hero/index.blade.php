@extends('admin.layout.app')

@section('title', 'Manage Hero Content')
@section('header', 'Hero Content Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hero Content</h5>
        <a href="{{ route('admin.hero.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Hero Content
        </a>
    </div>
    <div class="card-body">
        @if($heroContents->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-image" style="font-size: 3rem; color: #6c757d;"></i>
                <p class="mt-3">No hero content found.</p>
                <a href="{{ route('admin.hero.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle"></i> Add Your First Hero Content
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Media Type</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($heroContents as $hero)
                        <tr>
                            <td>
                                @if($hero->image)
                                    <img src="{{ $hero->image_url }}" alt="{{ $hero->title }}" 
                                         class="rounded" width="80" height="45" style="object-fit: cover;">
                                @elseif($hero->video)
                                    <i class="bi bi-play-btn-fill" style="font-size: 2rem;"></i>
                                @else
                                    <i class="bi bi-image" style="font-size: 2rem;"></i>
                                @endif
                            </td>
                            <td>{{ $hero->title }}</td>
                            <td>{{ Str::limit($hero->subtitle, 50) }}</td>
                            <td>
                                @if($hero->image)
                                    <span class="badge bg-info">Image</span>
                                @elseif($hero->video)
                                    <span class="badge bg-success">Video</span>
                                @else
                                    <span class="badge bg-secondary">None</span>
                                @endif
                            </td>
                            <td>{{ $hero->order }}</td>
                            <td>
                                <span class="badge {{ $hero->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $hero->active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.hero.show', $hero) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.hero.edit', $hero) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.hero.destroy', $hero) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Are you sure you want to delete this hero content?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $heroContents->links() }}
            </div>
        @endif
    </div>
</div>
@endsection