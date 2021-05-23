<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title-page')</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-desktop"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Laboratorium</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('rekrut.index')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            {{-- <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Inventaris
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-database"></i>
                    <span>Inventaris</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Inventaris</h6> -->
                        <a class="collapse-item" href="{{ route('inventaris.index') }}">List Barang</a>
                        <a class="collapse-item" href="{{ route('inventaris.create') }}">Tambah Barang</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            @endcan
            @can('ruangan')
            <!-- Heading -->
            <div class="sidebar-heading">
                Penjadwalan
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jadwal" aria-expanded="true" aria-controls="jadwal">
                    <i class="fas fa-database"></i>
                    <span>Ruangan</span>
                </a>
                <div id="jadwal" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('ruanglab.index') }}">List Ruangan</a>
                        <a class="collapse-item" href="{{ route('ruanglab.create') }}">Tambah Ruangan</a>
                    </div>
                </div>
            </li>
            @endcan
            @if (auth()->user()->role != "dosen" and auth()->user()->role != "asprak")
            <div class="sidebar-heading">
                Peminjaman
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fab fa-leanpub"></i>
                    <span>Peminjaman</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
                        @can('inventaris')
                        <a class="collapse-item" href="{{ route('peminjaman.barang') }}">Barang</a>
                        @endcan
                        @can('ruangan')
                        <a class="collapse-item" href="{{ route('peminjaman.ruangan') }}">Ruangan</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endif
            @if (auth()->user()->role != "dosen")
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Surat
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesS" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-envelope-open"></i>
                    <span>Surat</span>
                </a>
                <div id="collapsePagesS" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('surat.masuk') }}">Surat Masuk</a>
                        <a class="collapse-item" href="{{ route('surat.keluar') }}">Surat Keluar</a>
                        <a class="collapse-item" href="{{ route('surat.create') }}">Tambah Surat</a>
                    </div>
                </div>
            </li>
            @endif --}}
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Asprak
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rekrut" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-building"></i>
                    <span>Recruitment</span>
                </a>
                <div id="rekrut" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('rekrut.create') }}">Buka Pendaftaran</a>
                        <a class="collapse-item" href="{{ route('rekrut.index') }}">Daftar Mata Kuliah</a>
                        <a class="collapse-item" href="{{ route('daftarmatakuliah.create') }}">Tambah Mata Kuliah</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#verif" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Verifikasi</span>
                </a>
                <div id="verif" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('asprak.index') }}">Verifikasi Berkas</a>
                        <a class="collapse-item" href="{{ route('asprak.nilai.index') }}">Verifikasi Penilaian</a>
                    </div>
                </div>
            </li>

            {{-- @if (auth()->user()->role != "dosen" and auth()->user()->role != "asprak")
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Riwayat
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesH" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-history"></i>
                    <span>Riwayat</span>
                </a>
                <div id="collapsePagesH" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('inventaris')
                        <a class="collapse-item" href="{{ route('peminjaman.barang.riwayat') }}">Barang</a>
                        @endcan
                        @can('ruangan')
                        <a class="collapse-item" href="{{ route('peminjaman.ruangan.riwayat') }}">Ruangan</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endif --}}


            <!-- Nav Item - Charts
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>History</span></a>
            </li> -->

            <!-- Nav Item - Tables
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                                <i class="far fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                {{-- @if(auth()->user()->role == "superadmin")
                                <a class="dropdown-item" href="{{ route('user.index') }}">
                                    <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Management User
                                </a>
                                @endif --}}
                                <a class="dropdown-item" href="{{ route('user.edit', auth()->user()->id) }}">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit Profile
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    {{-- <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title-page')</h1>
                    </div> --}}

                    @yield('content')

                </div>
                <!-- End of Main Content -->
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-dark mt-4">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span class="text-white">Copyright &copy; Laboratorium Multimedia</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('dashboard/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('dashboard/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('dashboard/js/demo/chart-pie-demo.js') }}"></script>

        {{-- Penambahan Script --}}
        @yield('js')
</body>

</html>
