<section class="ftco-section bg-light">
    <div class="container-fluid">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-5 heading-section ftco-animate text-center">
                <h2 class="mb-4">Our Causes</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="carousel-cause owl-carousel">
                    @foreach($causes as $cause)
                    <div class="item">
                        <div class="cause-entry">
                            <a href="#" class="img" style="background-image: url({{ asset($cause['image']) }});"></a>
                            <div class="text p-3 p-md-4">
                                <h3><a href="#">{{ $cause['title'] }}</a></h3>
                                <p>{{ $cause['description'] }}</p>
                                <span class="donation-time mb-3 d-block">Last donation {{ $cause['last_donation'] }}</span>
                                <div class="progress custom-progress-success">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $cause['progress'] }}%" aria-valuenow="{{ $cause['progress'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fund-raised d-block">${{ number_format($cause['raised']) }} raised of ${{ number_format($cause['goal']) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>