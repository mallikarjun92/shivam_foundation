<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Our Latest Events</h2>
            </div>
        </div>
        <div class="row">
            @foreach($events as $event)
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch">
                    <a href="#" class="block-20" style="background-image: url('{{ asset($event['image']) }}');"></a>
                    <div class="text p-4 d-block">
                        <div class="meta mb-3">
                            <div><a href="#">{{ $event['date'] }}</a></div>
                            <div><a href="#">{{ $event['organizer'] }}</a></div>
                            <div><a href="#" class="meta-chat"><span class="icon-chat"></span> {{ $event['comments'] }}</a></div>
                        </div>
                        <h3 class="heading mb-4"><a href="#">{{ $event['title'] }}</a></h3>
                        <p class="time-loc"><span class="mr-2"><i class="icon-clock-o"></i> {{ $event['time'] }}</span> <span><i class="icon-map-o"></i> {{ $event['venue'] }}</span></p>
                        <p>{{ $event['description'] }}</p>
                        <p><a href="{{ url('event') }}">Join Event <i class="ion-ios-arrow-forward"></i></a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>