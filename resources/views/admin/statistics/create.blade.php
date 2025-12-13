@extends('admin.layout.app')

@section('title', 'Add Statistics')
@section('header', 'Add Website Statistics')

@section('content')
<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.statistics.store') }}" method="POST">
            @csrf

            @include('admin.statistics.form')

            <button type="submit" class="btn btn-primary">Save Statistics</button>
        </form>

    </div>
</div>
@endsection
