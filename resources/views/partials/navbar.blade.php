<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" style="background: #fff !important;">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img class="logo-image" src="{{ asset('images/logo_transparent.png') }}" alt="logo" srcset="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
          {{-- <li class="nav-item {{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('about') }}" class="nav-link">About</a></li> --}}

          <li class="nav-item dropdown {{ request()->is('about-us*') || request()->is('about-us/volunteers*') ? 'active' : '' }}">
              <a class="nav-link "
                href="#"
                id="aboutDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                  About
              </a>

              <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                  <a class="dropdown-item {{ request()->is('about-us') ? 'active' : '' }}"
                    href="{{ url('about-us') }}">
                      About Us
                  </a>

                  <a class="dropdown-item {{ request()->is('about-us/volunteers') ? 'active' : '' }}"
                    href="{{ url('/about-us/volunteers') }}">
                      Volunteers
                  </a>
              </div>
          </li>

          {{-- <li class="nav-item {{ request()->is('causes') ? 'active' : '' }}"><a href="{{ url('causes') }}" class="nav-link">Causes</a></li> --}}
          {{-- <li class="nav-item {{ request()->is('donate*') ? 'active' : '' }}"><a href="{{ url('donate') }}" class="nav-link">Donate</a></li> --}}
          <li class="nav-item {{ request()->is('blog') ? 'active' : '' }}"><a href="{{ url('blog') }}" class="nav-link">Blog</a></li>
          <li class="nav-item {{ request()->is('gallery') ? 'active' : '' }}"><a href="{{ url('gallery') }}" class="nav-link">Gallery</a></li>
          <li class="nav-item {{ request()->is('events') ? 'active' : '' }}"><a href="{{ url('events') }}" class="nav-link">Events</a></li>
          <li class="nav-item {{ request()->is('programs') ? 'active' : '' }}"><a href="{{ url('programs') }}" class="nav-link">Programs</a></li>
          <li class="nav-item {{ request()->is('csr') ? 'active' : '' }}"><a href="{{ url('csr') }}" class="nav-link">Partnership</a></li>
          <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('contact') }}" class="nav-link">Contact</a></li>
          <li class="nav-item {{ request()->is('donate*') ? 'active' : '' }}"><a href="{{ url('donate') }}" class="nav-link" style="background-color: #f8b739; color: #000; border-radius: 4px; padding: 8px 20px; margin-left: 10px;">Donate</a></li>
        </ul>
      </div>
    </div>
</nav>