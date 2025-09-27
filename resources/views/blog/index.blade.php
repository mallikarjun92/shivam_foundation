@extends('layouts.app')

@section('title', 'Blog - Vishwam Foundation')

@section('content')
    
    <div class="hero-wrap" style="background-image: url('{{ asset('images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span> <span>Blog</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Blog</h1>
          </div>
        </div>
      </div>
    </div>

    
    <section class="ftco-section">
      <div class="container">
        <div class="row d-flex">
          @foreach($blogs as $blog)
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="{{ $blog['link'] }}" class="block-20" style="background-image: url('{{ asset($blog['image']) }}');">
              </a>
              <div class="text p-4 d-block">
                <div class="meta mb-3">
                  <div><a href="#">{{ $blog['date'] }}</a></div>
                  <div><a href="#">{{ $blog['author'] }}</a></div>
                  {{-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> {{ $blog['comments'] }}</a></div> --}}
                </div>
                <h3 class="heading mt-3"><a href="{{ $blog['link'] }}">{{ $blog['title'] }}</a></h3>
                <p>{{ $blog['excerpt'] }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        @if($blogs->hasPages())
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                {{-- Previous Page Link --}}
                @if($blogs->onFirstPage())
                  <li class="disabled"><span>&lt;</span></li>
                @else
                  <li><a href="{{ $blogs->previousPageUrl() }}">&lt;</a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach(range(1, $blogs->lastPage()) as $i)
                  @if($i == $blogs->currentPage())
                    <li class="active"><span>{{ $i }}</span></li>
                  @else
                    <li><a href="{{ $blogs->url($i) }}">{{ $i }}</a></li>
                  @endif
                @endforeach

                {{-- Next Page Link --}}
                @if($blogs->hasMorePages())
                  <li><a href="{{ $blogs->nextPageUrl() }}">&gt;</a></li>
                @else
                  <li class="disabled"><span>&gt;</span></li>
                @endif
              </ul>
            </div>
          </div>
        </div>
        @endif
      </div>
    </section>

@endsection