@extends('layouts.app')

@section('title', 'CSR Partnership - Vishwam Foundation')

@section('content')

@push('styles')
    <style>
        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
@endpush

<!-- HERO SECTION -->
<div class="hero-wrap" style="background-image: url('{{ asset('images/home_bg_1.jpg') }}'); filter: grayscale(100%);" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
      <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
         <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
             <span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
             <span>CSR Partnership</span>
         </p>
        <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Partner With Us for CSR</h1>
      </div>
    </div>
  </div>
</div>


<!-- ABOUT CSR -->
<section class="ftco-section">
  <div class="container">
    <div class="row d-flex">
      
      <div class="col-md-6 d-flex ftco-animate">
        <div class="img img-about align-self-stretch" style="background-image: url('{{ asset('images/csr/csr_about.webp') }}'); width: 100%; border-radius: 10px;"></div>
      </div>

      <div class="col-md-6 pl-md-5 ftco-animate">
        <h2 class="mb-4">Corporate Social Responsibility (CSR) at Vishwam Foundation</h2>

        <p>
          CSR is not just a mandate—it is an opportunity for organizations to create real, measurable, and lasting social impact. At Vishwam Foundation, we collaborate with forward-thinking businesses to design meaningful CSR programs aligned with Schedule VII of the Companies Act, 2013.
        </p>

        <p>
          Our initiatives focus on areas including education, healthcare, skill development, environmental sustainability, nutrition, rural upliftment, and women empowerment. Each project is designed with transparency, measurable outcomes, and long-term community impact.
        </p>

        <p>
          We serve as a trusted implementation partner for companies looking to create sustainable change while fulfilling CSR compliance with robust reporting, documentation, and project monitoring.
        </p>
      </div>

    </div>
  </div>
</section>



<!-- IMPACT AREAS -->
<section class="ftco-section bg-light">
  <div class="container">
    
    <div class="row justify-content-center">
      <div class="col-md-7 heading-section ftco-animate text-center mb-5">
        <h2 class="mb-4">Our CSR Focus Areas</h2>
        <p class="text-muted">Aligned with Government CSR Schedule VII guidelines</p>
      </div>
    </div>

    <div class="row">
      
      <div class="col-md-4 ftco-animate mb-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <img src="{{ asset('images/causes/education_1.jpeg') }}" class="img-fluid mb-3 rounded" alt="">
          <h4>Education & Child Development</h4>
          <p>Scholarships, digital learning labs, early childhood learning & support for underprivileged students.</p>
        </div>
      </div>

      <div class="col-md-4 ftco-animate mb-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <img src="{{ asset('images/causes/wellbeing_1.jpg') }}" class="img-fluid mb-3 rounded" alt="">
          <h4>Healthcare & Wellness</h4>
          <p>Medical camps, disease prevention programs, nutrition drives, menstrual hygiene initiatives.</p>
        </div>
      </div>

      <div class="col-md-4 ftco-animate mb-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <img src="{{ asset('images/csr/environment.jpg') }}" class="img-fluid mb-3 rounded" alt="">
          <h4>Environment & Sustainability</h4>
          <p>Tree plantation, clean water programs, sanitation infrastructure, plastic-free campaigns.</p>
        </div>
      </div>

    </div>
  </div>
</section>



<!-- WHY PARTNER WITH US -->
<section class="ftco-section">
  <div class="container">

    <div class="row justify-content-center mb-5">
      <div class="col-md-7 heading-section ftco-animate text-center">
        <h2 class="mb-4">Why Partner With Vishwam Foundation?</h2>
      </div>
    </div>

    <div class="row">
      
      <div class="col-md-6 ftco-animate">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">✔ Registered NGO with full CSR Compliance</li>
          <li class="list-group-item">✔ Impact-driven, measurable outcomes</li>
          <li class="list-group-item">✔ Dedicated project execution team</li>
          <li class="list-group-item">✔ Transparency in fund utilization</li>
          <li class="list-group-item">✔ Detailed MIS, reports & documentation</li>
          <li class="list-group-item">✔ 100% legal & compliance adherence</li>
        </ul>
      </div>

      <div class="col-md-6 d-flex ftco-animate">
        <div class="img img-about align-self-stretch" style="background-image: url('{{ asset('images/csr/partner.avif') }}'); width: 100%; border-radius: 10px;"></div>
      </div>

    </div>

  </div>
</section>



<!-- CTA SECTION -->
<section class="ftco-section bg-primary">
  <div class="container text-center text-white">

    <h2 class="mb-3">Let’s Create Impact Together</h2>
    <p class="mb-4">Get in touch with our CSR partnership team for collaborations, proposals, or customized CSR projects.</p>

    <a href="{{ route('contact.index') }}" class="btn btn-light py-3 px-5">
      Contact CSR Team
    </a>

  </div>
</section>

@endsection
