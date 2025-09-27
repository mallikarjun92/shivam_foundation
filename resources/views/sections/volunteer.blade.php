<section class="ftco-section-3 img" style="background-image: url({{ asset('images/bg_3.jpg') }});" id="volunteer-form">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-md-flex">
            <div class="col-md-6 d-flex ftco-animate">
                {{-- <div class="img img-2 align-self-stretch" style="background-image: url({{ asset('images/bg_4.jpg') }});"></div> --}}
                <div class="img img-2 align-self-stretch" style="background-image: url({{ asset('https://static.wixstatic.com/media/a47305_b1d57f7c1ef84113b8c6cc0b2b6f14c2~mv2.png/v1/fill/w_788,h_788,al_c,q_90,usm_0.66_1.00_0.01,enc_avif,quality_auto/qr-code%20Vishvam%20JG.png') }}); background-size: contain;"></div>
            </div>
            <div class="col-md-6 volunteer pl-md-5 ftco-animate">
                <h1 class="mb-3" style="color: #fff">Volunteer With Us</h1>
                <h3 class="mb-3" style="color: #fff">Join Our Mission to Make a Difference!</h3>
                <p class="mb-3" style="color: #fff;">
                    <li class="ml-3" style="color: #fff;">Scan the QR Code</li>
                    <li class="ml-3" style="color: #fff;">Fill Out the Form</li>
                    <li class="ml-3" style="color: #fff;">Our Team Will Contact You </li>
                </p>
                {{-- <form action="#" class="volunter-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-white py-3 px-5">
                    </div>
                </form> --}}
                {{-- <form action="{{ route('admin.volunteers.store') }}" method="POST" enctype="multipart/form-data" class="volunter-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <textarea name="interests" rows="3" class="form-control" placeholder="Why do you want to volunteer?"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-white py-3 px-5">
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
</section>