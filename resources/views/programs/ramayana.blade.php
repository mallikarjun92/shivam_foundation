@extends('layouts.app')

@section('title', 'Ramayana Classes - Vishwam Foundation')

@section('content')

    <!-- HERO SECTION -->
    <div class="hero-wrap" 
         style="background-image: url('{{ asset('https://t3.ftcdn.net/jpg/11/94/85/58/360_F_1194855897_GRakeTxFKyHKey0SLq3WGYUbtdbxC2cC.jpg') }}'); filter: grayscale(100%);" 
         data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                 <span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
                 <span class="mr-2"><a href="{{ url('/programs') }}">Programs</a></span>  
                 <span>Ramayana Classes</span>
             </p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Ramayana Program</h1>
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
                 style="background-image: url('{{ asset('https://www.jkyog.org/blog/content/images/2025/04/RamKatha.webp') }}'); width: 100%;"></div>
    			</div>

          <!-- RIGHT CONTENT -->
    			<div class="col-md-6 pl-md-5 ftco-animate">
    				<h2 class="mb-4">Dive into the Timeless Wisdom of the Ramayana</h2>

            <p>
              The Ramayana is not just a scripture—it is a guiding light that teaches values, character, courage, responsibility, 
              compassion, and righteousness. Through our Ramayana classes, children and adults learn the life lessons embedded in 
              the journey of Lord Rama, Sita, Lakshmana, Hanuman, and other revered characters.
            </p>

            <p>
              Each session simplifies ancient teachings into stories, discussions, and interactive learning so that participants 
              not only understand the Ramayana but also apply its values in daily life.
            </p>

            <p>
              From understanding Dharma to learning about devotion, leadership, loyalty, and integrity—Ramayana classes provide 
              a foundation for strong moral character and purposeful living.
            </p>

            <p>
              These classes help nurture discipline, respect, emotional intelligence, and spiritual awareness, making them a 
              valuable addition for children, youth, and families seeking cultural and value-based learning.
            </p>

            <p>
              The Ramayana inspires us to walk the path of truth, humility, and service. Through these teachings, we hope to build 
              a brighter, kinder, and values-driven generation.
            </p>

    			</div>
    		</div>

    	</div>
    </section>


    {{-- IMAGE GALLERY --}}
    {{-- @include('programs.gallery', [
        'gallery' => [
            'images/ramayana/ramayana_1.jpg',
            'images/ramayana/ramayana_2.jpg',
            'images/ramayana/ramayana_3.jpg',
            'images/ramayana/ramayana_4.jpg',
            'images/ramayana/ramayana_5.jpg',
            'images/ramayana/ramayana_6.jpg',
        ]
    ]) --}}

    <!-- RAMAYANA THEMATIC SECTIONS -->
    <section class="ftco-section bg-light">
        <div class="container">

            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-8 text-center ftco-animate">
                    <h2 class="mb-4">What You Will Learn in the Ramayana Program</h2>
                    <p class="text-muted">
                        Our curriculum is designed to help students understand the values, stories, and life lessons of the Ramayana 
                        through simple storytelling, practical examples, and engaging activities.
                    </p>
                </div>
            </div>

            <!-- Block 1 -->
            <div class="row align-items-center mb-5">
                <div class="col-md-6 ftco-animate">
                    <img src="{{ asset('https://i0.wp.com/detechter.com/wp-content/uploads/2017/08/relationship-between-Hinduism-Sanatana-Dharma-and-Yoga-2.jpeg') }}" class="img-fluid rounded shadow" alt="Ramayana Values">
                </div>
                <div class="col-md-6 pl-md-5 ftco-animate">
                    <h3 class="mb-3">Core Values of Dharma</h3>
                    <p>
                        Students learn the essence of Dharma — truth, responsibility, compassion, courage, and integrity. 
                        Through the stories of Lord Rama, they understand how to make righteous decisions in daily life.
                    </p>
                </div>
            </div>

            <!-- Block 2 -->
            <div class="row align-items-center mb-5 flex-md-row-reverse">
                <div class="col-md-6 ftco-animate">
                    <img src="{{ asset('https://smarthistory.org/wp-content/uploads/2020/06/Full-page.jpg') }}" class="img-fluid rounded shadow" alt="Storytelling">
                </div>
                <div class="col-md-6 pr-md-5 ftco-animate">
                    <h3 class="mb-3">Interactive Storytelling</h3>
                    <p>
                        Each session brings characters like Sita, Hanuman, Lakshmana, and Bharata to life. 
                        Children learn through stories, discussions, illustrations, and fun activities that build curiosity and understanding.
                    </p>
                </div>
            </div>

            <!-- Block 3 -->
            <div class="row align-items-center mb-5">
                <div class="col-md-6 ftco-animate">
                    <img src="{{ asset('https://subkuz.com/uploads/news/2025/05/sub17479969064179.webp') }}" class="img-fluid rounded shadow" alt="Character Building">
                </div>
                <div class="col-md-6 pl-md-5 ftco-animate">
                    <h3 class="mb-3">Character & Leadership Building</h3>
                    <p>
                        The program helps children develop discipline, patience, humility, respect for elders, leadership qualities, 
                        and emotional intelligence — the true foundations of strong character.
                    </p>
                </div>
            </div>

            <!-- Block 4 -->
            <div class="row align-items-center mb-5 flex-md-row-reverse">
                <div class="col-md-6 ftco-animate">
                    <img src="{{ asset('https://rgyan-flutter200503-dev.s3.ap-south-1.amazonaws.com/public/pg-content/uploads/2019-03/ram-navmi.jpg') }}" class="img-fluid rounded shadow" alt="Bhakti & Devotion">
                </div>
                <div class="col-md-6 pr-md-5 ftco-animate">
                    <h3 class="mb-3">Bhakti & Devotion</h3>
                    <p>
                        Through the devotion of Hanuman, students learn the importance of dedication, loyalty, humility, and service. 
                        These teachings help build a deeper spiritual connection.
                    </p>
                </div>
            </div>

            <!-- Block 5 -->
            <div class="row align-items-center mb-5">
                <div class="col-md-6 ftco-animate">
                    <img src="{{ asset('https://cdn11.bigcommerce.com/s-x49po/images/stencil/1500x1500/products/28864/41545/IndianCulture_na_800_1630_9449X9449_0__63868.1519388909.jpg') }}" class="img-fluid rounded shadow" alt="Cultural Roots">
                </div>
                <div class="col-md-6 pl-md-5 ftco-animate">
                    <h3 class="mb-3">Connecting with Our Culture</h3>
                    <p>
                        The Ramayana program strengthens cultural identity by helping children appreciate Indian heritage, scriptures, 
                        values, and traditions in a way that feels modern, relatable, and joyful.
                    </p>
                </div>
            </div>

        </div>
    </section>

@endsection


@push('styles')
<style>
    .img-about {
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
</style>
@endpush