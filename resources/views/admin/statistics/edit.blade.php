@extends('admin.layout.app')

@section('title', 'Edit Statistics')
@section('header', 'Edit Website Statistics')

@section('content')
<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.statistics.update', $statistic) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.statistics.form', ['statistic' => $statistic])

            <button type="submit" class="btn btn-primary">Update Statistics</button>
        </form>

    </div>
</div>
@endsection
