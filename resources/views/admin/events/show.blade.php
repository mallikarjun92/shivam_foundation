@extends('admin.layout.app')

@section('title', 'View Event')
@section('header', 'Event Details')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ $event->image_url }}" alt="{{ $event->title }}" 
                         class="img-fluid rounded" style="max-height: 300px;">
                </div>
                
                <div class="mt-4">
                    <h5>Event Status</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Published:</span>
                        <span class="badge {{ $event->published ? 'bg-success' : 'bg-secondary' }}">
                            {{ $event->published ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Featured:</span>
                        <span class="badge {{ $event->featured ? 'bg-warning' : 'bg-secondary' }}">
                            {{ $event->featured ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Event Date:</span>
                        <span class="text-muted">{{ $event->formatted_date }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Event Time:</span>
                        <span class="text-muted">{{ $event->formatted_time }}</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <h3>{{ $event->title }}</h3>
                
                @if($event->excerpt)
                    <div class="alert alert-info">
                        {{ $event->excerpt }}
                    </div>
                @endif
                
                <div class="mb-4">
                    <h5>Description</h5>
                    <p>{{ $event->description }}</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5>Event Details</h5>
                        <div class="mb-2">
                            <strong>Location:</strong><br>
                            {{ $event->location }}
                        </div>
                        @if($event->organizer)
                        <div class="mb-2">
                            <strong>Organizer:</strong><br>
                            {{ $event->organizer }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <h5>Contact Information</h5>
                        @if($event->contact_email)
                        <div class="mb-2">
                            <strong>Email:</strong><br>
                            <a href="mailto:{{ $event->contact_email }}">{{ $event->contact_email }}</a>
                        </div>
                        @endif
                        @if($event->contact_phone)
                        <div class="mb-2">
                            <strong>Phone:</strong><br>
                            <a href="tel:{{ $event->contact_phone }}">{{ $event->contact_phone }}</a>
                        </div>
                        @endif
                        @if($event->website)
                        <div class="mb-2">
                            <strong>Website:</strong><br>
                            <a href="{{ $event->website }}" target="_blank">{{ $event->website }}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Back to Events</a>
            <div>
                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                        onclick="return confirm('Are you sure you want to delete this event?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection