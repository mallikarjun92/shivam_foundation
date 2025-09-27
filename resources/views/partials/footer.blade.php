<footer class="ftco-footer ftco-section img">
    <div class="overlay"></div>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">About Us</h2>
                    <p>At Vishvam Foundation, we believe no child should miss out on learning or growth due to hunger or lack of support. Our programs bring hope and opportunity to the community.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Recent Blog</h2>
                    @foreach($recentBlogs as $blog)
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url({{ asset($blog['image']) }});"></a>
                        <div class="text">
                            <h3 class="heading"><a href="{{ $blog['link'] }}">{{ $blog['title'] }}</a></h3>
                            <div class="meta">
                                <div><a href="{{ $blog['link'] }}"><span class="icon-calendar"></span> {{ $blog['date'] }}</a></div>
                                <div><a href="{{ $blog['link'] }}"><span class="icon-person"></span> {{ $blog['author'] }}</a></div>
                                {{-- <div><a href="{{ $blog['link'] }}"><span class="icon-chat"></span> {{ $blog['comments'] }}</a></div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-2">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Site Links</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}" class="py-2 d-block">Home</a></li>
                        <li><a href="{{ url('about') }}" class="py-2 d-block">About</a></li>
                        <li><a href="{{ url('donate') }}" class="py-2 d-block">Donate</a></li>
                        {{-- <li><a href="{{ url('causes') }}" class="py-2 d-block">Causes</a></li>
                        <li><a href="{{ url('event') }}" class="py-2 d-block">Event</a></li> --}}
                        <li><a href="{{ url('blog') }}" class="py-2 d-block">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">#13, Siddeshwara complex, behind Indian bank, near AVK college road, Hassan, Karnataka 573201</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">+91 78922 84158</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@vishvamfoundation.org</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://dinzin.in" target="_blank">DINZIN</a>
                </p>
            </div>
        </div>
    </div>
</footer>