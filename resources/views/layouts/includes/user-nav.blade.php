<div class="nav-scroller bg-white shadow-sm">
  <div class="container">
  <nav class="nav nav-underline" aria-label="Secondary navigation">
    <ul class="nav me-auto mb-2 mb-lg-0">
      <a class="nav-link {{ (request()->is('user/dashboard')) ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Dashboard</a>
    </ul>

    <ul class="nav ms-auto mb-2 mb-lg-0">

    </ul>
  </nav>
</div>
</div>
