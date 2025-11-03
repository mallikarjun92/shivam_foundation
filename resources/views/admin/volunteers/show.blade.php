@extends('admin.layout.app')

@section('title', 'View Volunteer')
@section('header', 'Volunteer Details')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="{{ $volunteer->photo_url }}" alt="{{ $volunteer->full_name }}" 
                     class="img-fluid mb-3" style="max-width: 200px;">
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <p class="form-control-static">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <p class="form-control-static">{{ $volunteer->email }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <p class="form-control-static">{{ $volunteer->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <p class="form-control-static">
                                <span class="badge {{ $volunteer->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $volunteer->active ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Address</label>
            <p class="form-control-static">{{ $volunteer->address ?? 'N/A' }}</p>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">City</label>
                    <p class="form-control-static">{{ $volunteer->city ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">State</label>
                    <p class="form-control-static">{{ $volunteer->state ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Zip Code</label>
                    <p class="form-control-static">{{ $volunteer->zip_code ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Skills</label>
            <p class="form-control-static">{{ $volunteer->skills ?? 'N/A' }}</p>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Interests</label>
            <p class="form-control-static">{{ $volunteer->interests ?? 'N/A' }}</p>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Availability</label>
            <p class="form-control-static">{{ $volunteer->availability ?? 'N/A' }}</p>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Previous Experience</label>
            <p class="form-control-static">{{ $volunteer->previous_experience ?? 'N/A' }}</p>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.volunteers.index') }}" class="btn btn-secondary">Back to List</a>
            <div>
                <a href="{{ route('admin.volunteers.edit', $volunteer) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.volunteers.destroy', $volunteer) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                        onclick="return confirm('Are you sure you want to delete this volunteer?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection