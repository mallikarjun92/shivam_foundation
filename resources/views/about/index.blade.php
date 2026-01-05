@extends('layouts.app')

@section('title', 'About Us - Vishwam Foundation')

@section('content')
    
    <div class="hero-wrap" style="background-image: url('{{ asset('images/home_bg_1.jpg') }}');filter: grayscale(100%);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
             <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span> <span>About</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">About Us</h1>
          </div>
        </div>
      </div>
    </div>

    
    <section class="ftco-section">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-6 d-flex ftco-animate">
    				<div class="img img-about align-self-stretch" style="background-image: url({{ asset($aboutData['image']) }}); width: 100%;"></div>
    			</div>
    			<div class="col-md-6 pl-md-5 ftco-animate">
    				<h2 class="mb-4">{{ $aboutData['title'] }}</h2>
    				@foreach($aboutData['description'] as $paragraph)
    				<p>{!! nl2br($paragraph) !!}</p>
    				@endforeach
    			</div>
    		</div>
    	</div>
    </section>

    @include('sections.vision', ['vision' => $aboutData['vision']])
    

    @include('sections.mission', ['mission' => $aboutData['mission']])
    
    {{-- @include('sections.counter') --}}

    <section class="ftco-section bg-light">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Our Team</h2>
            <p class="text-muted">Meet the dedicated individuals who make our mission possible</p>
          </div>
        </div>
        <div class="row">
        	@foreach($team as $member)
        	<div class="col-lg-4 col-md-6 d-flex mb-5 ftco-animate">
        		<div class="staff team-member w-100">
        			<div class="d-flex flex-column align-items-center">
        				<div class="team-img mb-4" style="background-image: url({{ asset($member['image']) }});">
                            {{-- <div class="team-overlay">
                                <div class="social-links">
                                    <a href="test.com" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                    <a href="test.com" class="social-link"><i class="fab fa-twitter"></i></a>
                                    <a href="test.com" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="test.com" class="social-link"><i class="fas fa-envelope"></i></a>
                                </div>
                            </div> --}}
                        </div>
        				<div class="info text-center">
        					<h3 class="mb-2">{{ $member['name'] }}</h3>
                            <span class="position text-primary font-weight-bold">{{ $member['title'] }}</span>
        					<p class="mt-3 mb-0 text-muted">{{ $member['subtitle'] }}</p>
                            {{-- <div class="text mt-3">
		        				<p>{{ $member['description'] ?? 'Dedicated team member making a difference in our community.' }}</p>
		        			</div> --}}
        				</div>
        			</div>
        		</div>
        	</div>
        	@endforeach
        </div>
      </div>
    </section>

    {{-- @include('sections.volunteer') --}}

    @include('sections.volunteers', ['volunteers' => $volunteers])

@endsection

@push('styles')
<style>
    /* Team Member Styles */
    .team-member {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        background: white;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }
    
    .team-member:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }
    
    .team-img {
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
        position: relative;
        margin: 0 auto;
        border: 5px solid #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .team-member:hover .team-img {
        transform: scale(1.05);
        border-color: #f86f2d;
    }
    
    .team-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(74, 137, 220, 0.9);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .team-member:hover .team-overlay {
        opacity: 1;
    }
    
    .social-links {
        display: flex;
        gap: 15px;
    }
    
    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        color: #f86f2d;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .social-link:hover {
        background: #f86f2d;
        color: white;
        transform: translateY(-3px);
    }
    
    /* .staff .info {
        padding: 25px;
    } */
    
    .staff .info h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }
    
    .staff .info .position {
        font-size: 1.1rem;
        font-weight: 600;
    }
    
    .staff .info .text {
        margin-top: 15px;
        color: #666;
        line-height: 1.6;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .team-img {
            width: 180px;
            height: 180px;
        }
        
        .staff .info {
            /* padding: 20px; */
        }
        
        .staff .info h3 {
            font-size: 1.3rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add subtle animation to team members
        const teamMembers = document.querySelectorAll('.team-member');
        
        teamMembers.forEach((member, index) => {
            // Add delay for staggered animation
            member.style.animationDelay = `${index * 0.1}s`;
            
            // Add hover effect
            member.addEventListener('mouseenter', function() {
                this.style.zIndex = '10';
            });
            
            member.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
            });
        });
    });
</script>
@endpush