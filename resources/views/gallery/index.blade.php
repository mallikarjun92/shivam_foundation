@extends('layouts.app')

@section('title', 'Gallery - Vishvam Foundation')

@section('content')
    
    <div class="hero-wrap" style="background-image: url('{{ asset('images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span> <span>Gallery</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Our Gallery</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-gallery">
    	<div class="container">
    		@if($galleries->isEmpty())
    		    <div class="row justify-content-center">
    		        <div class="col-md-8 text-center py-5">
    		            <div class="alert alert-info">
    		                <h4>No Gallery Items Yet</h4>
    		                <p>Check back soon for updates to our gallery.</p>
    		            </div>
    		        </div>
    		    </div>
    		@else
                @php
                    $galleryChunks = $galleries->chunk(4);
                @endphp
                @foreach($galleryChunks as $chunk)
                <div class="d-md-flex">
    		        @foreach($chunk as $gallery)
    		            <a href="{{ $gallery->image_url }}" class="gallery image-popup d-flex justify-content-center align-items-center img ftco-animate" style="background-image: url({{ $gallery->image_url }});">
    		                <div class="icon d-flex justify-content-center align-items-center">
    		                    <span class="icon-search"></span>
    		                </div>
    		                {{-- @if($gallery->title)
    		                <div class="gallery-caption">
    		                    <h4>{{ $gallery->title }}</h4>
    		                    @if($gallery->description)
    		                    <p>{{ Str::limit($gallery->description, 50) }}</p>
    		                    @endif
    		                </div>
    		                @endif --}}
    		            </a>
    		        @endforeach
                </div>
                @endforeach
    		@endif
    	</div>
    </section>

    @include('sections.volunteer')

@endsection

@push('scripts')
{{-- <script>
$(document).ready(function() {
    // Initialize magnific popup for image gallery
    $('.image-popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        },
        image: {
            titleSrc: function(item) {
                return item.el.find('.gallery-caption h4').text() || 'Gallery Image';
            }
        }
    });
    
    // Category filter functionality
    $('[data-filter]').click(function() {
        var filter = $(this).data('filter');
        
        // Update active button
        $('[data-filter]').removeClass('active');
        $(this).addClass('active');
        
        // Show/hide items
        if (filter === 'all') {
            $('.gallery-item').show();
        } else {
            $('.gallery-item').hide();
            $('.gallery-item.' + filter).show();
        }
    });
});
</script> --}}
@endpush