@push('styles')
    <style>
        .owl-carousel .owl-stage-outer {
            padding-top: 5px;
            padding-bottom: 5px;
            margin-left: 20px;
            margin-right: 20px;
        }
        .owl-carousel .owl-stage-outer .item .cause-entry .img {
            height: 500px !important;
        }
    </style>
@endpush

@if(isset($gallery) && count($gallery) > 0)
<section class="ftco-section bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="carousel-cause owl-carousel">
                    @foreach($gallery as $image)
                    <div class="item">
                        <div class="cause-entry">
                            <a  class="img" style="background-image: url({{ asset($image) }});"></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif