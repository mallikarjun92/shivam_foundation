@extends('layouts.app')

@section('title', 'Contact Us - Vishvam Foundation')

@push('head')
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script> --}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
    crossorigin="">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
    crossorigin=""></script>

@endpush

@section('content')
    
    <div class="hero-wrap" style="background-image: url('{{ asset('images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span> <span>Contact</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Contact Us</h1>
          </div>
        </div>
      </div>
    </div>

    
    <section class="ftco-section contact-section ftco-degree-bg">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h4">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3">
            <p><span>Address:</span> {{ $contactInfo['address'] }}</p>
          </div>
          <div class="col-md-3">
            <p><span>Phone:</span> <a href="tel:{{ $contactInfo['phone'] }}">{{ $contactInfo['phone'] }}</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Email:</span> <a href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Website:</span> <a href="/">{{ $contactInfo['website'] }}</a></p>
          </div>
        </div>
        
        <div class="row block-9">
          <div class="col-md-6 pr-md-5">
            <h4 class="mb-4">Do you have any questions?</h4>
            
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            
            <form action="{{ route('contact.store') }}" method="POST">
              @csrf
              @include('components.contact-form')
            </form>
          </div>

          <div class="col-md-6" id="map2">
            <div class="map-container" style="height: 100%; min-height: 400px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center;">
              <div class="map-placeholder text-center p-4">
                <i class="icon-map-marker" style="font-size: 3rem; color: #f8b739;"></i>
                <h4 class="mt-3">Our Location</h4>
                <p class="text-muted">{{ $contactInfo['address'] }}</p>
                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($contactInfo['address']) }}" 
                   target="_blank" class="btn btn-primary mt-2">
                  View on Google Maps
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

@push('scripts')
{{-- <script>
    // Simple map initialization (you can integrate Google Maps API here)
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Map container ready for Google Maps integration');
        // Add your Google Maps API integration code here
    });
</script> --}}
<script>

	const map = L.map('map2').setView([13.006, 76.101], 16);

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  // const tiles = L.tileLayer('http://a.tile3.opencyclemap.org/landscape/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a target="_blank" href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

	const marker = L.marker([13.006, 76.101]).addTo(map);
		// .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

	// const circle = L.circle([51.508, -0.11], {
	// 	color: 'red',
	// 	fillColor: '#f03',
	// 	fillOpacity: 0.5,
	// 	radius: 500
	// }).addTo(map).bindPopup('I am a circle.');

	// const polygon = L.polygon([
	// 	[51.509, -0.08],
	// 	[51.503, -0.06],
	// 	[51.51, -0.047]
	// ]).addTo(map).bindPopup('I am a polygon.');


	// const popup = L.popup()
	// 	.setLatLng([51.513, -0.09])
	// 	.setContent('I am a standalone popup.')
	// 	.openOn(map);

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent(`You clicked the map at ${e.latlng.toString()}`)
			.openOn(map);
	}

	map.on('click', onMapClick);

</script>

@endpush