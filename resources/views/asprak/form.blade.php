@extends('master.master')

@section('title', 'Pendaftaran Asprak')

@section('css')
<link rel="stylesheet" href="{{ asset('css/asprak/formasprak.css')}}">
@endsection

@section('content')
<div class="row sticky-top pb-3 bg-light">
    <h4 class="p-2 title-header">Formulir Pendaftaran Asisten Praktikum</h4>
    <div class="line"></div>
</div>
<div class="row pb-4">
    <form class="col-8" action="{{ route('calonasprak.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group p-1">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control rounded @error('nama') is-invalid @enderror" required placeholder="Masukkan nama anda" autofocus autocomplete="off">
            @error('nama')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>NIM</label>
            <input type="text" name="nim" value="{{ old('nim') }}" class="form-control rounded @error('nim') is-invalid @enderror" required placeholder="Masukan NIM anda" autocomplete="off">
            @error('nim')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Alamat Email ITERA</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded @error('email') is-invalid @enderror" required placeholder="Masukan alamat email ITERA anda" autocomplete="off">
            @error('email')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Program Studi</label>
            <input type="text" name="prodi" value="{{ old('prodi') }}" class="form-control rounded @error('prodi') is-invalid @enderror" required placeholder="Masukan program studi anda" autocomplete="off">
            @error('prodi')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Angkatan</label>
            <input type="text" name="angkatan" value="{{ old('angkatan') }}" class="form-control rounded @error('angkatan') is-invalid @enderror" required placeholder="Masukan angkatan anda" autocomplete="off">
            @error('angkatan')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Tanggal lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control rounded @error('tanggal_lahir') is-invalid @enderror" required placeholder="Masukan tahun kelahiran anda" autocomplete="off">
            @error('tanggal_lahir')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Pilihan 1</label>
            <select class="form-control @error('pilihan') is-invalid @enderror" name="pilihan[1]" required>
                <option value="" disabled selected>Pilihan 1</option>
                @foreach($matakuliahs as $matakuliah)
                <option value="{{ $matakuliah->id }}">{{$matakuliah->daftarmatakuliah->nama}}</option>
                @endforeach
            </select>
            @error('pilihan')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Pilihan 2</label>
            <select class="form-control @error('pilihan') is-invalid @enderror" name="pilihan[2]">
                <option value="" selected>Pilihan 2</option>
                @foreach($matakuliahs as $matakuliah)
                <option value="{{ $matakuliah->id }}">{{$matakuliah->daftarmatakuliah->nama}}</option>
                @endforeach
            </select>
            @error('pilihan')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Pilihan 3</label>
            <select class="form-control @error('pilihan') is-invalid @enderror" name="pilihan[3]">
                <option value="" selected>Pilihan 3</option>
                @foreach($matakuliahs as $matakuliah)
                <option value="{{ $matakuliah->id }}">{{$matakuliah->daftarmatakuliah->nama}}</option>
                @endforeach
            </select>
            @error('pilihan')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>CV</label>
            <input type="file" name="cv" class="form-control rounded @error('cv') is-invalid @enderror" required>
            @error('cv')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>KHS</label>
            <input type="file" name="khs" class="form-control rounded @error('khs') is-invalid @enderror" required>
            @error('khs')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>KTM</label>
            <input type="file" name="ktm" class="form-control rounded @error('ktm') is-invalid @enderror" required>
            @error('ktm')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-submit mt-5">Daftar</button>
    </form>
</div>
@endsection