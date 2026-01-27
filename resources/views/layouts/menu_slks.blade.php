<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/slks/home" class="nav-link {{Request::is('slks/home') ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Beranda
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/slks/data" class="nav-link {{Request::is('slks/data') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    slks
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/slks/jenis" class="nav-link {{Request::is('slks/jenis') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Layanan SLKS
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/slks/persyaratan" class="nav-link {{Request::is('slks/persyaratan') ? 'active' : ''}}">
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
            <a href="/slks/gantipass" class="nav-link {{Request::is('slks/gantipass') ? 'active' : ''}}">
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