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

{{-- <section class="ftco-section">
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
        <h2 class="mb-4">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</h2> --}}

        {{-- <p><strong>Email:</strong> {{ $volunteer->email }}</p>
        <p><strong>Phone:</strong> {{ $volunteer->phone }}</p>
        <p><strong>City:</strong> {{ $volunteer->city }}</p>
        <p><strong>State:</strong> {{ $volunteer->state }}</p> --}}

        {{-- @if($volunteer->introduction)
        <p><strong>Introduction:</strong> {!! $volunteer->introduction !!}</p>
        @endif

        @if($volunteer->skills)
        <p><strong>Skills:</strong> {{ $volunteer->skills }}</p>
        @endif

        @if($volunteer->interests)
        <p><strong>Interests:</strong> {{ $volunteer->interests }}</p>
        @endif --}}

        {{-- @if($volunteer->previous_experience)
        <p><strong>Previous Experience:</strong> {{ $volunteer->previous_experience }}</p>
        @endif --}}

        {{-- @if($volunteer->availability)
        <p><strong>Availability:</strong> {{ $volunteer->availability }}</p>
        @endif --}}

      {{-- </div>
    </div>

  </div>
</section> --}}

<section class="ftco-section bg-light">
  <div class="container">

    <div class="row justify-content-center mb-5">
      <div class="col-md-10 text-center">
        <h2 class="mb-3">Meet Our Volunteer</h2>
        <p class="text-muted">The people who make Vishvam Foundation possible</p>
      </div>
    </div>

    <div class="row align-items-start">
      {{-- Profile Card --}}
      <div class="col-md-4 ftco-animate">
        @php
            $image = $volunteer->photo
                ? Storage::url($volunteer->photo)
                : asset('images/default_profile.png');
        @endphp

        <div class="bg-white shadow rounded p-4 text-center" style="border-radius: 15px !important;">
          {{-- <div class="mb-4"
               style="
                background-image: url('{{ $image }}');
                width: 180px;
                height: 180px;
                margin: auto;
                border-radius: 50%;
                background-size: cover;
                background-position: center;
               ">
          </div> --}}
          <img src="{{ $image }}" alt="" style="width: 100%; height: auto; border-radius: 15px;">

          <h4 class="mb-1 mt-2">
            {{ $volunteer->first_name }} {{ $volunteer->last_name }}
          </h4>

          @if($volunteer->occupation)
            <p class="text-muted mb-2">{{ $volunteer->occupation }}</p>
          @endif

          @if($volunteer->city || $volunteer->country)
            <p class="small text-muted">
              <i class="icon-map-marker"></i>
              {{ $volunteer->city }}{{ $volunteer->city && $volunteer->country ? ', ' : '' }}{{ $volunteer->country }}
            </p>
          @endif
        </div>
      </div>

      {{-- Q & A Section --}}
      <div class="col-md-8 pl-md-5 ftco-animate">
        <div class="bg-white shadow rounded p-4" style="border-radius: 15px !important;">

          {{-- Q1 --}}
          <div class="mb-4">
            <h5 class="text-primary">Who is {{ $volunteer->first_name }}?</h5>
            <p>
              {!! nl2br($volunteer->introduction) 
                ?? 'A passionate volunteer contributing time and skills to support Vishvam Foundation’s mission.' !!}
            </p>
          </div>

          @if($volunteer->occupation)
          <div class="mb-4">
            <h5 class="text-primary">What do they do for living?</h5>
            <p>{{ $volunteer->occupation }}</p>
          </div>
          @endif

          {{-- Q2 --}}
          @if($volunteer->skills)
          <div class="mb-4">
            <h5 class="text-primary">What skills do they bring?</h5>
            <p>{{ $volunteer->skills }}</p>
          </div>
          @endif

          {{-- Q3 --}}
          @if($volunteer->interests)
          <div class="mb-4">
            <h5 class="text-primary">What are their interests?</h5>
            <p>{{ $volunteer->interests }}</p>
          </div>
          @endif

          {{-- Q4 --}}
          @if($volunteer->testimonial)
          <div class="mb-4">
              <h5 class="text-primary mb-3">Why Vishvam Foundation?</h5>

              {{-- <blockquote class="testimonial-box p-4 bg-light rounded position-relative"> --}}

                  {{-- Testimonial Content --}}
                  <div class="testimonial-content">
                      {!! nl2br($volunteer->testimonial) !!}
                  </div>

                  {{-- Closing Quote --}}
                  {{-- <div class="quote-end">”</div> --}}

              {{-- </blockquote> --}}
          </div>
          @endif

          {{-- Optional --}}
          @if($volunteer->previous_experience)
          <div class="mb-2">
            <h5 class="text-primary">Previous Experience</h5>
            <p>{{ $volunteer->previous_experience }}</p>
          </div>
          @endif

        </div>
      </div>
    </div>

  </div>
</section>

@endsection