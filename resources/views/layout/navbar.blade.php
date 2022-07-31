<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row"
    style='background-color: #9561e2; height:50px;'>
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"
        style='background-color: #9561e2; height:0'>
        <a class="navbar-brand brand-logo" style="color: aliceblue">
            <h3>SIAKAD</h3>
        </a>

        <a class="navbar-brand brand-logo-mini" href="#" > <span class="mdi mdi-apps" style="color: aliceblue"></span></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch" style="height: 50px;">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize" style="padding: 0px; height: 50px;">
            <span class="mdi mdi-menu" style="color: aliceblue"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown" style="height: 50px;">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                    aria-expanded="false" style="padding-top: 0px; padding-bottom: 0px; height: 50px;">
                    <div class="nav-profile-img">
                        <img src="{{ asset ('images/faces-clipart/pic-1.png') }}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        @if (Auth::guard('user')->user())
                        <p class="mb-1 text-black" style="color: aliceblue; font-weight: bold">
                            {{ Auth::guard('user')->user()->name }}</p>
                        @elseif (Auth::guard('siswa')->user())
                        <p class="mb-1 text-black" style="color: aliceblue; font-weight: bold">
                            {{ Auth::guard('siswa')->user()->nama }}</p>
                        @elseif (Auth::guard('guru')->user())
                        <p class="mb-1 text-black" style="color: aliceblue; font-weight: bold">
                            {{ Auth::guard('guru')->user()->nama_guru }}</p>
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    @if(Auth::guard('guru')->user())
                    <a class="dropdown-item" href="{{ route('guru.change_password')}}">
                        <i class="mdi mdi-cached mr-2 text-success"></i> Change Password </a>
                    <div class="dropdown-divider"></div>
                    @endif
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout mr-2 text-primary">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </i>Signout</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
