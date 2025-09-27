@php
    // Fetch the first active hero content for homepage
    $heroContent = \App\Models\HeroContent::where('title', 'homepage')->orderBy('order')->first();

    if (!$heroContent) {
        // Default content if none found
        $heroContent = (object)[
            'subtitle' => 'Doing Nothing is Not An Option of Our Life',
            'video' => 'https://vimeo.com/45830194', // Default video URL if needed
            'image' => asset('images/home_bg_1.jpg'),
            'button_text' => 'Watch Video',
        ];
    }
    else {
        $heroContent->subtitle = $heroContent->subtitle ? $heroContent->subtitle : 'Doing Nothing is Not An Option of Our Life';
        // Use the image if available, otherwise fallback to a default image
        $heroContent->image = $heroContent->image ? asset('storage/' . $heroContent->image) : asset('images/home_bg_1.jpg');
        $heroContent->video = $heroContent->video ? $heroContent->getYoutubeEmbedUrlAttribute() : 'https://vimeo.com/45830194';
        $heroContent->button_text = $heroContent->button_text ? $heroContent->button_text : 'Watch Video';
    }
@endphp

<div class="hero-wrap" style="background-image: url({{ $heroContent->image }});filter: grayscale(100%);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{$heroContent->subtitle}}</h1>
                <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="{{$heroContent->video}}" class="btn btn-white btn-outline-white px-4 py-3 popup-vimeo"><span class="icon-play mr-2"></span>{{$heroContent->button_text}}</a></p>
            </div>
        </div>
    </div>
</div>