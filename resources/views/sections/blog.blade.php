<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Recent from blog</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row d-flex">
            @foreach($blogs as $blog)
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch">
                    <a href="#" class="block-20" style="background-image: url('{{ asset($blog['image']) }}');"></a>
                    <div class="text p-4 d-block">
                        <div class="meta mb-3">
                            <div><a href="#">{{ $blog['date'] }}</a></div>
                            <div><a href="#">{{ $blog['author'] }}</a></div>
                            <div><a href="#" class="meta-chat"><span class="icon-chat"></span> {{ $blog['comments'] }}</a></div>
                        </div>
                        <h3 class="heading mt-3"><a href="#">{{ $blog['title'] }}</a></h3>
                        <p>{{ $blog['excerpt'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>