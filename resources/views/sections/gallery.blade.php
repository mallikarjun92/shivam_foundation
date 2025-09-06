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