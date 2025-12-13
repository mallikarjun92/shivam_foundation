@extends('layouts.app')

@section('title', 'Our Programs - Vishwam Foundation')

@section('content')

    <!-- HERO SECTION -->
    <div class="hero-wrap" style="background-image: url('{{ asset('images/yoga/yoga_bg.jpg') }}'); filter: grayscale(100%);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                 <span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
                 <span>Programs</span>
             </p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Our Programs</h1>
          </div>
        </div>
      </div>
    </div>


    <!-- PROGRAM LIST -->
    <section class="ftco-section">
      <div class="container">

        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-8 heading-section ftco-animate text-center">
            <h2 class="mb-4">Explore Our Programs</h2>
            <p class="text-muted">Join our initiatives designed to uplift individuals and promote holistic wellbeing.</p>
          </div>
        </div>


        <!-- PROGRAM CARDS -->
        <div class="row">

          <!-- Yoga Program -->
          <div class="col-md-6 col-lg-4 ftco-animate mb-4">
            <div class="card program-card shadow-sm border-0">
              <div class="program-img" style="background-image: url('{{ asset('images/yoga/yoga_class.jpg') }}');"></div>
              <div class="card-body text-center">
                <h3 class="program-title">Yoga Program</h3>
                <p class="text-muted">A transformative journey to balance mind, body, and soul.</p>
                <a href="{{ route('programs.yoga') }}" class="btn btn-primary px-4 py-2">Learn More</a>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 ftco-animate mb-4">
              <div class="card program-card shadow-sm border-0">
                  <div class="program-img" style="background-image: url('{{ asset('https://smarthistory.org/wp-content/uploads/2020/06/Full-page.jpg') }}" class="img-fluid rounded shadow" alt="Storytelling') }}');"></div>
                  <div class="card-body text-center">
                      <h3 class="program-title">Ramayana Classes</h3>
                      <p class="text-muted">A value-based learning program inspired by the timeless teachings of Ramayana.</p>
                      <a href="{{ route('programs.ramayana') }}" class="btn btn-primary px-4 py-2">Learn More</a>
                  </div>
              </div>
          </div>

          <!-- Meditation Program (Placeholder for Future) -->
          <div class="col-md-6 col-lg-4 ftco-animate mb-4">
            <div class="card program-card shadow-sm border-0">
              <div class="program-img" style="background-image: url('{{ asset('images/programs/meditation-image.jpg') }}');"></div>
              <div class="card-body text-center">
                <h3 class="program-title">Meditation Program</h3>
                <p class="text-muted">Calm your mind and enhance inner clarity.</p>
                <a href="#" class="btn btn-outline-secondary px-4 py-2 disabled">Coming Soon</a>
              </div>
            </div>
          </div>

          <!-- Workshops Program (Placeholder) -->
          {{-- <div class="col-md-6 col-lg-4 ftco-animate mb-4">
            <div class="card program-card shadow-sm border-0">
              <div class="program-img" style="background-image: url('{{ asset('images/programs/workshop.jpg') }}');"></div>
              <div class="card-body text-center">
                <h3 class="program-title">Awareness Workshops</h3>
                <p class="text-muted">Interactive sessions for personal growth and community wellbeing.</p>
                <a href="#" class="btn btn-outline-secondary px-4 py-2 disabled">Coming Soon</a>
              </div>
            </div>
          </div> --}}

        </div>
      </div>
    </section>

@endsection


@push('styles')
<style>
    .program-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .program-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .program-img {
        height: 220px;
        background-size: cover;
        background-position: center;
    }

    .program-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #333;
    }
</style>
@endpush
