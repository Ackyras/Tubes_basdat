<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
    @yield('css')
</head>

<body background="{{ asset('img/background.jpg')}}">
    <header style="max-height: 10%;">
        <a class="itera" href="{{ route('home') }}"><img src="{{ asset('img/LabMM2.png')}}" alt="Laboratorium"></a>
        @yield('logout')
    </header>

    <div class="row mx-2 wrapper-main">
        <div class="col-sm p-3 bg-light wrapper-navbar">
            <ul class="sidenav-menu">
                @if($master == "peminjaman")
                <a href="{{route('barang.list')}}">
                    <li class="navbarw sidenav-item p-2 border">
                        <i class="fas fa-boxes px-3"></i>Daftar Barang
                    </li>
                </a>
                <a href="{{route('barang.form')}}">
                    <li class="navbarw sidenav-item p-2 border">
                        <i class="fas fa-laptop px-3"></i>Form Pinjam Barang
                    </li>
                </a>
                <a href="{{ route('ruangan.index') }}">
                    <li class="navbarw sidenav-item p-2 border">
                        <i class="fas fa-table px-3"></i>Jadwal Ruangan
                    </li>
                </a>
                <a href="{{ route('ruangan.form') }}">
                    <li class="navbarw sidenav-item p-2 border">
                        <i class="fas fa-door-open px-3"></i>Form Pinjam Ruangan
                    </li>
                </a>
                @else
                <a href="{{ route('calonasprak.index') }}">
                    <li class="navbarw sidenav-item p-2 border">
                        <i class="fas fa-home px-3"></i>Beranda
                    </li>
                </a>
                @if(!Auth::check())
                <a href="{{ route('calonasprak.form') }}">
                    <li class="navbarw sidenav-item p-2 border">
                        <i class="fas fa-file-alt px-3"></i>Daftar
                    </li>
                </a>
                @endif
                @if (Auth::check())
                @if (Auth::user()->role == "calonasprak")
                <a href="{{ route('calonasprak.seleksi') }}">
                    <li class="navbarw sidenav-item p-2 border">
                        <i class="fas fa-laptop-code px-3"></i>Uji Seleksi
                    </li>
                </a>
                @endif
                @endif
                <a href="{{ route('calonasprak.jadwal') }}">
                    <li class="navbarw sidenav-item p-2 border">
                        <i class="fas fa-table px-3"></i>Jadwal Seleksi
                    </li>
                </a>
                @endif
            </ul>
            <footer class="mx-auto">
                <p class="text-white font-footer text-center ml-4">Copyright&copyLaboratorium Multimedia</p>
                <p class="text-white font-footer text-center ml-4">Institut Teknologi Sumatera</p>
            </footer>
        </div>
        <div class="col-sm-9 pb-4 bg-light ml-2 content">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
    @yield('js')
</body>

</html>