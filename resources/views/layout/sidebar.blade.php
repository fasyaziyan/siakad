<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if(Auth::guard('siswa')->user())

        <li class="nav-item @if (Request::segment(1)=='dashboard2' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('dashboard2') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li
            class="nav-item @if (Request::segment(1)=='siswa' && Request::segment(2)=='profil' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('siswa.profile') }}">
                <span class="menu-title">Profile</span>
                <i class="mdi mdi-account menu-icon"></i>
            </a>
        </li>

        <li
            class="nav-item @if (Request::segment(1)=='siswa' && Request::segment(1)=='rapot' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('siswa.index_rapot') }}">
                <span class="menu-title">Rapot</span>
                <i class="mdi mdi-book-multiple-variant
              menu-icon"></i>
            </a>
        </li>

        @elseif(Auth::guard('guru')->user())
        <li class="nav-item @if (Request::segment(1)=='dashboard' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if (Request::segment(1)=='profileguru' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('profile.gur') }}">
                <span class="menu-title">Profile</span>
                <i class="mdi mdi-account menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if (Request::segment(1)=='rapot' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('raport.mapel') }}">
                <span class="menu-title">Daftar Pelajaran</span>
                <i class="mdi mdi-book-multiple-variant
              menu-icon"></i>
            </a>
        </li>

        @php
        $wali = DB::table('Kelas')->where('nip', Auth::guard('guru')->user()->nip)->exists();
        @endphp

        @if(Auth::guard('guru')->user()->nip == $wali)
        <li class="nav-item @if (Request::segment(1)=='wali' ) nav-item-active active @endif">
            <hr style="border: 1px solid rgba(71, 70, 70, 0.733);">
            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Nilai & Raport</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse @if (Request::segment(1)=='wali' ) collapse show @endif" id="ui-basic" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link @if (Request::segment(1)=='wali') nav-link active @endif"
                            href="{{ route('wali.index_rapot') }}">Rapot Siswa</a></li>
                </ul>
            </div>
        </li>
        @endif

        @elseif(Auth::guard('user')->user())

        <li class="nav-item @if (Request::segment(1)=='dashboard' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if (Request::segment(1)=='guru' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('guru.index') }}">
                <span class="menu-title">Guru</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if (Request::segment(1)=='siswa' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('siswa.index') }}">
                <span class="menu-title">Siswa</span>
                <i class="mdi mdi-account-box menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if (Request::segment(1)=='kelas' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('kelas.index') }}">
                <span class="menu-title">Kelas</span>
                <i class="mdi mdi-bank menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if (Request::segment(1)=='mapel' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('mapel.index') }}">
                <span class="menu-title">Mata Pelajaran</span>
                <i class="mdi mdi-clipboard
              menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if (Request::segment(1)=='kurikulum' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('kurikulum.index') }}">
                <span class="menu-title">Kurikulum</span>
                <i class="mdi mdi-apps-box
              menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if (Request::segment(1)=='tingkat' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('tingkat.index') }}">
                <span class="menu-title">Tingkat</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>

        <li class="nav-item @if (Request::segment(1)=='nilai' ) nav-item-active active @endif">
            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Nilai & Raport</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse @if (Request::segment(1)=='nilai' ) collapse show @endif" id="ui-basic" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a
                            class="nav-link @if (Request::segment(1)=='nilai' && Request::segment(2)=='mapel') nav-link active @endif"
                            href="{{ route('nilai.mapel') }}">Nilai Siswa Per Mapel</a></li>
                    <li class="nav-item"> <a
                            class="nav-link @if (Request::segment(1)=='nilai' && Request::segment(2)=='show') nav-link active @endif"
                            href="{{ route('nilai.show2') }}">Rapot Siswa</a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item @if (Request::segment(1)=='admin' ) nav-item-active active @endif">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <span class="menu-title">Admin</span>
                <i class="mdi mdi-account-plus menu-icon"></i>
            </a>
        </li>

        @endif
    </ul>
</nav>
