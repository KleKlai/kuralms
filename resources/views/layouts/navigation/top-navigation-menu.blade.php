<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      {{-- <a class="navbar-brand brand-logo" href="index.html">
        <img src="https://www.bootstrapdash.com/demo/star-admin-pro/src/assets/images/logo.svg" alt="logo" /> </a>
      <a class="navbar-brand brand-logo-mini" href="index.html">
        <img src="https://www.bootstrapdash.com/demo/star-admin-pro/src/assets/images/logo-mini.svg" alt="logo" /> </a> --}}
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      {{--  <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block mr-3">
            <b>Announcement: </b>
        </li>
      </ul>

      <marquee behavior="scroll" direction="left">
        We wish to inform you that there will be a system activity on April 4, 2021 from 12:00 MN to 7:00 AM.
      </marquee>  --}}

      <ul class="navbar-nav ml-auto">
        @include('layouts.navigation.components.notification')
        @include('layouts.navigation.components.navigation-profile')
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
</nav>
