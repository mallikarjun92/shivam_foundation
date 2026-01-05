@extends('layouts.app')

@section('title', 'Our Volunteers - Vishvam Foundation')

@section('content')

{{-- Hero Banner --}}
<div class="hero-wrap" style="background-image: url('{{ asset('images/home_bg_1.jpg') }}'); filter: grayscale(100%);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-8 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
                    <span>Volunteers</span>
                </p>
                <h1 class="mb-3 bread">Our Volunteers</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">

        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-8 heading-section ftco-animate text-center">
                <h2 class="mb-4">Meet Our Dedicated Volunteers</h2>
                <p class="text-muted">
                    These incredible individuals contribute their time, skills, and heart to help us make a difference.
                </p>
            </div>
        </div>

        <div class="row">
            @forelse($volunteers as $volunteer)

            <div class="col-lg-4 col-md-6 d-flex mb-5 ftco-animate">
                <a href="{{ route('volunteers.show', $volunteer->id) }}" class="w-100 text-decoration-none" style="color: inherit;">

                    <div class="staff team-member w-100">
                        <div class="d-flex flex-column align-items-center">

                            @php
                                $image = $volunteer->photo
                                    ? Storage::url($volunteer->photo)
                                    : asset('images/default_profile.png');
                            @endphp

                            <div class="team-img mb-4" style="background-image: url('{{ $image }}');"></div>

                            <div class="info text-center">
                                <h3 class="mb-2">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</h3>

                                @if($volunteer->skills)
                                <span class="position text-primary font-weight-bold">
                                    {{-- {{ implode(', ', array_slice(explode(',', $volunteer->skills), 0, 2)) }} --}}
                                    {{ Str::limit($volunteer->skills, 30) }}
                                </span>
                                @endif

                                {{-- @if($volunteer->interests)
                                <p class="mt-3 mb-0 text-muted">
                                    {{ Str::limit($volunteer->interests, 70) }}
                                </p>
                                @endif --}}
                                {{-- @if($volunteer->introduction)
                                <p class="mt-3 mb-0 text-muted">
                                    {!! Str::limit($volunteer->introduction, 70) !!}
                                </p>
                                @endif --}}
                            </div>

                        </div>
                    </div>

                </a>
            </div>

            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No volunteers found.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="row mt-4">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $volunteers->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</section>

@endsection

@push('styles')
<style>
    .team-member {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        background: white;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }
    .team-member:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    .team-img {
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
        margin: 0 auto;
        border: 5px solid #fff;
        transition: 0.3s;
    }
    .team-member:hover .team-img {
        transform: scale(1.05);
        border-color: #f86f2d;
    }
</style>
@endpush