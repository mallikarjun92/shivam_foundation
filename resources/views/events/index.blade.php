@extends('layouts.app')

@section('title', 'Events - Vishvam Foundation')

@section('content')

<div class="hero-wrap" style="background-image: url('{{ asset('images/bg_2.jpg') }}');">
  <div class="overlay"></div>
  <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-7 text-center">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                <span class="mr-2"><a href="{{ url('/') }}">Home</a></span> 
                <span class="mr-2">Events</span>
            </p>
            <h1 class="mb-3 bread">Events</h1>
          </div>
      </div>
  </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">

        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2 class="mb-4">Our Latest Events</h2>
            </div>
        </div>

        <div class="row">
            @foreach($events as $event)
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch w-100">
                    <a href="{{ $event['link'] }}" class="block-20" 
                        style="background-image: url('{{ $event['image'] }}');"></a>

                    <div class="text p-4 d-block">
                        <div class="meta mb-3">
                            <div><a href="#">{{ $event['date'] }}</a></div>
                            <div><a href="#">{{ $event['organizer'] }}</a></div>
                        </div>

                        <h3 class="heading mb-4">
                            <a href="{{ $event['link'] }}">{{ $event['title'] }}</a>
                        </h3>

                        <p class="time-loc">
                            <span class="mr-2">
                                <i class="icon-clock-o"></i> {{ $event['time'] }}
                            </span>
                            <span>
                                <i class="icon-map-o"></i> {{ $event['venue'] }}
                            </span>
                        </p>

                        {{-- <p>{{ $event['description'] }}</p> --}}
                        <p>{{ $event['excerpt'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($events->hasPages())
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              {{ $events->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
        @endif

    </div>
</section>

@endsection