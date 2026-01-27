<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/kepegawaian/home" class="nav-link {{Request::is('kepegawaian/home') ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Beranda
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview {{Request::is('kepegawaian/data*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('kepegawaian/data*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Data
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/kepegawaian/data/agama"
                        class="nav-link {{Request::is('kepegawaian/data/agama') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Agama</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/eselon"
                        class="nav-link {{Request::is('kepegawaian/data/eselon') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Eselon</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/gender"
                        class="nav-link {{Request::is('kepegawaian/data/gender') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Gender</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/goldarah"
                        class="nav-link {{Request::is('kepegawaian/data/goldarah') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Golongan Darah</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/jabatan"
                        class="nav-link {{Request::is('kepegawaian/data/jabatan') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jabatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/jenis"
                        class="nav-link {{Request::is('kepegawaian/data/jenis') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jenis</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/pangkat"
                        class="nav-link {{Request::is('kepegawaian/data/pangkat') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pangkat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/kawin"
                        class="nav-link {{Request::is('kepegawaian/data/kawin') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Status Kawin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/kedudukan"
                        class="nav-link {{Request::is('kepegawaian/data/kedudukan') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kedudukan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/skpd"
                        class="nav-link {{Request::is('kepegawaian/data/skpd') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>SKPD</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/pendidikan"
                        class="nav-link {{Request::is('kepegawaian/data/pendidikan') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pendidikan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/status"
                        class="nav-link {{Request::is('kepegawaian/data/status') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Status Pegawai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/unit1"
                        class="nav-link {{Request::is('kepegawaian/data/unit1') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Unit Satuan 1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/unit2"
                        class="nav-link {{Request::is('kepegawaian/data/unit2') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Unit Satuan 2</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/unit3"
                        class="nav-link {{Request::is('kepegawaian/data/unit3') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Unit Satuan 3</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/keljab"
                        class="nav-link {{Request::is('kepegawaian/data/keljab') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>KELOMPOK JABATAN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/insjab"
                        class="nav-link {{Request::is('kepegawaian/data/insjab') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>JENIS JABATAN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/data/latjab"
                        class="nav-link {{Request::is('kepegawaian/data/latjab') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>LATIHAN JABATAN</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{Request::is('kepegawaian/kelola*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('kepegawaian/kelola*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Kelola
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/kepegawaian/kelola/jenjab"
                        class="nav-link {{Request::is('kepegawaian/kelola/jenjab') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>JENJANG JABATAN</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="/kepegawaian/kelola/leveljab"
                        class="nav-link {{Request::is('kepegawaian/kelola/leveljab') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>LEVELJAB</p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="/kepegawaian/kelola/unitkerja"
                        class="nav-link {{Request::is('kepegawaian/kelola/unitkerja') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>UNIT KERJA</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/kelola/pegawai"
                        class="nav-link {{Request::is('kepegawaian/kelola/pegawai') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PEGAWAI</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="/kepegawaian/kelola/organisasi"
                        class="nav-link {{Request::is('kepegawaian/kelola/organisasi') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>ORGANISASI</p>
                    </a>
                </li> --}}
            </ul>
        </li>

        <li class="nav-item has-treeview {{Request::is('kepegawaian/mutasi*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('kepegawaian/mutasi*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Mutasi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/kepegawaian/mutasi/inskpd"
                        class="nav-link {{Request::is('kepegawaian/mutasi/inskpd') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>INTERNAL SKPD</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/mutasi/antarskpd"
                        class="nav-link {{Request::is('kepegawaian/mutasi/antarskpd') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>ANTAR SKPD</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/mutasi/keluar"
                        class="nav-link {{Request::is('kepegawaian/mutasi/keluar') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PINDAH DARI PEMKO</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/mutasi/masuk"
                        class="nav-link {{Request::is('kepegawaian/mutasi/masuk') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>MASUK KE PEMKO</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/mutasi/pensiun"
                        class="nav-link {{Request::is('kepegawaian/mutasi/pensiun') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PENSIUN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/mutasi/meninggal"
                        class="nav-link {{Request::is('kepegawaian/mutasi/meninggal') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>MENINGGAL</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepegawaian/mutasi/hilang"
                        class="nav-link {{Request::is('kepegawaian/mutasi/hilang') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>HILANG</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="/kepegawaian/kelola/organisasi"
                        class="nav-link {{Request::is('kepegawaian/kelola/organisasi') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>ORGANISASI</p>
                    </a>
                </li> --}}
            </ul>
        </li>
        <li class="nav-item">
            <a href="/kepegawaian/gantipass" class="nav-link {{Request::is('kepegawaian/gantipass') ? 'active' : ''}}">
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