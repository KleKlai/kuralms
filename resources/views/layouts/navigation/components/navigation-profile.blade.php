<li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
      <img class="img-xs rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="Profile image"> </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
      <div class="dropdown-header text-center">
        <img class="img-md rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="Profile image">
        <p class="mb-1 mt-3 font-weight-semibold">{!! Auth()->user()->name !!}</p>
        <p class="font-weight-light text-muted mb-0">{!! Auth()->user()->email !!}</p>
      </div>
      <a href="{{ route('profile.show') }}" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary"></i> My Profile </a>

      <a class="dropdown-item"
      href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="dropdown-item-icon mdi mdi-power text-primary"></i>Sign Out</a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>
</li>
