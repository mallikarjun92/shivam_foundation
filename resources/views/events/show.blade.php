@extends('layouts.app')

@section('title', $event->title . ' - Vishwam Foundation')

@section('content')

    <!-- HERO SECTION -->
    <div class="hero-wrap" style="background-image: url('{{ $event->image ? asset('storage/' . $event->image) : asset('images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax="properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                 <span class="mr-2"><a href="{{ url('/') }}">Home</a></span> 
                 {{-- <span class="mr-2"><a href="#">Events</a></span>  --}}
                 <span>{{ Str::limit($event->title, 20) }}</span>
             </p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ $event->title }}</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- MAIN CONTENT -->
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          
          <!-- Left Content -->
          <div class="col-lg-8 ftco-animate">

            <h2 class="mb-3">{{ $event->title }}</h2>

            <!-- Event Image -->
            @if($event->image)
            <p>
              <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="img-fluid">
            </p>
            @endif

            <!-- Event Meta -->
            <div class="mb-4 p-3 bg-light rounded">
              <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
              <p><strong>Location:</strong> {{ $event->location }}</p>

              @if($event->organizer)
              <p><strong>Organizer:</strong> {{ $event->organizer }}</p>
              @endif

              @if($event->contact_email)
              <p><strong>Email:</strong> {{ $event->contact_email }}</p>
              @endif

              @if($event->contact_phone)
              <p><strong>Phone:</strong> {{ $event->contact_phone }}</p>
              @endif

              @if($event->website)
              <p><strong>Website:</strong> <a href="{{ $event->website }}" target="_blank">{{ $event->website }}</a></p>
              @endif
            </div>

            <!-- Event Description -->
            <div class="ftco-animate">
              {!! $event->description !!}
            </div>

          </div>

          <!-- Sidebar -->
          <div class="col-lg-4 sidebar ftco-animate">

            <!-- Recent Events -->
            <div class="sidebar-box ftco-animate">
              <h3 class="heading">Recent Events</h3>

              @php
                $recentEvents = \App\Models\Event::where('published', true)
                    ->latest()
                    ->take(5)
                    ->get();
              @endphp

              @foreach($recentEvents as $recent)
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" 
                   style="background-image: url({{ $recent->image ? asset('storage/'.$recent->image) : asset('images/default_event.jpg') }});">
                </a>
                <div class="text">
                  <h3 class="heading-1">
                    <a href="{{ route('events.show', $recent->slug) }}">{{ $recent->title }}</a>
                  </h3>
                  <div class="meta">
                    <div>
                      <span class="icon-calendar"></span> 
                      {{ \Carbon\Carbon::parse($recent->event_date)->format('M d, Y') }}
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div>

          </div><!-- END Sidebar -->

        </div>
      </div>
    </section>

@endsection
