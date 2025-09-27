{{-- @if(isset($gallery) && count($gallery) > 0)
<section class="ftco-gallery">
    <div class="d-md-flex">
        @foreach(array_slice($gallery, 0, 4) as $image)
        <a href="{{ asset($image) }}" class="gallery image-popup d-flex justify-content-center align-items-center img ftco-animate" style="background-image: url({{ asset($image) }});">
            <div class="icon d-flex justify-content-center align-items-center">
                <span class="icon-search"></span>
            </div>
        </a>
        @endforeach
    </div>
    <div class="d-md-flex">
        @foreach(array_slice($gallery, 4, 4) as $image)
        <a href="{{ asset($image) }}" class="gallery image-popup d-flex justify-content-center align-items-center img ftco-animate" style="background-image: url({{ asset($image) }});">
            <div class="icon d-flex justify-content-center align-items-center">
                <span class="icon-search"></span>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif --}}

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