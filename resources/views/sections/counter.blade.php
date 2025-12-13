@if(!isset($stats))
    @php
        // $stats = [
        //     'children_served' => 1500,
        //     'locations' => 'India',
        // ];

        $statistic = \App\Models\Statistic::first();
        // dd($stats);
        $stats = [
            'children_served' => $statistic->children_served ?? 0,
            'locations' => $statistic->country_list[0] ?? 'India',
        ];
    @endphp
@endif
@php
    // $stats = [
    //     'children_served' => 150000,
    //     'locations' => 'India',
    // ];
    
    $statistic = \App\Models\Statistic::first();
    // dd($stats);
    $stats = [
        'children_served' => $statistic->children_served ?? 0,
        'locations' => $statistic->country_list[0] ?? 'India',
    ];
@endphp
{{-- @if(isset($stats)) --}}
<section class="ftco-counter ftco-intro" id="section-counter">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-5 d-flex justify-content-center counter-wrap ftco-animate">
                <div class="block-18 color-1 align-items-stretch">
                    <div class="text">
                        <span>Served Over</span>
                        <strong class="number" data-number="{{ $stats['children_served'] }}">0</strong>
                        {{-- <span>Children in {{ $stats['locations'] }} countries in the world</span> --}}
                        <span>Children in {{ $stats['locations'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                <div class="block-18 color-2 align-items-stretch">
                    <div class="text">
                        <h3 class="mb-4">Donate Money</h3>
                        <p>Give today and help change a life.</p>
                        <p><a href="{{ url('donate') }}" class="btn btn-white px-3 py-2 mt-2">Donate Now</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                <div class="block-18 color-3 align-items-stretch">
                    <div class="text">
                        <h3 class="mb-4">Be a Volunteer</h3>
                        {{-- <p>Even the all-powerful Pointing has no control about the blind texts.</p> --}}
                        <p>Join us and make a real difference.</p>
                        <p><a href="#volunteer-form" class="btn btn-white px-3 py-2 mt-2">Be A Volunteer</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- @endif --}}