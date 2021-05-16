@extends('master.master')

@section('css')
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
    <h4 class="p-2 title-header">Uji Seleksi</h4>
    <div class="line"></div>
</div>
<div class="row row-2">
    <div class="card mx-auto">
        <div class="card-body align-items-center d-flex">
            <ul class="ul-matkul my-4">
                @forelse ($matkuls as $matkul)
                <li>{{$matkul->daftarmatakuliah->nama}} <a class=" link" href="{{ route('calonasprak.test', $matkul->id) }}">Silahkan klik disini</a></li>
                @empty
                <li>Tidak ada jadwal yang tersedia saat ini, silahkan cek jadwal seleksi</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection