<style>
    .img-circle-container {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }

    .img-circle-container .img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-size: cover;
        background-position: center center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: 5px solid #fff;
    }
</style>
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Our Volunteers</h2>
                <p>Meet our dedicated team of volunteers who work tirelessly to make a difference in our community.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($volunteers as $volunteer)
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch mb-4 ftco-animate">
                <div class=" text-center w-100">
                    <div class="img-circle-container mb-4 mx-auto">
                        <div class="img" style="background-image: url({{ $volunteer['photo'] ? asset('storage/' . $volunteer['photo']) : asset('images/default-volunteer.jpg') }});"></div>
                    </div>
                    <div class="info">
                        {{-- <h3 class="mb-2">{{ $volunteer['first_name'] }} {{ $volunteer['last_name'] }}</h3> --}}
                        <a href={{ url("/volunteers/".($volunteer['id'] ?? "#")) }}><h3 class="mb-2">{{ $volunteer['first_name'] }} {{ $volunteer['last_name'] }}</h3></a>
                        <span class="position">Volunteer</span>
                        {{-- @if($volunteer['interests'])
                            <p class="mt-3">{{ $volunteer['interests'] }}</p>
                        @else
                            <p class="mt-3">Enthusiastic and dedicated volunteer.</p>
                        @endif --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="view-more mt-4">
        <div class="text-center">
            <a href="{{ route('volunteers.index') }}" class="btn btn-primary btn-lg">View All Volunteers</a>
        </div>
    </div>
</section>