@extends('admin.layout.app')

@section('title', 'Manage Events')
@section('header', 'Events Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Events</h5>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Event
        </a>
    </div>
    <div class="card-body">
        @if($events->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-calendar-event" style="font-size: 3rem; color: #6c757d;"></i>
                <p class="mt-3">No events found.</p>
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle"></i> Create Your First Event
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Date & Time</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>
                                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" 
                                     class="rounded" width="60" height="40" style="object-fit: cover;">
                            </td>
                            <td>{{ $event->title }}</td>
                            <td>
                                <div>{{ $event->formatted_date }}</div>
                                <small class="text-muted">{{ $event->formatted_time }}</small>
                            </td>
                            <td>{{ Str::limit($event->location, 20) }}</td>
                            <td>
                                <span class="badge {{ $event->published ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $event->published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $event->featured ? 'bg-warning' : 'bg-secondary' }}">
                                    {{ $event->featured ? 'Featured' : 'Regular' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.events.show', $event) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Are you sure you want to delete this event?')">
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
                {{ $events->links() }}
            </div>
        @endif
    </div>
</div>
@endsection