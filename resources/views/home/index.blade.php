<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium Multimedia</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="row">
        <a class="itera" href="{{ route('home') }}"><img src="{{ asset('img/LabMM2.png')}}" alt="Laboratorium"></a>
    </div>
    <div class="container my-5">
        <div class="row justify-content-between">
            <div class="col-4">
                <div class="card">
                    <div class="row mx-auto">
                        <h3 class="text-card">Alur Peminjaman Barang</h3>
                        <div class="col-12">
                            <div class="line"></div>
                        </div>
                        <div class="row">
                            <div class="d-flex">
                                <div class="circle"></div>
                                <h4 class="text-list mt-1">Isi formulir peminjaman barang</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex">
                                <div class="circle"></div>
                                <h4 class="text-list mt-1">Print form</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="row justify-content-center">
                        <h3 class="text-card">Alur Peminjaman Ruangan</h3>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="row justify-content-center">
                        <h3 class="text-card">Alur Pendaftaran Asisten Praktikum</h3>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>