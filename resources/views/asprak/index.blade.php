@extends('master.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/asprak/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/asprak/login.css') }}">
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
    <h4 class="p-2 title-header">Pengumuman</h4>
    <div class="line"></div>
</div>
<div class="row mt-5">
    @if (session('status'))
    <div class="alert alert-success mt-3 w-75">
        {{ session('status') }}
    </div>
    @endif
    @if($login)
    <p class="text">Ikuti seleksi ujian sesuai dengan waktu di <a href="{{route('calonasprak.jadwal')}}">Jadwal Seleksi</a></p>
    <p class="text">Soal akan muncul sesuai dengan waktu yang ada di Jadwal Seleksi.</p>
    @else
    <p class="text">Pembukaan Asisten Praktikum {{$pembukaan->judul}} telah dibuka</p><br>
    <p class="text">Silahkan mendaftar pada link berikut <a href="{{ route('calonasprak.form') }}">Daftar</a></p>
    <p class="text">Pendaftaran dibuka dari tanggal {{Carbon\Carbon::createFromFormat('Y-m-d',$pembukaan->awal_pembukaan)->format('d-m-Y')}} sampai tanggal {{Carbon\Carbon::createFromFormat('Y-m-d',$pembukaan->akhir_pembukaan)->format('d-m-Y')}}</p><br>
    <p class="text">Tunggu konfirmasi seleksi berkas, pengumuman seleksi akan dikirim ke email anda di form pendaftaran, pastikan email yang digunakan benar</p>
    @endif
</div>
@endsection