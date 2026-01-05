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

    @include('partials.home-popups')

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Show only on homepage
    if (window.location.pathname !== '/') return;

    // Optional: show once per session
    // if (sessionStorage.getItem('homePopupsShown')) return;

    // Show Events popup after 3 seconds
    setTimeout(function () {
        $('#eventsModal').modal('show');
    }, 3000);

    // When Events modal closes → show Program modal
    $('#eventsModal').on('hidden.bs.modal', function () {
        setTimeout(function () {
            $('#programModal').modal('show');
        }, 3000);
    });

    // Mark as shown
    // $('#programModal').on('shown.bs.modal', function () {
    //     sessionStorage.setItem('homePopupsShown', 'true');
    // });

});
</script>
@endpush
@push('styles')
<style>
    .modal-content {
        border-radius: 12px;
    }

    /* .modal-header {
        background: #f96d00;
        color: #fff;
    } */

    .modal-header .close {
        /* color: #fff; */
        opacity: 1;
    }
</style>
@endpush
