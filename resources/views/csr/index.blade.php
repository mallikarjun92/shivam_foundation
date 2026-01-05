@extends('layouts.app')

@section('title', 'CSR Partnership - Vishvam Foundation')

@push('styles')
<style>
    .csr-hero {
        background-size: cover;
        background-position: center;
        position: relative;
        height: 700px;
        padding-top: 150px;
        color: #fff !important;
    }

    .csr-hero h1 {
        color: #fff !important;
    }

    .csr-hero .overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
    }

    .csr-cta {
        /* background: linear-gradient(135deg, #0a3d62, #1e5799); */
        /* background: #252525; */
        /* background: #f8b739; */
        /* background: #3F7B7F; */
        background-color: #f37726a6;
        padding: 80px 0;
    }

    .csr-cta .form-control {
        background: transparent;
        /* color: #fff; */
        border: 1px solid rgba(255,255,255,0.5);
    }

    .csr-cta .form-control::placeholder {
        /* color: rgba(255,255,255,0.7); */
    }
</style>
@endpush

@section('content')

<!-- HERO SECTION -->
<section class="csr-hero" style="background-image:url('{{ asset('images/bg_1.jpg') }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row align-items-center min-vh-75">
            <div class="col-md-6 text-white ftco-animate">
                <h1 class="mb-3">
                    Corporate Social Responsibility (CSR)
                    <br>with Vishvam Foundation
                </h1>
                <p class="mb-4">
                    Partnering for impact,<br>
                    Empowering Communities,<br>
                    Building a Better Tomorrow.
                </p>
                <a href="#get-involved" class="btn btn-light px-4 py-3">
                    Partner With Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- WHO WE ARE -->
<section class="ftco-section">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6 ftco-animate">
                <h3 class="mb-3">Who We Are</h3>
                <p>
                    Vishvam Foundation is a nonprofit organization dedicated to education,
                    health empowerment, and sustainability. We believe compassion, equal
                    opportunity, and collective action uplift communities across India.
                </p>

                <div class="row mt-4">

                    <div class="col-md-6 mb-3">
                        <h6><i class="icon-graduation-cap text-primary"></i> Education</h6>
                        <small>Scholarships & digital literacy</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6><i class="icon-heart text-danger"></i> Health & Nutrition</h6>
                        <small>Meals & medical camps</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6><i class="icon-female text-warning"></i> Women Empowerment</h6>
                        <small>Skills & livelihoods</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6><i class="icon-leaf text-success"></i> Environment</h6>
                        <small>Sustainability programs</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 ftco-animate">
                <img src="{{ asset('images/csr/hero.png') }}" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- HOW CORPORATES CAN PARTNER -->
<section class="ftco-section bg-light">
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h3>How Corporates Can Partner</h3>
            </div>
        </div>

        <div class="row text-center">

            <div class="col-md-4 ftco-animate">
                <h2 class="text-primary">5,000+</h2>
                <p>Meals Served</p>
            </div>

            <div class="col-md-4 ftco-animate">
                <h2 class="text-primary">1,200+</h2>
                <p>Children Educated</p>
            </div>

            <div class="col-md-4 ftco-animate">
                <h2 class="text-primary">SDG</h2>
                <p>Global Alignment</p>
            </div>

        </div>

    </div>
</section>

<!-- MEASURING IMPACT -->
{{-- <section class="ftco-section">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-md-6 ftco-animate">
                <img src="{{ asset('images/csr/impact_story.jpg') }}" class="img-fluid rounded shadow">
            </div>

            <div class="col-md-6 ftco-animate">
                <h3 class="mb-3">Measuring Impact</h3>
                <blockquote class="blockquote">
                    “Volunteering with Vishvam Foundation has been life-changing.
                    I’ve witnessed the true power of education and empowerment.”
                </blockquote>
                <p class="font-weight-bold">— Amit Sharma</p>
            </div>

        </div>

    </div>
</section> --}}

<!-- IMPACT REPORTS -->
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h3>Impact Reports</h3>
                <p>Explore our detailed impact reports showcasing the outcomes of our CSR initiatives and partnerships.</p>
            </div>
        </div>

        <div class="row mb-5">

            @foreach($impactReports as $report)
            <div class="col-md-4 ftco-animate">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($report->title, 30) }}</h5>
                        <p class="card-text" style="height: 50px !important;">{{ Str::limit($report->description, 75) }}</p>
                        <p class="card-text">{{ $report->created_at->format('d M Y') }}</p>
                        <a href="{{ $report->file_url }}" target="_blank"
                           class="btn btn-primary">
                           View Report
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{-- pagination --}}
        @if($impactReports->hasPages())
        <div class="row mt-4 mb-4">
            <div class="col text-center">
                <div class="block-27">
                <ul>
                    {{-- Previous Page Link --}}
                    @if($impactReports->onFirstPage())
                    <li class="disabled"><span>&lt;</span></li>
                    @else
                    <li><a href="{{ $impactReports->previousPageUrl() }}">&lt;</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach(range(1, $impactReports->lastPage()) as $i)
                    @if($i == $impactReports->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $impactReports->url($i) }}">{{ $i }}</a></li>
                    @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($impactReports->hasMorePages())
                    <li><a href="{{ $impactReports->nextPageUrl() }}">&gt;</a></li>
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

<!-- GET INVOLVED -->
<section id="get-involved" class="csr-cta">
    <div class="container text-white">

        <div class="row mb-4">
            <div class="col-md-8">
                <h3>Get Involved</h3>
                <p>Partner with Vishvam Foundation to make your CSR initiatives impactful.</p>
            </div>
            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif
           
            {{-- ERROR MESSAGE --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please fix the errors below:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif
        </div>

        <form action="{{ route('contact.store') }}" method="POST" class="row">
            @csrf

            <div class="col-md-6 mb-3">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>

            <div>
                <input type="hidden" name="subject" value="CSR Partnership Inquiry">
            </div>

            <div class="col-md-6 mb-3">
                <input type="text" name="company" class="form-control" placeholder="Company / Organization" required>
            </div>

            <div class="col-md-6 mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
            </div>

            <div class="col-md-6 mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
            </div>

            <div class="col-md-12 mb-3">
                <textarea name="message" class="form-control" rows="3"
                    placeholder="Tell us about your CSR goals or how you’d like to collaborate."></textarea>
            </div>

            <div class="col-md-12">
                <button class="btn btn-light px-4 py-2">Start Partnership</button>
            </div>
        </form>

        <div class="mt-4">
            <p>
                📍 Hassan, Karnataka<br>
                📞 +91 78922 84158<br>
                ✉️ info@vishvamfoundation.org
            </p>
        </div>

    </div>
</section>

@endsection