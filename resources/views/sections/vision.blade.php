@push('styles')
    <style>
        .vision-section {
            /* background: #faaa3a !important; */
            color: #000 !important;
            /* background: #faaa3a;             */
        }
    </style>
@endpush
<section class="ftco-section vision-section">
    <div class="container">
        <div class="row justify-content-center pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Our Vision</h2>
                <p>{{ $vision ?? '' }}</p>
            </div>
        </div>
    </div>
</section>