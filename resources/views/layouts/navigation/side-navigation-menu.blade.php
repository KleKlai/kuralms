<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="profile-image">
            <img class="img-xs rounded-circle" src="{!! Auth::user()->profile_photo_url !!}" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{!! Auth()->user()->name !!}</p>
                @if(Auth::user()->hasRole('teacher'))
                    <p class="designation">Teacher</p>
                @elseif(Auth::user()->hasRole('student'))
                    <p class="designation">Student</p>
                @else
                    <p class="designation">No Role</p>
                @endif
          </div>
        </a>
      </li>
      <li class="nav-item nav-category">Main Menu</li>
      {{--  <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#dashboard-dropdown" aria-expanded="false" aria-controls="dashboard-dropdown">
          <i class="menu-icon typcn typcn-document-text"></i>
          <span class="menu-title">Dashboard</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="dashboard-dropdown">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Lorem Ipsum</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/dashboards/dashboard-2.html">Lorem Ipsum</a>
            </li>
          </ul>
        </div>
      </li>  --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="menu-icon typcn typcn-home"></i>
          <span class="menu-title">Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('classroom.archive.index') }}">
          <i class="menu-icon typcn typcn-archive"></i>
          <span class="menu-title">Archive</span>
        </a>
      </li>
    </ul>
  </nav>
