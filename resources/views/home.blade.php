@extends('layouts.app')

@section('title', 'Home - Vishvam Foundation')

@section('content')
    
    @include('sections.hero')
    @include('sections.counter')
    @include('sections.donations')
    @include('sections.blog', [
        'blogs' => $blogs, 
        'title' => 'Recent from blog', 
        'description' => 'Discover inspiring stories, helpful resources, and the latest updates on our mission to create positive change in the community.'
        ])
    @include('sections.blog', [
        'blogs' => $successBlogs, 
        'title' => 'Our Success Stories', 
        'description' => 'Discover the journeys of individuals and communities who overcame challenges and transformed their lives with our initiatives. Every success story reflects the power of compassion and collective effort.'
        ])
    @include('sections.services')
    @include('sections.gallery')
    @include('sections.causes')
    {{-- @include('sections.gallery') --}}
    @include('sections.events')
    @include('sections.volunteer')

@endsection