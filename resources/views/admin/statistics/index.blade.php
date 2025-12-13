@extends('admin.layout.app')

@section('title', 'Statistics Dashboard')
@section('header', 'Website Statistics')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Current Statistics</h5>

        @if($stat)
            <a href="{{ route('admin.statistics.edit', $stat) }}" class="btn btn-primary">Edit Statistics</a>
        @else
            <a href="{{ route('admin.statistics.create') }}" class="btn btn-success">Add Statistics</a>
        @endif
    </div>

    <div class="card-body">
        @if($stat)
            <ul class="list-group">
                <li class="list-group-item"><strong>Children Served:</strong> {{ $stat->children_served }}</li>
                <li class="list-group-item"><strong>Volunteers:</strong> {{ $stat->volunteers }}</li>
                <li class="list-group-item"><strong>Meals Distributed:</strong> {{ $stat->meals_distributed }}</li>
                <li class="list-group-item"><strong>Countries Active:</strong> {{ $stat->countries_active }}</li>
                <li class="list-group-item">
                    <strong>Country List:</strong> 
                    {{ implode(', ', $stat->country_list ?? []) }}
                </li>
            </ul>
        @else
            <p class="text-center mt-4">No statistics available.</p>
        @endif
    </div>
</div>
@endsection
