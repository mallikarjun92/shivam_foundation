@extends('layouts.app')

@section('title', 'Yoga Classes - Vishwam Foundation')

@section('content')

    <!-- HERO SECTION -->
    <div class="hero-wrap" style="background-image: url('{{ asset('images/yoga/yoga_bg.jpg') }}'); filter: grayscale(100%);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                 <span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
                 <span class="mr-2"><a href="{{ url('/programs') }}">Programs</a></span>  
                 <span>Yoga Classes</span>
             </p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Yoga Program</h1>
          </div>
        </div>
      </div>
    </div>


    <!-- MAIN SECTION -->
    <section class="ftco-section">
    	<div class="container">
    		<div class="row d-flex">

          <!-- LEFT IMAGE -->
    			<div class="col-md-6 d-flex ftco-animate">
    				<div class="img img-about align-self-stretch" 
                 style="background-image: url('{{ asset('images/yoga/yoga_class.jpg') }}'); width: 100%;"></div>
    			</div>

          <!-- RIGHT CONTENT -->
    			<div class="col-md-6 pl-md-5 ftco-animate">
    				<h2 class="mb-4">Transform Your Mind & Body Through Yoga</h2>

            <p>Yoga is more than physical exercise—it is a holistic path that transforms your body, mind, and inner world. In a life filled with stress and distractions, yoga helps you reconnect with yourself, slow down, and live with awareness.</p>

            <p>Through breathing practices, meditation, and mindful postures, yoga cultivates mental clarity, emotional balance, and resilience. It builds physical strength while also teaching patience, focus, surrender, courage, and self-expression. Each pose becomes a life lesson.</p>

            <p>Yoga reduces stress by calming the nervous system, quieting mental noise, and releasing emotional tension. Over time, it changes how you see challenges, encouraging gratitude, discipline, and contentment.</p>

            <p>With consistent practice, yoga supports continuous growth—bringing clarity, vitality, inner peace, and a sense of purpose.</p>

            <p>Yoga doesn’t demand perfection; it simply invites you to begin. Choosing yoga is choosing transformation, balance, and a deeper connection to yourself.</p>

    			</div>
    		</div>
        
        <div class="form-group text-center mt-5 mb-0">
          <a href="#enroll-form" class="btn btn-primary py-3 px-5">Enroll Now</a>
        </div>

    	</div>
    </section>


    {{-- slider --}}
    @include('programs.gallery', ['gallery' => [
        'images/yoga/yoga_1.jpg',
        'images/yoga/yoga_2.jpg',
        'images/yoga/yoga_3.jpg',
        'images/yoga/yoga_4.jpg',
        'images/yoga/yoga_5.jpg',
        'images/yoga/yoga_6.jpg',
    ]])

    @include('programs.enroll-form', ['programType' => 'yoga'])

@endsection


@push('styles')
<style>
    .img-about {
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
</style>
@endpush
