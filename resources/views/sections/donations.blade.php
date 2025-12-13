@push('styles')
    <style>
        .owl-carousel .owl-stage-outer {
            padding-top: 5px;
            padding-bottom: 5px;
        }
    </style>

@endpush
@if(isset($donations) && count($donations) > 0)
<section class="ftco-section">
    <div class="container-fluid">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Latest Donations</h2>
            </div>
        </div>

        <div class="col-md-12 ftco-animate">
            {{-- <div class="carousel-donations owl-carousel"> --}}
                <div class="carousel-donations owl-carousel">

                @foreach($donations as $donation)
                <div class="item">
                    <div class="staff p-3">

                        <div class="d-flex">
                            <div class="img" 
                                 style="background-image: url('{{ $donation['image'] }}');">
                            </div>

                            <div class="info ml-4 mt-3">
                                <h3 class="mb-1">
                                    <a href="#">{{ $donation['name'] }}</a>
                                </h3>
                                <span class="position">
                                    {{ $donation['time'] }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>
</section>
@endif

@push('scripts')
<script>
$(document).ready(function() {
    $('.carousel-donations').owlCarousel({
        autoplay: true,
        center: false,
        loop: true,
        items: 1,
        margin: 30,
        stagePadding: 0,
        nav: true,
        navText: [
            '<span class="ion-ios-arrow-back"></span>', 
            '<span class="ion-ios-arrow-forward"></span>'
        ],
        responsive:{
            0:{
                items:1,
                stagePadding:0
            },
            600:{
                items:2,
                stagePadding:50
            },
            1000:{
                items:3,
                stagePadding:100
            }
        }
    });
});
</script>
@endpush

