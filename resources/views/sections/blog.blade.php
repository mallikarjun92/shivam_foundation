@if(isset($blogs) && count($blogs) > 0)
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">{{ $title }}</h2>
                <p>{{ $description }}</p>
            </div>
        </div>
        <div class="row d-flex">
            @foreach($blogs as $blog)
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch w-100">
                    <a href="{{ $blog['link'] }}" class="block-20" style="background-image: url('{{ $blog['image'] }}');"></a>
                    <div class="text p-4 d-block">
                        <div class="meta mb-3">
                            <div><a href="{{ $blog['link'] }}">{{ $blog['date'] }}</a></div>
                            <div><a href="{{ $blog['link'] }}">{{ $blog['author'] }}</a></div>
                            {{-- <div><a href="{{ $blog['link'] }}" class="meta-chat"><span class="icon-chat"></span> {{ $blog['comments'] }}</a></div> --}}
                        </div>
                        <h3 class="heading mt-3"><a href="{{ $blog['link'] }}">{{ $blog['title'] }}</a></h3>
                        <p>{{ strip_tags($blog['excerpt']) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif