@extends('layouts.app')

@section('title', $volunteer->first_name . ' ' . $volunteer->last_name . ' - Volunteer Profile')

@section('content')

<div class="hero-wrap" style="background-image: url('{{ asset('images/home_bg_1.jpg') }}');filter: grayscale(100%);" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-8 ftco-animate text-center">
        <p class="breadcrumbs">
          <span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
          <span class="mr-2"><a href="{{ route('volunteers.index') }}">Volunteers</a></span>
          <span>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</span>
        </p>
        <h1 class="mb-3 bread">Volunteer Profile</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section">
  <div class="container">

    <div class="row d-flex">
      <div class="col-md-4 d-flex ftco-animate">
        @php
            $image = $volunteer->photo
                ? Storage::url($volunteer->photo)
                : asset('images/default_profile.png');
        @endphp

        <div class="team-img" style="background-image: url('{{ $image }}'); width: 100%; height: 350px; border-radius: 15px; background-size: contain;"></div>
      </div>

      <div class="col-md-8 pl-md-5 ftco-animate">
        <h2 class="mb-4">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</h2>

        {{-- <p><strong>Email:</strong> {{ $volunteer->email }}</p>
        <p><strong>Phone:</strong> {{ $volunteer->phone }}</p>
        <p><strong>City:</strong> {{ $volunteer->city }}</p>
        <p><strong>State:</strong> {{ $volunteer->state }}</p> --}}

        @if($volunteer->introduction)
        <p><strong>Introduction:</strong> {{ $volunteer->introduction }}</p>
        @endif

        @if($volunteer->skills)
        <p><strong>Skills:</strong> {{ $volunteer->skills }}</p>
        @endif

        @if($volunteer->interests)
        <p><strong>Interests:</strong> {{ $volunteer->interests }}</p>
        @endif

        {{-- @if($volunteer->previous_experience)
        <p><strong>Previous Experience:</strong> {{ $volunteer->previous_experience }}</p>
        @endif --}}

        {{-- @if($volunteer->availability)
        <p><strong>Availability:</strong> {{ $volunteer->availability }}</p>
        @endif --}}

      </div>
    </div>

  </div>
</section>

@endsection