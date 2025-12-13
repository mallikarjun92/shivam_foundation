<section class="ftco-section bg-light">
    <div class="container" id="enroll-form">
    
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-8 heading-section ftco-animate text-center">
                <h2 class="mb-4">Enroll in Our Program</h2>
                <p class="text-muted">Fill out the form below to join.</p>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 ftco-animate">

                <form action="{{ route('programs.enroll') }}" method="POST" class="p-5 bg-white shadow">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Full Name *</label>
                        <input type="text" name="name" required class="form-control" placeholder="Your Name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email Address *</label>
                        <input type="email" name="email" required class="form-control" placeholder="Your Email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Phone Number *</label>
                        <input type="text" name="phone" required class="form-control" placeholder="Your Phone Number">
                    </div>

                    <div class="form-group mb-3">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" placeholder="Your Country">
                    </div>

                    <input type="hidden" name="program_type" value="{{ $programType }}">

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary py-3 px-5">Enroll Now</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</section>
