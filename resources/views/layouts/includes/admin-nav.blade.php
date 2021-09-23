<div class="nav-scroller bg-white shadow-sm">
  <div class="container">
  <nav class="nav nav-underline" aria-label="Secondary navigation">
    <ul class="nav me-auto mb-2 mb-lg-0">
      <a class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
      <a class="nav-link {{ (request()->is('admin/artists')) ? 'active' : '' }}" href="{{ url('admin/artists') }}">Artists</a>
    </ul> 
  </nav>
</div>
</div>
