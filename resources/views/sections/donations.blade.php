@if(isset($donations) && count($donations) > 0)
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Latest Donations</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row">
            @foreach($donations as $donation)
            <div class="col-lg-4 d-flex mb-sm-4 ftco-animate">
                <div class="staff">
                    <div class="d-flex mb-4">
                        <div class="img" style="background-image: url({{ asset($donation['image']) }});"></div>
                        <div class="info ml-4">
                            <h3><a href="#">{{ $donation['name'] }}</a></h3>
                            <span class="position">{{ $donation['time'] }}</span>
                            <div class="text">
                                <p>Donated <span>${{ number_format($donation['amount']) }}</span> for <a href="#">{{ $donation['cause'] }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif