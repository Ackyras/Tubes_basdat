@extends('master.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/asprak/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/asprak/login.css') }}">
<link rel="stylesheet" href="{{ asset('css/asprak/seleksi.css') }}">
@endsection

@section('logout')
@if(auth()->user() and auth()->user()->role == 'calonasprak')
<form action="{{ route('calonasprak.logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary-outline float-right">Logout</button>
</form>
@else
<a href="{{ route('calonasprak.login') }}" class="btn btn-primary-outline float-right">Login</a>
@endif
@endsection

@section('content')
<div class="row">
    <h4 class="p-2 title-header">Uji Seleksi @if($matkul) {{$matkul->daftarmatakuliah->nama}} @endif</h4>
    <div class="line"></div>
</div>
<div class="row mt-5 row-2">
    <div class="card mx-auto">
        <div class="card-body d-flex flex-column">
            @if($matkul)
            <p>Silahkan ikuti petunjuk pengerjaaan soal</p>
            {{-- <p>{{ Carbon\Carbon::createFromFormat('s', strtotime($matkul->akhir_seleksi) - strtotime(Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s')))->format('i:s') }}</p> --}}
            <p id="#time" class="d-none">{{ strtotime($matkul->akhir_seleksi) - strtotime(Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s')) }}</p>
            <p id="#realtime"></p>
            <a href="{{ $matkul->soal }}">Lihat Soal</a>
            @else
            <p>Uji seleksi belum dibuka, silahkan cek jadwal untuk waktu pelaksanaan</p>
            @endif
        </div>
        @if($matkul)
        <div class="card-footer">
            <form action="{{ route('calonasprak.test.store', $matkul->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="jawaban">Upload Jawaban</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <button class="btn btn-login my-3 float-right" type="submit">Submit</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection

@section('js')
<script>
    var funcTime = setInterval(function() {
        // var now = "{!! Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s') !!}";
        // var x = document.getElementById("#time").innerText;
        // time = x % 60;
        // y = Math.floor(x / 60);
        // console.log(Math.floor(y));
        // console.log((time));
        var now = new Date().getTime();
        var seconds = Math.floor((now % (1000 * 60)) / 1000);
        let array = JSON.parse('{!! json_encode($waktu) !!}');
        console.log(seconds);
        console.log(array);
        // document.getElementById("#realtime").innerHTML = y + ":" + time
    }, 1000);
</script>
@endsection