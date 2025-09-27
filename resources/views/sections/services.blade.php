@if(isset($services) && count($services) > 0)
<section class="ftco-section">
    <div class="container">
        <div class="row">
            @foreach($services as $service)
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                <div class="media block-6 d-flex services p-3 py-4 d-block">
                    <div class="icon d-flex mb-3"><span class="{{ $service['icon'] }}"></span></div>
                    <div class="media-body pl-4">
                        <h3 class="heading">{{ $service['title'] }}</h3>
                        <p>{{ $service['description'] }}</p>
                    </div>
                </div>      
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif