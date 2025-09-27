@extends('layouts.app')

@section('title', 'Home - Vishvam Foundation')

@section('content')
    
    @include('sections.hero')
    @include('sections.counter')
    @include('sections.services')
    @include('sections.gallery')
    @include('sections.causes')
    @include('sections.donations')
    {{-- @include('sections.gallery') --}}
    @include('sections.blog')
    @include('sections.events')
    @include('sections.volunteer')

@endsection