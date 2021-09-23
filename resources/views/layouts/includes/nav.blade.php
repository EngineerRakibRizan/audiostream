<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="{{ asset('images/logo.png') }}" alt="" width="30" height="30" class="me-1">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
          </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              @guest
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                </li>
              @else
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ Auth::user()->username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                      @auth
                      @if (auth()->user()->isUser())
                      <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                      <li><hr class="dropdown-divider"></li>
                      @endif
                      @if (auth()->user()->isAdmin())
                      <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li><hr class="dropdown-divider"></li>
                      @endif
                      @endauth
                      <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                  </li>
              @endguest
            </ul>
        </div>
    </div>
</nav>
