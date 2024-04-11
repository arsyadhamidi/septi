<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.min.css') }}" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="/dashboard" class="text-nowrap logo-img">
                        <img src="{{ asset('admin/assets/images/logos/dark-logo.svg') }}" width="180"
                            alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/dashboard" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        @if (Auth()->user()->level == 'Admin')
                        @elseif(Auth()->user()->level == 'Guru')
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Data Siswa</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('daftar-siswa.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-user-plus"></i>
                                    </span>
                                    <span class="hide-menu">Daftar Siswa</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('guru-nilai.hasilpeserta') }}"
                                    aria-expanded="false">
                                    <span>
                                        <i class="ti ti-chart-dots"></i>
                                    </span>
                                    <span class="hide-menu">Hasil Peserta Didik</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('guru-nilai.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-table"></i>
                                    </span>
                                    <span class="hide-menu">Tabel Skor</span>
                                </a>
                            </li>
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Instrumen</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('guru-soal.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-report-medical"></i>
                                    </span>
                                    <span class="hide-menu">Soal</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('guru-subsoal.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-book-2"></i>
                                    </span>
                                    <span class="hide-menu">Sub Soal</span>
                                </a>
                            </li>
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Penerapan</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('penerapan-soal.index') }}"
                                    aria-expanded="false">
                                    <span>
                                        <i class="ti ti-folder"></i>
                                    </span>
                                    <span class="hide-menu">Penerapan Soal</span>
                                </a>
                            </li>
                        @elseif(Auth()->user()->level == 'Siswa')
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Instrumen</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('siswa-instrument.index') }}"
                                    aria-expanded="false">
                                    <span>
                                        <i class="ti ti-report-medical"></i>
                                    </span>
                                    <span class="hide-menu">Instrument</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('siswa-nilai.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-chart-dots"></i>
                                    </span>
                                    <span class="hide-menu">Nilai</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                        <div class="d-flex">
                            <div class="unlimited-access-title me-3">
                                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Tes Kemampuan Anda Disini</h6>
                                <a href="#" target="_blank"
                                    class="btn btn-primary fs-2 fw-semibold lh-sm">Mulai
                                    Sekarang</a>
                            </div>
                            <div class="unlimited-access-img">
                                <img src="{{ asset('admin/assets/images/backgrounds/rocket.png') }}" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            {{ Auth()->user()->name ?? '-' }}
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (Auth()->user()->foto_profile)
                                        <img src="{{ asset('storage/' . Auth()->user()->foto_profile) }}"
                                            alt="" width="35" height="35" class="rounded-circle">
                                    @else
                                        <img src="{{ asset('images/foto-profile.png') }}" alt=""
                                            width="35" height="35" class="rounded-circle">
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{ route('setting.index') }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="{{ route('logout-action.logout') }}"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">


                @yield('content')

                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Septia Hardila {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('js/preview.js') }}"></script>
    <script src="{{ asset('js/Chart.js') }}"></script>
    <script src="{{ asset('js/Gauge.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    @stack('custom-script')
</body>

</html>
