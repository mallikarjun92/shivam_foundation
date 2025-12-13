@push('styles')
    <style>
        .mission-section {
            /* background: rgb(250, 143, 61) !important; */
            color: #000 !important;
            /* background: #faaa3a;             */
            background: url("/images/bg2.jpg");
        }
        .mission-section .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background: rgba(0, 0, 0, 0.5); */
            /* z-index: 1; */
            opacity: 0.7;
        }
    </style>
@endpush
<section class="ftco-section-3 img mission-section">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Our Mission</h2>
                <p>{{ $mission ?? '' }}</p>
            </div>
        </div>
    </div>
</section>