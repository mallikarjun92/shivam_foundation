<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.layout.app')

@section('title', 'Dashboard - Admin Panel')
@section('header', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-stats text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="icon">
                            <i class="bi bi-journal-text" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="col">
                        <div class="numbers">
                            <p class="card-category mb-0 opacity-75">Total Blogs</p>
                            <h4 class="card-title mb-0">{{ $stats['blogs'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-stats text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="icon">
                            <i class="bi bi-calendar-event" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="col">
                        <div class="numbers">
                            <p class="card-category mb-0 opacity-75">Total Events</p>
                            <h4 class="card-title mb-0">{{ $stats['events'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-stats text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="icon">
                            <i class="bi bi-people" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="col">
                        <div class="numbers">
                            <p class="card-category mb-0 opacity-75">Total Volunteers</p>
                            <h4 class="card-title mb-0">{{ $stats['volunteers'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card card-stats text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="icon">
                            <i class="bi bi-heart" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="col">
                        <div class="numbers">
                            <p class="card-category mb-0 opacity-75">Total Causes</p>
                            <h4 class="card-title mb-0">{{ $stats['causes'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Activities -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Activities</h5>
            </div>
            <div class="card-body">
                @if(isset($recentActivities) && count($recentActivities) > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentActivities as $activity)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $activity->title ?? $activity->name }}</h6>
                                    <p class="mb-1 text-muted">{{ $activity->type }}</p>
                                    <small class="text-muted">{{ $activity->updated_at->diffForHumans() }}</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{ ucfirst($activity->status ?? 'active') }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No recent activities found.</p>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle"></i> Add New Blog
                    </a>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-outline-success">
                        <i class="bi bi-plus-circle"></i> Add New Event
                    </a>
                    <a href="{{ route('admin.volunteers.create') }}" class="btn btn-outline-info">
                        <i class="bi bi-plus-circle"></i> Add New Volunteer
                    </a>
                    {{-- <a href="{{ route('admin.causes.create') }}" class="btn btn-outline-warning">
                        <i class="bi bi-plus-circle"></i> Add New Cause
                    </a> --}}
                    <a href="{{ route('admin.galleries.create') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-plus-circle"></i> Upload Images
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection