@extends('admin.layout.app')

@section('title', 'Create Team')
@section('header', 'Create Team')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control" 
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" 
                       value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" 
                          class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="contact_email" 
                           class="form-control" value="{{ old('contact_email') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Phone</label>
                    <input type="text" name="contact_phone" 
                           class="form-control" value="{{ old('contact_phone') }}">
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    Save Team
                </button>
            </div>
        </form>
    </div>
</div>
@endsection