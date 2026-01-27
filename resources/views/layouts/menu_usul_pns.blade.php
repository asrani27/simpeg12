<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/usul_pns/home" class="nav-link {{Request::is('usul_pns/home') ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Beranda
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/usul_pns/data" class="nav-link {{Request::is('usul_pns/data') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    usul_pns
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/usul_pns/jenis" class="nav-link {{Request::is('usul_pns/jenis') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Layanan usul_pns
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/usul_pns/persyaratan" class="nav-link {{Request::is('usul_pns/persyaratan') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Persyaratan
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/periode" class="nav-link {{Request::is('periode') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Periode
                </p>
            </a>
        </li>


        <li class="nav-item">
            <a href="/usul_pns/gantipass" class="nav-link {{Request::is('usul_pns/gantipass') ? 'active' : ''}}">
                <i class="nav-icon fas fa-key"></i>
                <p>
                    Ganti Password
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>