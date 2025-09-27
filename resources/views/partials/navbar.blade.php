<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
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
          <li class="nav-item {{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('about') }}" class="nav-link">About</a></li>
          {{-- <li class="nav-item {{ request()->is('causes') ? 'active' : '' }}"><a href="{{ url('causes') }}" class="nav-link">Causes</a></li> --}}
          {{-- <li class="nav-item {{ request()->is('donate*') ? 'active' : '' }}"><a href="{{ url('donate') }}" class="nav-link">Donate</a></li> --}}
          <li class="nav-item {{ request()->is('blog') ? 'active' : '' }}"><a href="{{ url('blog') }}" class="nav-link">Blog</a></li>
          <li class="nav-item {{ request()->is('gallery') ? 'active' : '' }}"><a href="{{ url('gallery') }}" class="nav-link">Gallery</a></li>
          {{-- <li class="nav-item {{ request()->is('event') ? 'active' : '' }}"><a href="{{ url('event') }}" class="nav-link">Events</a></li> --}}
          <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('contact') }}" class="nav-link">Contact</a></li>
          <li class="nav-item {{ request()->is('donate*') ? 'active' : '' }}"><a href="{{ url('donate') }}" class="nav-link" style="background-color: #f8b739; color: #000; border-radius: 4px; padding: 8px 20px; margin-left: 10px;">Donate</a></li>
        </ul>
      </div>
    </div>
</nav>